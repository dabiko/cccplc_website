<?php
//validating request from form
require_once('utilities.php');


$errorMSG="";

if (empty($_POST["privil"])) {
   $errorMSG .= "Please Enter Category Name ,  ";
} else {
    $values[] =0;
    $values[] =$_POST['privil'];
    $privil =$_POST['privil'];
}

if (empty($_POST["status"])) {
$status=5;
} else {
   $status =$_POST['status'];
}

if (empty($_POST["program_id"])) {
  $errorMSG .= "This Form has been manipulated with contact Software Admin  ,  ";
} else {
   $pid =$_POST['program_id'];
     $values[] =$_POST['program_id'];
}





//echo $condition.", ".$message.", ".$video.", ".$holder;
if( $errorMSG ==''){
    //fill the require fields
    
    $fields[] = "prog_cat_id";
    $fields[] = "cat_id";
    $fields[] = "prog_id";
    $fields[] = "user_id";
    $fields[] = "last_modified";
    
     $values[] = $_SESSION['ccc_id']; 
    $values[] = date('Y-m-d H:i:s'); 
   

    
    //using our query controller class to dynamically insert data into our database
   $runQ = new QueryControllers();
if ($status==5){
  if($ouput=$runQ->InsertData('prog_cat',$fields,$values)){
      die('1');
  }

else{
    die('uiderrorx280444555555444 msg:'.$errorMSG);
  }
}
     else{
      
      if($jsonData = $runQ->DeleteMData('prog_cat','cat_id='.$privil.' AND prog_id='.$pid.'')){
      die('1');
  }

else{
    die('uiderrorx28044445555555544 msg:'.$errorMSG);
}

      
      
      
  }
}
     else{
    die('uiderrorx280444444 msg:'.$errorMSG);
}


