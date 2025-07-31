<?php
//validating request from form
require_once('utilities.php');


$errorMSG="";


if (empty($_POST["cat"])) {
  $errorMSG .= "Please Enter Category Name ,  ";
} else {
   $values[] =$_POST['cat'];
}

if (empty($_POST["cat_id"])) {
  $errorMSG .= "This Form has been manipulated with contact Software Admin  ,  ";
} else {
   $pid =$_POST['cat_id'];
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
    $fields[] = "cat_name";
    $fields[] = "Date_Modified";
    $fields[] = "User_ID";
    
    $values[] = date('Y-m-d H:i:s'); 
    $values[] = $_SESSION['ccc_id']; 

    
    //using our query controller class to dynamically insert data into our database
   $runQ = new QueryControllers();
  if($ouput=$runQ->UpdateData('cat', $fields, $values,'cat_id='.$pid)){
      die('1');
  }
}
else{
    die('uiderrorx280444444 msg:'.$errorMSG);
}
