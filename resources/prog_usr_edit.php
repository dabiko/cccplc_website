<?php
//validating request from form
require_once('utilities.php');


$errorMSG="";

if (empty($_POST["privil"])) {
   $errorMSG .= "Please Enter User Name ,  ";
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
    
    $fields[] = "prog_user_id";
    $fields[] = "user_id";
    $fields[] = "prog_id";
    $fields[] = "creator_id";
    $fields[] = "status";
    $fields[] = "last_modified";
   
    
     $values[] = $_SESSION['ccc_id']; 
    
    
    //using our query controller class to dynamically insert data into our database
   $query = new QueryControllers();
   $runQ = new QueryControllers();
if ($status==5){
     $values[] =1;
    $values[] = date('Y-m-d H:i:s'); 
   

    $query->SelectData(['prog_user_id','user_id','status','prog_id'],'prog_user','prog_id='.$pid.' and user_id='.$privil.'  ORDER BY prog_user_id ASC'); 
             
        //testing condition B AND condition C  
        if($query->getrow_num() >= 1){
    
          if($jsonData = $runQ->UpdateData('prog_user',"status",1,'user_id='.$privil.' AND prog_id='.$pid.'')){
      die('1');
  }

else{
    die('uiderrorx2804444555555553333 msg:'.$errorMSG);
}
    
  
    
                     }
    else{
        
      if($runQ->InsertData('prog_user',$fields,$values)){
      die('1');
      }

   else{
    die('uiderrorx280444555555444 msg:'.$errorMSG);
      }   
        
        
    }
    
    
}
     else{
//          $col[] = "status";
//          $val[] = 0;
      
   $query->SelectData(['prog_user_id','user_id','status','prog_id'],'prog_user','prog_id='.$pid.' and user_id='.$privil.'  ORDER BY prog_user_id ASC'); 
             
          $values[] =0;
    $values[] = date('Y-m-d H:i:s'); 
   

        //testing condition B AND condition C  
        if($query->getrow_num() >= 1){
    
          if($jsonData = $runQ->UpdateData('prog_user',"status",0,'user_id='.$privil.' AND prog_id='.$pid.'')){
      die('1');
  }

else{
    die('uiderrorx2804444555555553333 msg:'.$errorMSG);
}
    
  
    
                     }
    else{
        
      if($runQ->InsertData('prog_user',$fields,$values)){
      die('1');
      }

   else{
    die('uiderrorx280444555555444 msg:'.$errorMSG);
      }   
        
        
    }       
         
         
      
  }
}
     else{
    die('uiderrorx280444444 msg:'.$errorMSG);
}


