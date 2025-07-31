<?php
require_once 'resources/utilities.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer_update/Exception.php';
require 'mailer_update/PHPMailer.php';
require 'mailer_update/SMTP.php';


//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

if (empty($_POST["username"])) {
    $errorMSG = "please enter a valid email address";
} else {
    $name = $_POST['username'];
   
}












if(empty($errorMSG)){
try{
    
    
 $RunQuery = new QueryControllers();
$SecurityQuery = new Security();

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){

        $user_username = $_POST['username'];
       
        
                    $dbPassword;
                    $user_id;
                    $username;

            /** @var  $SelectQuery,check if user exist in the database */
            $SelectQuery = $RunQuery->SelectData('*','customer_credentials','email = "'.$user_username.'"');
           
            if($RunQuery->getrow_num() == 1){
                foreach ($SelectQuery as $row){

                    $dbPassword = $row['email'];

                    $user_id = $row['customer_id'];
                    $username = $row['name'];
                }
                    $reset_code=$user_id.''.rand(1000,1000000).''.round(microtime(true));

                            /** Inserting  data into User_logs Table*/
                            $columns[] = 'user_id';
                            $columns[] = 'reset_code';
                            $columns[] = 'reset_status';
                            $columns[] = 'gen_time';
                            $columns[] = 'reset_time';
                           
                            $values[] = $user_id;
                            $values[] = $reset_code;
                            $values[] = '0001';
                    
                            date_default_timezone_set('Africa/Douala');
                            
                            $values[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
                            $values[] = null;
                           
                
                            $fields[] = 'reset_status';
                            $val[] = '0002';
                            $output=$RunQuery->updateData('reset_ctl', $fields, $val,'user_id='.$user_id.' and reset_status="0001"');
                          if($output===true){

                            $InsertQuery = $RunQuery->InsertData('reset_ctl',$columns,$values);

                            if($InsertQuery===true){

                            $email = new PHPMailer();
                            $email->IsSMTP();
                            $email->IsHTML(true);
                            $email->Mailer = 'smtp';
                            $email->SMTPSecure = 'ssl';
                            $email->Port = 465;
                            // $email->From = $emailer;
                            // $email->FromName = $name;
                            $email->Host = "smtp.ipage.com";
                            $email->SMTPAuth = true;
                            $email->Username = "noreply@cccplc.net";
                            $email->Password = "Santa123@@@";

                            $email->SetFrom("website@cccplc.net", $name); //Name is optional
                            $email->Subject = "PASSWORD RESET CCC PLC ONLINE";
                            $email->Body ="<b>HELLO  !! ".$username." YOU REQUESTED FOR A PASSWORD RESET ON CCC PLC ONLINE </b> <br>
                            <b> CLICK THE LINK BELOW TO RESET YOUR PASSWORD: </b> <br><br> <a href='www.cccplc.net/resetmypass.php?auth_code=".$reset_code."' target='_blank'> www.cccplc.net/forgotpass.php?auth_code=".$reset_code." </a> <br><br> <u> FOR YOUR SECURITY DO NOT SHARE THIS LINK </u>";
                            $email->AddAddress($dbPassword);


                            if(!$email->Send()){
                            $_SESSION['msg']= "Mailer Error: " . $email->ErrorInfo;
                            echo $_SESSION['msg'];
                            }
                            else{

                                echo 1;

                            }

                            }
                           else{
                            // throw new Exception($output);

                            $errorMSG= "FAILED TO INSERT SECURITY CODE Error: ".$InsertQuery;
                            echo $errorMSG;
                            }
                          }else {
                               $errorMSG= "FAILED TO UPDATE OLD TOKEN SECURITY CODE Error: ".$output."CONTACT TECHNICAL TEAM USING OUR CONTACT US FORM";
                            echo $errorMSG;
                          }
    
    
    
    
    
    
    
    
    
    
    
    
    

            }
    else {
        echo "SORRY THIS USER DOES NOT EXIST IN OUR SYSTEM";
    }
}
} 
    catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
}
else{
  $_SESSION['msg']= $errorMSG;

   echo $_SESSION['msg'];
}
?>