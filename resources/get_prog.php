<?php


// this script is under development the intension of this script is to  display the menus under which  the different reports are grouped 
//this script is build to be put in a form
require_once('utilities.php');

class req_prog
{
    
public static function get_prog($testprv){
    
$query= new QueryControllers;


if($result=$query->SelectData(['privil_id','type'],'privil','')){

foreach($result as $presult)
{
    if($testprv==$presult['privil_id']){
         echo  '<option selected value='.$presult['privil_id'].'>'.$presult['type'].'</option>';
    }else{
        echo  '<option value='.$presult['privil_id'].'>'.$presult['type'].'</option>'; 
    }

    
}
}

else{
    
echo '<option>errorprivilretr100<option>' ;
    
}  
}
}
?>