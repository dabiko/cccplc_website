<?php
require_once('utilities.php');
//require_once('errorhandler.php');
//require_once 'mailer/PHPMailer.php';
//require_once 'mailer/Exception.php';
//
//echo $_GET['data'];
//error handler function

function sorted($s) {
    $a = str_split($s);
    sort($a);
    return implode($a);
} 

$field_check= ["Other_Income_Sources", "Other_Sources_Details","Source_Of_Funds", "Marital_Type", "Spouse_Name", "Spouse_Profession", "Spouse_mobile_phone", "Spouse_email_address", "Children_Number", "children_mobile_phone", "Association_Name", "Association_Venue", "Association_President", "President_Contact", "Amount_requested", "Loan_security", "Principal_Payment_Means", "Other_Payment_Means", "Secondary_Payment_Means", "Current_Employer", "Employment_Date", "Matricule", "Employer_Mobile_Phone", "Employer_Email_Address", "Employer_Street", "Employer_Town", "Employer_Region", "Utility_Bills", "Social_Contributions", "Donations", "Health", "Other_Expenses", "Account_Other_Banks", "Name_Of_Banks", "Engagement_Other_Banks", "Engagement_Amounts"];

$dataJson=json_decode($_GET['data']);
    $i=0;
$errorMSG;
   
// 
//    $fields[] = "date_created";
    $fields[] = "date_modified";
     

//    $values[] = $_SESSION['ccc_cusid'];
//    $values[] ='0';
//    $values[] = date('Y-m-d H:i:s');
    $values[] = date('Y-m-d H:i:s'); 




    
foreach($dataJson as $key => $value) 
{
   
   $member =$key;   
  
    $pos = array_search(sorted($member), array_map("sorted", $field_check));

if($pos == false){
               
        if ($value==''){
            
            if ($i==0){
         $errorMSG= " The field ";
            }
           $errorMSG = $member.'     ';  
       $i++;
            break;
        }
    else if($member=='nomkey'){
            $account_id=$value;
        }
            else{
    //fill the require fields

    $fields[] = $member;
    
    $values[] = $value;
  


            }
}
else{
    
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
     $output;
    $output=$runQ->updateData('tb_loan', $fields, $values,'customer_id='.$_SESSION['ccc_cusid'].' and loan_id='.$account_id);
//    $output=$runQ->InsertData('tb_loan', $fields, $values);
  if($output===true){
     $errorMSG= "LOAN UPDATED SUCCESSFULLY";
     $error_msg=[0,$errorMSG];
      echo json_encode($error_msg);
     
  }else{
//       throw new Exception($output);
    
        $errorMSG=  "LOAN UPDATE Error: ".$output;
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