<?php
//validating request from form
require_once('utilities.php');

$params=json_decode($_GET['data']);
$errorMSG="";
if (empty($params -> password)) {
   $errorMSG .= "Password New is empty  ,  ";
} else {
   $password =$params -> password;
}

 
if(empty($errorMSG)){
try{

    //fill the require fields
    $error = array(0,'INPUT ERROR CURRENT PASSWORD DOES NOT MATCH','FATAL ERROR !! UNAUTHORIZED OPERATION USER NOT REGONIZED','OPERATION FAILED: FAILED TO UPDATE DATABASE CONTACT ADMIN');
    $runQ = new QueryControllers();
    $SelectQuery = $runQ->SelectData('password','customer_credentials','customer_id = "'. $_SESSION['forgot_cus_id'].'"');
    //using our query controller class to dynamically insert data into our database
    if($runQ->getrow_num() == 1){
    $new_security= new security;

    if ($password!=""){$encpass = $new_security->encryptor($password);}


    $fields[] = "password";
    $fields[] = "dateupdated";
    date_default_timezone_set('Africa/Douala');
    // $values[] ="";


    $values[] = $encpass;
    $values[] = date('Y-m-d H:i:s');
        
    $reset_fields[] = "reset_status";
    $reset_fields[] = "reset_time";
    date_default_timezone_set('Africa/Douala');
    // $values[] ="";


    $reset_values[] = "0003";
    $reset_values[] = date('Y-m-d H:i:s');     
    

    $results_reset = $runQ->UpdateData('reset_ctl',$reset_fields,$reset_values,' reset_status="0001" and reset_id='.$_SESSION['forgot_reset_id'].' and user_id='.$_SESSION['forgot_cus_id']);

   if($results_reset===true){     
        
    $results = $runQ->UpdateData('customer_credentials',$fields,$values,'customer_id='.$_SESSION['forgot_cus_id']);

    if($results===true){
        
    $errorMSG= "PASSWORD UPDATED SUCCESSFULLY";
    $error_msg=[0,$errorMSG];
    echo json_encode($error_msg);

    }else{
    // throw new Exception($output);

    $errorMSG= "PASSWORD UPDATE Error: ".$error[3].''.$results;
    $error_msg=[1,$errorMSG];
    echo json_encode($error_msg);
    }
   }
        else {
           $errorMSG= "RESET STATUS UPDATE Error: ".$error[3].''.$results_reset;
    $error_msg=[1,$errorMSG];
    echo json_encode($error_msg);   
            
        }
            }
        
           else {
     $error_msg=[1,$error[2]];
      echo json_encode($error_msg);
              
            }
    

   
}
 catch (Throwable $e) {
      $saved_error =  'CCC PLC DEBUGER ERROR on line '.$e->getLine().' FILE CONTAINING ERROR '.$e->getFile()
    .': ERROR INFO : '.$e->getMessage().' CONTACT WEBMASTER';
     $error_msg=[1,$saved_error];
          echo json_encode($error_msg);            
        
}
}
else{
    $errorMSG.=" is required ";
    $error_msg=[1,$errorMSG];
    
  echo json_encode($error_msg);
}






?>
   