<?php
//validating request from form
require_once('utilities.php');

 $errorMSG='';
if (empty($_POST["username"])) {
    $errorMSG .= "username is required,  ";
} else {
   $username =$_POST['username'];
}

if (empty($_POST["password"])) {
   $password =$_POST['password'];
} else {
   $password =$_POST['password'];
}

if (empty($_POST["name"])) {
    $errorMSG .= "name is required,  ";
} else {
   $name =$_POST['name'];
}

if (empty($_POST["privil"])) {
    $errorMSG .= "priviledges is required,  ";
} else {
   $privil =$_POST['privil'];
}


if (empty($_POST["token_id"])) {
 $errorMSG .= "Security token key  ,  ";
   }
    else{
        $token=$_POST['token_id'];
    }

if (empty($_POST["uid"])) {
 $errorMSG .= "please you played with this form ,  ";
   }
    else{
        $uid=$_POST['uid'];
    }
//echo $condition.", ".$message.", ".$video.", ".$holder;
if( $errorMSG==''){
  $reginstance =new register;
  $jsonData = $reginstance->user_update($username,$password,$name,$privil,$token,$uid);
  die($jsonData);

}
else{
    die('uiderrorx280444444 msg:'.$errorMSG);
}



?>