<?php
//validating request from form
require_once('utilities.php');

 $errorMSG='';
if (empty($_POST["email"])) {
    $errorMSG .= "email is required,  ";
} else {
   $email =$_POST['email'];
}

if (empty($_POST["password"])) {
    $errorMSG .= "password is required,  ";
} else {
   $password =$_POST['password'];
}

if (empty($_POST["name"])) {
    $errorMSG .= "name is required,  ";
} else {
   $name =$_POST['name'];
}

if (empty($_POST["phone"])) {
    $errorMSG .= "phone number is required,  ";
} else {
   $phone =$_POST['phone'];
}


if (empty($_POST["token_id"])) {
 $errorMSG .= "Security token key  ,  ";
   }
    else{
        $token=$_POST['token_id'];
    }
//echo $condition.", ".$message.", ".$video.", ".$holder;

  $jsonData = register::user_insert($email,$password,$name,$phone,$token);
  die($jsonData);





?>