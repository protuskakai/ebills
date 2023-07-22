
<?php
try {
$db = new PDO("informix:host=6224.113.58; service=1543;
    database=water; server=ids_wan_remote; protocol=onsoctcp;
    EnableScrollableCursors=1" ,"pkakai","kit@le50");
print "Hello World!</br></br>";
print "Connection Established!</br></br>";
$stmt = $db->query("select * from customer");
$res = $stmt->fetch( PDO::FETCH_ASSOC);
$rows = $res[0];
echo "Table contents: $rows.</br>";
} catch (PDOException $e) {
    print $e->getMessage();
}

?>
