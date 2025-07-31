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

if (empty($params -> password1)) {
  $errorMSG .= "Password Old is empty  ,  ";
} else {
   $password_old =$params -> password1;
}


if (empty($params -> token_id)) {
 $errorMSG .= "Security token key  ,  ";
   }
    else{
        $token=$params -> token_id;
    }

//
////echo $condition.", ".$message.", ".$video.", ".$holder;
//if( $errorMSG==''){
//  $reginstance =new register;
//  $jsonData = $reginstance
//  die($jsonData);
//
//}
//else{
//    die('uiderrorx280444444 msg:'.$errorMSG);
//}

 
if(empty($errorMSG)){
try{

    //fill the require fields
   
    
    //using our query controller class to dynamically insert data into our database
   $runQ = new register();
    $output;
    $output=$runQ->pass_update($password,$password_old,$token);;
     return $output;

   
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
   