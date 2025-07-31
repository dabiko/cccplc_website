<?php
//validating request from form
require_once('utilities.php');



$errorMSG='';
if (empty($_POST["parent_id"])) {
  $errorMSG .= "object id is missing  ,  ";
} else {
   $parent =$_POST["parent_id"];
}

if (empty($_POST["sys"])) {
  $errorMSG .= "This Form has  been manipulated with tab_name missing  ,  ";
} else {
   $table =$_POST['sys'];
}

if (empty($_POST["sys_id"])) {
  $errorMSG .= "This Form has  been manipulated with tab_id missing  ,  ";
} else {
   $sys_id =$_POST['sys_id'];
}


//if (empty($_POST["post_id"])) {
//   $post=0;
//} else {
//   $post =$_POST['post_id'];
    
//}

if( $errorMSG ==''){


    
    //using our query controller class to dynamically insert data into our database
  $runQ = new QueryControllers();
  if($jsonData = $runQ->DeleteData($table,$sys_id,$parent)){
      die('1');
  }
}
else{
    die('uiderrorx280444444 msg:'.$errorMSG);
}


  
?>