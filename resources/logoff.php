<?php
require_once 'utilities.php';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$page_title = 'CCC-LogOut';
/**
 * Created by PhpStorm.
 * User: dabik
 * Date: 04-Nov-17
 * Time: 2:31 AM
 */


$RunQuery = new QueryControllers();
$col[] = 'status';
$val[] = 0;
$col2[] = 'logout_time';
$col2[] = 'log_status';
date_default_timezone_set('Africa/Douala');
$val2[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
$val2[] = '0002';

$UpdateQuery1 = $RunQuery->UpdateData('users',$col,$val,'user_id ="'.$_SESSION['ccc_id'].'"');
$UpdateQuery2 = $RunQuery->UpdateData('user_logs',$col2,$val2,'user_id ="'.$_SESSION['ccc_id'].'" AND log_id="'.$_SESSION['logger'].'" ');

//$column[] = 'active_hours';
//$value[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
//$UpdateQuery = $RunQuery->UpdateData('admin_logs',$column,$value,'admin_id ="'.$_SESSION['admin_id'].'"');
$status=$RunQuery->signOut();
print $status;



//            $message = $userNames. 'had some errors trying to calculate the Total number of
//            Hours spent on the BLAST platform. Please try to rectify the situation ASAP. Thanks';
//            $column[] = 'admin_id';
//            $column[] = 'message';
//            $column[] = 'sender';
//            $column[] = 'error_date';
//
//            $value[] = $_SESSION['admin_id'];
//            $value[] = $message;
//            $value[] = 'BLAST - Automated Support';
//            date_default_timezone_set('Africa/Douala');
//            $value[] = date('Y-m-d H:i:s');
//            $InsertQuery = $RunQuery->InsertData('error_messages',$column,$value);
//            $RunQuery->signOut();






