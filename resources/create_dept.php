<?php
//validating request from form
require_once('utilities.php');


$errorMSG="";

if (empty($_POST["dept"])) {
   $errorMSG .= "Please Enter Department Name ,  ";
} else {
    $values[] =0;
    $values[] =$_POST['dept'];
}


if (empty($_POST["token_id"])) {
 $errorMSG .= "Missing Security token key  ,  ";
   }
    else{
        $token=$_POST['token_id'];
    }


//echo $condition.", ".$message.", ".$video.", ".$holder;
if( $errorMSG ==''){
    //fill the require fields
    $fields[] = "privil_id";
    $fields[] = "type";
    $fields[] = "Date_Created";
    $fields[] = "Date_Modified";
    $fields[] = "User_ID";
    
    $values[] = date('Y-m-d H:i:s');
    $values[] = date('Y-m-d H:i:s'); 
    $values[] = $_SESSION['ccc_id']; 
    
    //using our query controller class to dynamically insert data into our database
   $runQ = new QueryControllers();
  if($ouput=$runQ->InsertData('privil', $fields, $values)){
      die('1');
  }
}
else{
    die('uiderrorx280444444 msg:'.$errorMSG);
}
