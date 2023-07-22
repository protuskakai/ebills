<td>
<select name="yr2" size="1">
<option value=""></option>
   <option value="2013">2013</option>
   <option value="2014">2014</option>
   <option value="2015">2015</option>
	<option value="2016">2016</option>
	<option value="2017">2017</option>
	<option value="2018">2018</option>
	<option value="2019">2019</option>
</select>
</td>
</tr>
<tr>
 Month</td>
<td>
<select name="mon2" size="1">
<option value=""></option>
  
	   <option value="01">Jan</option>
   	<option value="02">Feb</option>
	   <option value="03">Mar</option>
		<option value="04">Apr</option>
		<option value="05">May</option>
		<option value="06">Jun</option>
		<option value="07">Jul</option>
		<option value="08">Aug</option>
		<option value="09">Sep</option>
		<option value="10">Oct</option>
		<option value="11">Nov</option>
	   <option value="12">Dec</option>
</select>



</tr>

<tr>
<td>Day</td>
<td>
<select name="day2" size="1">
<option value=""></option>
  

  <?php
   
   for ($i = 1; $i <= 31; $i++) 
   {
   
     $s=$i;
   if ( $i<10)
   {
     $s='0'.$i;
    
   }
    echo    "<option value='$s'>$s</option>";
}

   
?>
	   
   
</select>

</tr>