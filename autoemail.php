<?php
/*
    goldfish - the PHP auto responder for postfix
    Copyright (C) 2007-2008 by Remo Fritzsche
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    (c)      2012 Martin Parsiegla  (Refactored)
    (c) 2007-2009 Remo Fritzsche    (Main application programmer)
    (c)      2009 Karl Herrick	    (Bugfix)
    (c) 2007-2008 Manuel Aller	    (Additional programming)
    Version 1.0-STABLE
*/
if (version_compare(PHP_VERSION, "5.3.3") == -1) {
    echo "Install PHP 5.3.3 or newer (current version is ". phpversion() .")";
    exit;
}
/* General */
$conf['cycle'] = 5 * 60;
/* Logging */
$conf['log_file_path'] = "/var/log/autoreply";
$conf['write_log'] = true;
/* The path to the mail directory */
$conf['mailbox_path'] = "/var/vmail/%domain%/%user%/Maildir/new";
/* Database information */
$conf['mysql_host'] = "localhost";
$conf['mysql_user'] = "mailuser";
$conf['mysql_password'] = "password";
$conf['mysql_database'] = "mailserver";
/* Database Queries */
# This query has to return the following fields from the autoresponder table: `from`, `to`, `email`, `message`
$conf['q_forwardings'] = "SELECT `email`, `message`, `subject` FROM `autoresponder` WHERE `force_disabled` = 0 AND NOW() BETWEEN `from` AND `to`;";
class Logger
{
    private $str;
    private $conf;
    public function __construct($conf)
    {
        $this->conf = $conf;
    }
    function addLine($str)
    {
        $str = date("Y-m-d h:i:s") . " " . $str;
        $this->str .= "\n$str";
        echo $str . "\n";
    }
    function writeLog()
    {
        if (!$this->conf['write_log']) return;
		
        if (is_writable($this->conf['log_file_path'])) {
            $this->addLine("--------- End execution ------------");
            if (false === file_put_contents($this->conf['log_file_path'], $this->str, FILE_APPEND)) {
                echo "Cannot write to file";
                exit;
            } else {
                echo "Wrote log successfully.";
            }
        } else {
            echo "Error: The log file is not writeable.\n";
        }
    }
}
$log = new Logger($conf);
// establish database connection
try {
    $dsn = 'mysql:dbname=' . $conf['mysql_database'] . ';host=' . $conf['mysql_host'];
    $pdo = new PDO($dsn, $conf['mysql_user'], $conf['mysql_password']);
    $log->addLine("Connection to database established successfully");
} catch (PDOException $ex) {
    $log->addLine("ERROR: Could not connect to database: " . $e->getMessage());
    $log->writeLog();
    exit();
}
// Corresponding email addresses
$result = $pdo->query($conf['q_forwardings']);
if (false === $result) {
    $log->addLine("Error in query " . $conf['q_forwardings'] . "\n" );
    exit();
}
$accounts = array();
foreach ($result as $row) {
    $domain = str_replace('@', '', strstr($row['email'], '@'));
    $user = strstr($row['email'], '@', true);
    $row['user'] = $user;
    $row['path'] = str_replace(array('%user%', '%domain%'), array($user, $domain), $conf['mailbox_path']);
    $accounts[] = $row;
}
// check for new emails
foreach ($accounts as $account) {
    $path = $account['path'];
    try {
        $dir = new DirectoryIterator($path);
    } catch(Exception $ex) {
        // Path could not be opened, proceed with next value
        $log->addLine("The directory '". $path ."' could not be opened.");
        continue;
    }
    foreach ($dir as $fileInfo) {
        if ($fileInfo->isDot()) {
            continue;
        }
        if (time() - $fileInfo->getMTime() - $conf['cycle'] >= 0) {
            continue;
        }
        $file = $fileInfo->openFile('r');
        $wholeFile = '';
        while (!$file->eof()) {
            $line = $file->current();
            $line = trim($line);
            $wholeFile .= $line;
            if (substr($line, 0, 12) == 'Return-Path:') {
                $returnpath = substr($line, strpos($line, '<') + 1, strpos($line, '>') - strpos($line, '<') - 1) . "\n";
            }
            if (substr($line, 0, 5) == 'From:' && strstr($line, "@")) {
                $address = substr($line, strpos($line, '<') + 1, strpos($line, '>') - strpos($line, '<') - 1) . "\n";
                break;
            } elseif (substr($line, 0, 5) == 'From:' && !strstr($line, "@") && !empty ($returnpath)) {
                $address = $returnpath;
                break;
            }
			
            $file->next();
        }
        if (empty($address)) {
            $log->addLine("Error, could not parse mail $path");
            continue;
        }
        $headers = "From: " . $account['user'] . "<" . $account['email'] . ">";
        // Check if mail is allready an answer:
        if (strstr($wholeFile, $account['message'])) {
            $log->addLine("Mail from ". $account['email'] ." allready answered");
            break;
        }
        // strip the line break from $address for checks
        // fix by Karl Herrick, thank's a lot
        if (substr($address, 0, strlen($address) - 1) == $account['email']) {
            $log->addLine("Email address from autoresponder table is the same as the intended recipient! Not sending the mail!");
            break;
        }
        $log->addLine("Successfully sent email to ". $address);
        mail($address, $account['subject'], $account['message'], $headers);
    }
}
$log->writeLog($conf);
echo "End execution.";