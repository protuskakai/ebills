<?php

//include "header.htm";
echo "<br>";
echo "<b>Bill Products</b>";
echo "<br>";

?>
<form method="post" action="mpesan2.php">
<tr><td><br></td><td></td><td></td></tr>
<tr>
<td>Date From:</td>
<td>

<?php
include "dd1.php";
?>

</td>
<Br>
<Br>
<tr>
<td><td>Date To:&nbsp;&nbsp;&nbsp;&nbsp;</td></td>
<?php
include "dd2.php";
?>
<Br>
<Br>
<tr>
 <td>Region:&nbsp;&nbsp;&nbsp;</td>
<td>
	
	<select name="reg" size="1">
<option value=""></option>

	<option value="Bungoma">Bungoma</option>
	<option value="Kimilili">Kimilili</option>
		<option value="Kitale">Kitale</option>
   	<option value="Webuye">Webuye</option>

</select>
	
	</td>

</tr>
<Br>
<Br>
<input type="submit"   value="Query">
</form>
</table>

<?php
 echo "<br> <a href='javascript:history.back(1)'><img src='BACK.BMP' width='12' height='16' border='0' alt=''><img src='back2.gif' width='47' height='16' border='0' alt=''></a>" ;
 //include "footer.htm";
?>
