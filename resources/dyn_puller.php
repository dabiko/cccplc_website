<?php
  require_once( "utilities.php" );
//if($_GET[ 'last_id' ]==''){
//   $last_id=0; 
//}
  $tab = $_GET[ 'tab' ];
$test= new dynamic_puller;
switch ($tab){
  
    CASE "accounts":
        
        $jsonData=$test->get_accounts($tab);
        
        BREAK;
        
    CASE "tb_loan":
        
        $jsonData=$test->get_loans('tb_loan');
        
        BREAK;
        
CASE "statistics":
        
        $jsonData=$test->get_stats();
        
        BREAK;    
        
    CASE "customer_logs":
   
$jsonData=$test->get_cus_table($tab,"'log_id','log_status','login_time','logout_time'","log_id,log_status,login_time,logout_time",'customer_id='.$_SESSION['ccc_cusid']);
        
        BREAK;
        
    CASE "accounts_bak":
   
$jsonData=$test->get_accounts_bak('accounts');
        
        BREAK;
        
    CASE "tb_loans_bak":
   
$jsonData=$test->get_loans_bak('tb_loan');
        
        BREAK;
        
    CASE "cv_bak":
   
$jsonData=$test->get_cv_bak('hr');
        
        BREAK;
        
    DEFAULT:
        
        BREAK;
        
}
print $jsonData;
?>