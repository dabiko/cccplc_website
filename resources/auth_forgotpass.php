<?php

 $forgot_username; 
 $forgot_cus_id;
 $forgot_email;
function auth_codecheck($auth){
    
    
    
if(!empty($auth)){
try{
    
    
 $RunQuery = new QueryControllers();
$SecurityQuery = new Security();



                  $forgot_username; 
                  $forgot_cus_id;
               

            /** @var  $SelectQuery,check if user exist in the database */
            $SelectQuery = $RunQuery->SelectData('*',' reset_ctl AS n INNER JOIN customer_credentials AS t ON n.user_id = t.customer_id and n.reset_status="0001" and reset_code="'.$auth.'" ORDER BY n.user_id ASC ','');
           
            if($RunQuery->getrow_num() == 1){
                foreach ($SelectQuery as $row){

                    $_SESSION['forgot_cus_id'] = $row['customer_id'];
                    $_SESSION['forgot_username'] = $row['name'];
                   $_SESSION['forgot_reset_id'] = $row['reset_id'];
                }
    return true;
    
}
    else{
        
        echo "FAILED : TO RETRIEVE SECURITY TOKEN , PLEASE TRY TO RESET YOUR PASSWORD AGAIN AT <br> <a href='reset.php'> CLICK TO RESET </a>";
    }
} 
    catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
}
else{
 

   echo "<b style='color:red;'>SORRY AUTHENTICATION CODE IS EMPTY OR INVALID </b>";
}
}
?>