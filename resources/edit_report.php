<?php
//validating request from form
require_once('utilities.php');


$errorMSG="";

if (empty($_POST["program"])) {
   $errorMSG .= "Please Enter Program Name ,  ";
} else {
    $values[] =$_POST['program'];
}

if (empty($_POST["report"])) {
  $errorMSG .= "Report name is empty  ,  ";
} else {
   $values[] =$_POST['report'];
}

if (empty($_POST["program_id"])) {
  $errorMSG .= "This Form has been manipulated with contact Software Admin  ,  ";
} else {
   $pid =$_POST['program_id'];
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
    $fields[] = "Program_Name";
    $fields[] = "Report_Name";
    $fields[] = "Date_Modified";
    $fields[] = "User_ID";
    
    $values[] = date('Y-m-d H:i:s'); 
    $values[] = $_SESSION['ccc_id']; 

    
    //using our query controller class to dynamically insert data into our database
   $runQ = new QueryControllers();
  if($ouput=$runQ->UpdateData('prog', $fields, $values,'Program_ID='.$pid)){
      die('1');
  }
}
else{
    die('uiderrorx280444444 msg:'.$errorMSG);
}
