<?php

/**
 * Created by PhpStorm.
 * User: dabik
 * Date: 03-Nov-17
 * Time: 9:18 PM
 */

require_once 'resources/utilities.php';


$RunQuery = new QueryControllers();
$SecurityQuery = new Security();

$error =  array(0,1,2,3);
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){

        $user_username = $_POST['username'];
        $user_password = $_POST['password'];

        isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = "";
        if (!empty($user_username) && !empty($user_password)) {


            /** @var  $SelectQuery,check if user exist in the database */
            $SelectQuery = $RunQuery->SelectData('*','customer_credentials','email = "'.$user_username.'"');
           
            if($RunQuery->getrow_num() == 1){
                foreach ($SelectQuery as $row){

                    $dbPassword = $row['password'];

                    $user_id = $row['customer_id'];
                    $username = $row['name'];
                    $remember = $row['authenticate'];
                    $privil= $row['privil_id'];
                    $privil_id= $row['privil_id'];
                    

 

                            if ($RunQuery->password_auth($user_password,$dbPassword)) {
                            $RunQuery->prepcusLogin($user_id, $username, $remember,$privil_id);

                            /** Inserting  data into User_logs Table*/
                            $columns[] = 'customer_id';
                            $columns[] = 'log_status';
                            $columns[] = 'login_time';
                            $columns[] = 'logout_time';
                            $_SESSION['ccc_privil']= $privil;
                            $values[] = $user_id;
                            $values[] = '0001';
                            date_default_timezone_set('Africa/Douala');
                            $values[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
                            $values[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));

                            $InsertQuery = $RunQuery->InsertData('customer_logs',$columns,$values);
                            $getQuery = $RunQuery->SelectData('*','customer_logs','customer_id = "'.$user_id.'"  order by log_id DESC limit 1');
                                 foreach ($getQuery as $row2){
                            $_SESSION['logger'] = $row2['log_id'];
                                 }
                                $col = 'status';
                                $val = 1;
                                $activeQuery = $RunQuery->UpdateData('customer_credentials',$col,$val,' customer_id = "'.$user_id.'"');






                        header("Content-Type: application/json");

                        /** @var  $arr, sending users names back to ajax as json data */
                        $arr = array();
                        $jsonData = '{"results":[';
                        $jsonObject = new stdClass();
                        $jsonObject->cccplcname = $username;
                        $arr[] = json_encode($jsonObject);
                        $jsonData .= implode(",", $arr);
                        $jsonData .= ']}';

                        echo $jsonData;

                        }else {
                            echo $error[3];
                        }

                }

            }else {

                echo $error[2];
            }





        } else {
            echo $error[1];
        }



}else{
    echo $error[0];
}
