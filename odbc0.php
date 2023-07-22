<?php

//include "//192.168.1.2/helpdesk/header.htm";


echo "<br>";
echo "<b>Query Customer Transactions</b>";
echo "<br>";

?>
<form method="post" action="odbc.php">
<tr><td><br></td><td></td><td></td></tr>
<tr>
<td>Please Enter Your Connecton No. (12 Digits) :</td>


<td><input type="text" name="dat"></td>
</tr>

<input type="submit"   value="Query">
</form>
</table>

<?php
// echo "<br> <a href='javascript:history.back(1)'><img src='BACK.BMP' width='12' height='16' border='0' alt=''><img src='back2.gif' width='47' height='16' border='0' alt=''></a>" ;
 //include "//192.168.1.2/helpdesk/footer.htm";
?>
