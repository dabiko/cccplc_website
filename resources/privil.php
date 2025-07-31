<?php

require_once('utilities.php');

class privil
{
    
public static function get_privil($testprv){
    
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