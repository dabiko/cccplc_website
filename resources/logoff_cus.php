<?php
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

require_once('utilities.php');
$RunQuery = new QueryControllers();
$col[] = 'status';
$val[] = 0;
$col2[] = 'log_status';

$val2[] = '0002';


$UpdateQuery1 = $RunQuery->UpdateData('customer_credentials',$col,$val,'customer_id ="'.$_SESSION['ccc_cusid'].'"');
$UpdateQuery2 = $RunQuery->UpdateData('customer_logs',$col2,$val2,'customer_id ="'.$_SESSION['ccc_cusid'].'"');
$col3[] = 'logout_time';
date_default_timezone_set('Africa/Douala');
$val3[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
$UpdateQuery2 = $RunQuery->UpdateData('customer_logs',$col3,$val3,'customer_id ="'.$_SESSION['ccc_cusid'].'" AND log_id="'.$_SESSION['logger'].'" ');

//$column[] = 'active_hours';
//$value[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
//$UpdateQuery = $RunQuery->UpdateData('admin_logs',$column,$value,'admin_id ="'.$_SESSION['admin_id'].'"');
$status=$RunQuery->signcusOut();
print $status;
