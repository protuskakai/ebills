<head>
<script type='text/javascript'>
 
   function doSubmit() 
            {
           
               if(document.bud0.dat.value=='') 
               { 
                      alert('Invalid Connection No.!'); 
                      document.bud0.dat.focus(); 
                       return false; 
                }             
                if((document.bud0.dat.value).length<12)
                {
                 alert('Invalid Connection No.!'); 
                      document.bud0.dat.focus(); 
                       return false; 
                }
              
             if((document.bud0.dat.value).length<12)
                {
                 alert('Invalid Connection No.!'); 
                      document.bud0.dat.focus(); 
                       return false;
                }
                 document.bud0.submit(); 
               return true;   
            } 
              
    </script> 

</head>


<?php

//include "//192.168.1.2/helpdesk/header.htm";


echo "<br>";
echo "<b>Query Customer Meter Readings</b>";
echo "<br>";

?>
<form method="post"  name="bud0" action="readingsx.php">
<tr><td><br></td><td></td><td></td></tr>
<tr>
<td>Please Enter Your Connecton No. (12 Digits) :</td>


<td><input id="bud01" type="text" name="dat" ></td>
</tr>

<input type="button"  onclick="doSubmit()" value="Query">
</form>
</table>

<?php
// echo "<br> <a href='javascript:history.back(1)'><img src='BACK.BMP' width='12' height='16' border='0' alt=''><img src='back2.gif' width='47' height='16' border='0' alt=''></a>" ;
 //include "//192.168.1.2/helpdesk/footer.htm";
?>
