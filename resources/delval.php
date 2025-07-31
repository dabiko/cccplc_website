<?php
require_once('utilities.php');
//require_once('errorhandler.php');
//require_once 'mailer/PHPMailer.php';
//require_once 'mailer/Exception.php';
 date_default_timezone_set('Africa/Douala'); 
  $tab = $_GET[ 'tab' ];
  $id = $_GET[ 'id' ];
  $customer = $_GET[ 'customer_id' ];
  $motif = $_GET[ 'motif' ];
  $status = $_GET[ 'status' ];

   
    
if (empty($tab)){
    
    $errorMSG="cannot read table data please contact admin !!";
}
if (empty($id)) {
    
  $errorMSG="cannot read data id please contact admin !!";
}
if (empty($customer)){
    
    $errorMSG="cannot read table data please contact admin !!";
}
if (empty($motif)) {
    
  $motif="NO REASON WAS SITED? ";
}

if ($tab=="tb_loan"){
 if ($_SESSION['ccc_privil']==270 || $_SESSION['ccc_privil']==300  ){
     
      
     
  $fields[] = "loan_id";
   $fields[] = "account_id";
      $values[] =$id;
      $values[] ='0';
   
     
 }
    else{
     $errorMSG="you are not authorized to validate loans contact admin!!".$_SESSION['ccc_privil'];    
        
    }
}
else {
    
  if ($_SESSION['ccc_privil']==280 || $_SESSION['ccc_privil']==300  ){
     
    
      $fields[] = "loan_id";
      $fields[] = "account_id";
     
      $values[] ='0';
      $values[] =$id;
     
 }  
    else{
        
           $errorMSG="you are not authorized to validate accounts contact admin!!";
    }
 
    
}

   $fields[] = "status";
    $fields[] = "controller";
    $fields[] = "date_created";
    $fields[] = "motif";
    $fields[] = "customer_id";
     

   
    $values[] =$status;
    $values[] =  $_SESSION['ccc_cususername'];
    $values[] = date('Y-m-d H:i:s');
    $values[] = $motif;   
    $values[] = $customer;  


if(empty($errorMSG)){
try{

    //fill the require fields
   
    
    //using our query controller class to dynamically insert data into our database
   $runQ = new QueryControllers();
    $output;
    if ($tab=="tb_loan"){
     $output=$runQ->updateData($tab, ['status'], [$status],'customer_id='.$customer.' and loan_id='.$id);     
    }else{
    $output=$runQ->updateData($tab, ['status'], [$status],'customer_id='.$customer.' and account_id='.$id);
    
    }
    $output_two=$runQ->InsertData('stat_tab', $fields, $values);
  if($output===true){
      if ($output_two===true){
     $errorMSG= "ACCOUNT UPDATED SUCCESSFULLY";
     $error_msg=[0,$errorMSG];
      echo json_encode($error_msg);
     
  }else{
//       throw new Exception($output);
    
        $errorMSG=  "ACCOUNT UPDATE AND INSERT Error: ".$output_two;
     $error_msg=[1,$errorMSG];
      echo json_encode($error_msg);
  }
}
    else{
//       throw new Exception($output);
    
        $errorMSG=  "ACCOUNT UPDATE Error: ".$output;
     $error_msg=[1,$errorMSG];
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