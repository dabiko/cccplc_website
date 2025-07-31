<?php
require_once('utilities.php');
//require_once('errorhandler.php');
//require_once 'mailer/PHPMailer.php';
//require_once 'mailer/Exception.php';
//
//echo $_GET['data'];
//error handler function

$dataJson=json_decode($_GET['data']);
    $i=0;
$errorMSG;
   
//    $fields[] = "date_created";
    $fields[] = "date_updated";
     
  
//    $values[] = date('Y-m-d H:i:s');
    $values[] = date('Y-m-d H:i:s'); 
    
foreach($dataJson as $key => $value) 
{
   
   $member =$key;   
  
               
        if ($value==''){
            if ($i==0){
         $errorMSG= " The field ";
            }
           $errorMSG = $member.'     ';  
       $i++;
            break;
        } else if($member=='nomkey'){
            $account_id=$value;
        }
            else{
    //fill the require fields

    $fields[] = $member;
    
    $values[] = $value;
  


            }
            
}


 
if(empty($errorMSG)){
try{

    //fill the require fields
   
    
    //using our query controller class to dynamically insert data into our database
   $runQ = new QueryControllers();
    $output;
    $output=$runQ->updateData('accounts', $fields, $values,'customer_id='.$_SESSION['ccc_cusid'].' and account_id='.$account_id);
  if($output===true){
     $errorMSG= "ACCOUNT UPDATED SUCCESSFULLY";
     $error_msg=[0,$errorMSG];
      echo json_encode($error_msg);
     
  }else{
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
     $id_card=$errorMSG;
    $errorMSG.=" is required ";
    $error_msg=[1,$errorMSG,$id_card];
    
  echo json_encode($error_msg);
}






?>