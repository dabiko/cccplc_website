<?php 
/**
 * Created by PhpStorm.
 * User: dabik
 * Date: 15-Oct-17
 * Time: 3:54 PM
 */
require_once 'Database.php';
require_once 'encrypt.php';
session_start();
class convertToAgo{
    public function convert_datetime($str){
        date_default_timezone_set('Africa/Douala'); 
        [$date, $time] = explode(' ', $str);
        [$year, $month, $day] = explode('-', $date);
        [$hours, $minute, $seconds] = explode(':', $time);
        return mktime($hours,$minute,$seconds,$month,$day,$year);

    }

    public function makeAgo($timestamp){
        date_default_timezone_set('Africa/Douala');
        $difference = time()-$timestamp;
        $periods = ["Second","Minute","Hour","Day","Week","Month","Year","Decade"];
        $lengths = ["60","60","24","7","4","35","12","10"];
        for($i = 0;
            $difference >= $lengths[$i]; $i++)
            $difference /= $lengths[$i];
        $difference = round($difference);
        if ($difference != 1) $periods[$i] .= "s";
        $output = "$difference $periods[$i]";
        return $output." ago";

    }
} // Ago Class Ends Here


class QueryControllers{
    /**
     * @param $table, to Insert data .
     * @param $column_name, will contain the various columns/fields (as an array) in the database.
     * @param $values, will contain the various values/rows (as an array) to be inserted in the database.
     * @return true if successful and false (with errors) in case of any failure
     */

    /** @var. to be able to get the last inserted ID in the database */
    private $lastInsertId;
    private $row_num;

    public function InsertCsvData($table, $column_name, $values) {
        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

        // Clean duplicate columns and sync with values
        if (is_array($column_name) && is_array($values)) {
            $unique_columns = [];
            $unique_values = [];

            foreach ($column_name as $index => $col) {
                if (!in_array($col, $unique_columns, true)) {
                    $unique_columns[] = $col;
                    $unique_values[] = $values[$index];
                }
            }

            $column_name = $unique_columns;
            $values = $unique_values;
        }

        // Build columns
        $buildColumns = is_array($column_name) ? implode(', ', $column_name) : $column_name;

        // Build placeholders
        if (is_array($values)) {
            $buildValues = implode(', ', array_fill(0, count($values), '?'));
        } else {
            $buildValues = ':value';
        }

        // Prepare and execute the insert
        $InsertQuery = "INSERT INTO $table ($buildColumns) VALUES ($buildValues)";
        $statement = $adb->prepare($InsertQuery);

        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute([':value' => $values]);
        }

        $this->lastInsertId = $adb->lastInsertId();

        $errorMessage = $statement->errorInfo()[2];
        return ($errorMessage !== "") ? $errorMessage : true;
    }

   public function InsertData($table, $column_name, $values){
      // global $user_id;
        $errorMessage;
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

        //build the columns and loop through the column(s) given
        $buildColumns = '';
        if (is_array($column_name)) {
            //loop through all the columns
            foreach($column_name as $key => $columns) {
                if ($key == 0) {
                    //first column(s) item
                    $buildColumns .= $columns;
                } else {
                    //every other column name follows with a ","
                    $buildColumns .= ', '.$columns;
                }
            }
        } else {
            //this will insert just one field (row) onto the database
            $buildColumns .= $column_name;
        }


        //build the values and loop through the value(s) given
        $buildValues = '';
        if (is_array($values)) {
            //loop through all the fields
            foreach($values as $key => $value) {
                if ($key == 0) {
                    //first value(s) item
                    $buildValues .= '?';
                } else {
                    //every other value(s) or field(s) follows with a ","
                    $buildValues .= ', ?';
                }
            }
        } else {
            //this will insert just one field (row into the database)
            $buildValues .= ':value';
        }

               //Insert query
               $InsertQuery ="INSERT INTO ".$table." (".$buildColumns.") VALUES(".$buildValues.")";
               $statement = $adb->prepare($InsertQuery);
               //execute the Insert for one or many values
               if (is_array($values)) {
                   $statement->execute($values);

               } else {
                   $statement->execute(array(':value' => $values ));

               }
                  // Declaring a lastInsert variable using PDO::lastInsertId() method
                 $lastInsertId = $adb->lastInsertId();

               //setting the Private $lastInsert private  variable  to the last Id from the database
                 $this->lastInsertId = $lastInsertId;


        /**record and print any database error that might occur */
        $errorMessage = $statement->errorInfo()[2];
        if ($errorMessage!="") {
//       return ($errorMessage);
            return ($statement->errorInfo()[2]);
        } else {
            return true;
        }
    

    }


   public function checkDuplicateCardRecord(string $table, array $conditions): bool {
        // TODO: Validate $table and column names against a whitelist to prevent injection.
        if (empty($conditions)) {
            throw new InvalidArgumentException('Conditions cannot be empty.');
        }

        $columns = array_keys($conditions);
        $placeholders = [];
        $params = [];

        foreach ($columns as $col) {
            // Ideally validate $col is a permitted column name here.
            $placeholders[] = "`$col` = ?";
            $params[] = $conditions[$col];
        }

        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $where = implode(' AND ', $placeholders);
        $sql = "SELECT EXISTS(SELECT 1 FROM `$table` WHERE $where)";

        $stmt = $adb->prepare($sql);
        $stmt->execute($params);
        $exists = $stmt->fetchColumn();

        return (bool)$exists;
    }


    /**
     * @return mixed
     */
    /**
     * @return mixed
     */
    public function getLastInsertId()
    {
        return $this->lastInsertId;
    }
    
    
    public function getrow_num()
    {
        return $this->row_num;
    }

    /**
     * @param $table, to Select (Retrieve) data from.
     * @param $column_name, will contain the various columns/fields (as an array) in the database.
     * @return true if successful and false (with errors) in case of any failure
     */

    public function SelectData($column_name,$table,$condition){
       
        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

        //build the columns and loop through the column(s) given
        $buildSelect = '';
        if (is_array($column_name)) {
            //loop through all the columns
            foreach($column_name as $key => $columns) {
                if ($key == 0) {
                    //first column(s) item
                    $buildSelect .= $columns;
                } else {
                    //every other item follows with a ","
                    $buildSelect .= ', '.$columns;
                }
            }
        } else {
            //this will select just one field
            $buildSelect .= $column_name;
        }


     //Select Query
        if($condition==''){
        $SelectQuery =" SELECT ".$buildSelect." FROM ".$table."  ";
        }
        else{
            $SelectQuery =" SELECT ".$buildSelect." FROM ".$table." WHERE ".$condition." "; 
        }
        $statement = $adb->prepare($SelectQuery);

        //execute the Select for one or many values
        $statement->execute();
         
         $this->row_num = $statement->rowCount();
        $SelectData = $statement->fetchAll(PDO::FETCH_ASSOC);
        //echo $data;


        /**record and print any database error that might occur */
       $errorMessage = $statement->errorInfo()[2];
        if ($this->row_num<1) {
             return  $errorMessage;
        } else {
            return $SelectData;
        }

    }

    /**
     * @param $table, to Update data .
     * @param $column_name, will contain the various columns/fields (as an array) in the database.
     * @param $values, will contain the various values (as an array)  provided when calling the UpdateData function.
     * @param $where, specifying which row/columns are to be updated.
     * @return true if successful and false (with errors) in case of any failure
     */
   public function UpdateData($table, $column_name, $values,$where){
        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

        //build the field to value correlation (Establishing connection between two or more Variables.)
        $buildUpdate = '';
        if (is_array($column_name)) {

            //loop through all the fields and assign them to the correlating $values
            foreach($column_name as $key => $field) :
                if ($key == 0) {
                    //first item
                    $buildUpdate .= $field.' = ?';
                } else {
                    //every other item follows with a ","
                    $buildUpdate .= ', '.$field.' = ?';
                }
            endforeach;

        } else {
            //updating just one field
            $buildUpdate .= $column_name.' = :value';
        }

        $UpdateQuery =" UPDATE ".$table." SET ".$buildUpdate." WHERE ".$where." ";
        $statement = $adb->prepare($UpdateQuery);

        //execute the update for one or many values
        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute(array(':value' => $values));
        }


        /**record and print any database error that might occur */
      $errorMessage = $statement->errorInfo()[2];
        if ($errorMessage!="") {
//       return ($errorMessage);
            return ($statement->errorInfo()[2]);
        } else {
            return true;
        }

    }

    /**
     * @param $table, to Delete data from.
     * @param $column_name, will contain the various columns/fields (as an array) in the database.
     * @param $values, will contain the various values (as an array) provided when calling the DeleteData function.
     * @return true if successful and false (with errors) in case of any failure
     */

    public function DeleteData($table, $column_name, $values){


        //build the columns and loop through the column(s) given
        $buildColumns = '';
        if (is_array($column_name)) {
            //loop through all the columns
            foreach($column_name as $key => $columns) {
                if ($key == 0) {
                    //first column(s) item
                    $buildColumns .= $columns;
                } else {
                    //every other item follows with a ","
                    $buildColumns .= ', '.$columns;
                }
            }
        } else {
            //we are only inserting one field
            $buildColumns .= $column_name;
        }


        //build the values and loop through the value(s) given
        $buildValues = '';
        if (is_array($values)) {
            //loop through all the fields
            foreach($values as $key => $value) {
                if ($key == 0) {
                    //first value(s) item
                    $buildValues .= '?';
                } else {
                    //every other item follows with a ","
                    $buildValues .= ', ?';
                }
            }
        } else {
            //this will insert just one field
            $buildValues .= ':value';
        }

     $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
     $DeleteQuery =" DELETE FROM ".$table." WHERE ".$buildColumns." = $buildValues ";
     $statement = $adb->prepare($DeleteQuery);

    ;
        //execute the Delete for one or many values
        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute(array(':value' => $values));
        }

        /**record and print any database error that might occur */
        $errorMessage = $statement->errorInfo();
        if ($errorMessage[1]) {
            return ($errorMessage[2]);
        } else {
            return true;
        }
        return false;

    }

    
    
    
//.........................multiple delete update    
 public function DeleteMData($table,  $condition){


       
     $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
     $DeleteQuery =" DELETE FROM ".$table." WHERE ".$condition." ";
     $statement = $adb->prepare($DeleteQuery);

    ;
        //execute the Delete for one or many values
      
            $statement->execute();
        
        /**record and print any database error that might occur */
        $errorMessage = $statement->errorInfo();
        if ($errorMessage[1]) {
            print_r($errorMessage[2]);
        } else {
            return true;
        }
        return false;

    }   
    
    
    
    
    
    
    
    
    
    
    
    
    

    /**
     * @param $table, to get the total number of rows.
     * @param $column_name, will contain the various columns/fields (as an array) in the database.
     * @param $values, will contain the various values (as an array) provided when calling the getRowCount function.
     * @return true if successful and false (with errors) in case of any failure
     */
    public function getRowCount($table,$column_name,$values){

        //build the columns and loop through the column(s) given
        $buildColumns = '';
        if (is_array($column_name)) {
            //loop through all the columns
            foreach($column_name as $key => $columns) {
                if ($key == 0) {
                    //first column(s) item
                    $buildColumns .= $columns;
                } else {
                    //every other item follows with a ","
                    $buildColumns .= ', '.$columns;
                }
            }
        } else {
            //we are only inserting one field
            $buildColumns .= $column_name;
        }


        //build the values and loop through the value(s) given
        $buildValues = '';
        if (is_array($values)) {
            //loop through all the fields
            foreach($values as $key => $value) {
                if ($key == 0) {
                    //first value(s) item
                    $buildValues .= '?';
                } else {
                    //every other item follows with a ","
                    $buildValues .= ', ?';
                }
            }
        } else {
            //this will insert just one field
            $buildValues .= ':value';
        }

        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $columnQuery =" SELECT * FROM ".$table." WHERE ".$buildColumns." = $buildValues ";
        $statement = $adb->prepare($columnQuery);
        //execute the Query
        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute(array(':value' => $values));
        }
        $data =  $statement->rowCount();
    
        /**record and print any database error that might occur */
        $errorMessage = $statement->errorInfo();
        if ($errorMessage[1]) {
            print_r($errorMessage[2]);
        } else {
            return $data;;
        }
      
    }



    /**
     * @param $page, will direct the user the home page.
     */
    public function redirectToPage($page){
      header("location: {$page}");
    }

    /** @param $value, to clean all output data drom the database
     * @return*/
    public function clean($value) {
        return htmlspecialchars(($value), ENT_QUOTES,'UTF_8');
    }

    /** function to generate random token */
    public function _token(){
        $randomToken = base64_encode(openssl_random_pseudo_bytes(32));
        return $_SESSION['token'] = $randomToken;
    }

   public function validate_token($requestToken){
        if(isset($_SESSION['_token']) && $requestToken === $_SESSION['_token']){
            //unset($_SESSION['token']);
            return true;
        }
        return false;
    }

/**
 * @param $data, to be encoded
 *  @param $pad, to be encoded
 * @return true for the encoded $data
 */
    public function encodeData($data, $pad = null) {
        $data = str_replace(array('+', '/'), array('-', '_'), base64_encode($data));
        if (!$pad) {
            $data = rtrim($data, '=');
        }
        return $data;
    }

    /**
     * @param $data, to be decoded
     * @return true for the decoded $data
     */
    public function decodeData($data) {
        return base64_decode(str_replace(array('-', '_'), array('+', '/'), $data));
    }

     /* @param $page, will direct the user the required page.
     * @param $id, will direct the user the $page with the ID.
     */
    public function redirectToPageID($page,$id){
       header("location: {$page}.php?id={$id}");
    }

    /**
     * @param $page, will direct the user the home page.
     */
  

    /** @param $variable, to clean all output data from the database
     * @return*/
    public function filter($variable) {
        return filter_var($variable,FILTER_SANITIZE_STRIPPED);
        //return htmlspecialchars($variable, ENT_QUOTES,'UTF-8');
    }




    /** @param $user_id, will be encoded*/

    function rememberMe($user_id){

        $encryptCookieData = base64_encode("MFbi35GIzsExm9cL4c3bilTXA{$user_id}");
        // cookie set to expire in  30 days
        setcookie("cccUserCookie", $encryptCookieData, time()+60*60*24*30, "/");
    }
    
        function rememberMMe($user_id){

        $encryptCookieData = base64_encode("MFbi35GIzsExm9cL4c3bilTXA{$user_id}");
        // cookie set to expire in  30 days
        setcookie("ccccusUserCookie", $encryptCookieData, time()+60*60*24*30, "/");
    }


    function isCookieValid($adb){



        //setting the cookie to false by default
        $isValid = false;

        if (isset($_COOKIE['cccUserCookie'])) {
            /**
             * Decode cookie and extract user ID
             */
            $decryptCookieData = base64_decode($_COOKIE['cccUserCookie']);
            $user_id = explode("MFbi35GIzsExm9cL4c3bilTXA", $decryptCookieData);
            $userID = $user_id[1];

            /**
             * check if id retrieved from the cookie exits in the database
             */
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $sqlQuery = "SELECT * FROM users WHERE user_id = :user_id";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute([':user_id' => $userID]);

            if ($row = $statement->fetch()){
                $user_id = $row['user_id'];
                $username = $row['name'];

                /**
                 * create the user session variable
                 */
                $_SESSION['ccc_id'] = $user_id;
                $_SESSION['ccc_username'] = $username;
                $isValid = true;
            } else {
                /**
                 * cookie ID is invalid destroy session and logout user
                 */
                $isValid = false;
                $RunQuery = new QueryControllers();
                $RunQuery->signOut();
            }
        }
        return $isValid;
    }

    function iscusCookieValid($adb){



        //setting the cookie to false by default
        $isValid = false;

        if (isset($_COOKIE['ccccusUserCookie'])) {
            /**
             * Decode cookie and extract user ID
             */
            $decryptCookieData = base64_decode($_COOKIE['ccccusUserCookie']);
            $user_id = explode("MFbi35GIzsExm9cL4c3bilTXA", $decryptCookieData);
            $userID = $user_id[1];

            /**
             * check if id retrieved from the cookie exits in the database
             */
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $sqlQuery = "SELECT * FROM customer_credentials WHERE customer_id = :user_id";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute([':user_id' => $userID]);

            if ($row = $statement->fetch()){
                $user_id = $row['customer_id'];
                $username = $row['name'];
                $privil = $row['privil_id'];

                /**
                 * create the user session variable
                 */
                $_SESSION['ccc_cusid'] = $user_id;
                $_SESSION['ccc_cususername'] = $username;
                $_SESSION['ccc_privil'] = $privil;
                $isValid = true;
            } else {
                /**
                 * cookie ID is invalid destroy session and logout user
                 */
                $isValid = false;
                $RunQuery = new QueryControllers();
                $RunQuery->signcusOut();
            }
        }
        return $isValid;
    }

    /**This function  will signOut the user and destroy the previous user cookie */
    function signOut(){
try {

    unset($_SESSION['ccc_username'], $_SESSION['ccc_id'], $_SESSION['log_id']);

    if(isset($_COOKIE['cccUserCookie'])){
            unset($_COOKIE['cccUserCookie']);
            //setcookie('cccUserCookie', null, -1, '/');
            setcookie('cccUserCookie', '', time() - 3600, '/'); // set expiry in the past
        }
//        session_destroy();
//        session_regenerate_id(true);
        $RunQuery = new QueryControllers();
    return 0;
      
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
    return $error;
}
    }
    
    
     function signcusOut(){
try {
    unset($_SESSION['ccc_cususername'], $_SESSION['ccc_cusid'], $_SESSION['ccc_privil'], $_SESSION['log_id']);

    if(isset($_COOKIE['ccccusUserCookie'])){
            unset($_COOKIE['ccccusUserCookie']);
            //setcookie('ccccusUserCookie', null, -1, '/');
            setcookie('ccccusUserCookie', '', time() - 3600, '/'); // set expiry in the past
        }
//        session_destroy();
//        session_regenerate_id(true);
        $RunQuery = new QueryControllers();
    return 0;
      
}   catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
    return $error;
}
    
     }
    
    

    /** Guard function that will sign out the user if the user is inactive for the specified duration in the function */
    function guard(){

        $isValid = true;
        $inactive = 60*30; //2 mins
        $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

        if(isset($_SESSION['fingerprint']) && $_SERVER['HTTP_USER_AGENT'] != $fingerprint){
            $isValid = false;
            $RunQuery = new QueryControllers();
            $RunQuery->signOut();

        }else if((isset($_SESSION['last_active']) && (time() - $_SESSION['last_active']) > $inactive) && $_SESSION['ccc_username']){
            $isValid = false;
            $RunQuery = new QueryControllers();
            $RunQuery->signOut();
        }else{
            $_SESSION['last_active'] = time();
        }

        return $isValid;
    }

    /**
     * @param $user_id
     *  @param $username
     *  @param $remember
     *  */
    function prepLogin($user_id, $username, $remember){
        $_SESSION['ccc_id'] = $user_id;
        $_SESSION['ccc_username'] = $username;
        $_SESSION['_auth'] = $remember;

        $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
        $_SESSION['last_active'] = time();
        $_SESSION['fingerprint'] = $fingerprint;
            $this->rememberMe($user_id);
        
    }

    function prepcusLogin($user_id, $username, $remember,$privil_id){
        $_SESSION['ccc_cusid'] = $user_id;
        $_SESSION['ccc_cususername'] = $username;
         $_SESSION['ccc_privil']  = $privil_id;
        $_SESSION['_cusauth'] = $remember;

        $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
        $_SESSION['last_active'] = time();
        $_SESSION['fingerprint'] = $fingerprint;
            $this->rememberMMe($user_id);
        
    }
    
function password_auth($password,$password2){
    $new_security= new security;
        if ($password!="" && $password2!="" ){
            $decpass = $new_security->decryptor($password2);
            if ($decpass===$password){
                return true;
            }
            else{
                return false;
            }
        }
    return false;
}

    /**
     * @param $required_fields_array, an array containing the list of all required fields
     * @return array, containing all errors
     */
    public function check_empty_fields($required_fields_array){
       //initialize an array to store error messages
        //$form_errors = array();

        //loop through the required fields array and populate the form error array
        foreach($required_fields_array as $name_of_field){
            if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
              echo $error = "-".$name_of_field . " is a required field<br>";
            }
        }
        //return $form_errors;

    }


    /**
     * @param $fields_to_check_length, an array containing the name of fields
     * for which we want to check min required length e.g array('username' => 4, 'email' => 12)
     */
    public function check_min_length($fields_to_check_length){
        foreach($fields_to_check_length as $name_of_field => $minimum_length_required){
            if(strlen(trim($_POST[$name_of_field])) < $minimum_length_required){
                echo $error = "-".$name_of_field . " is too short, must be above {$minimum_length_required} Characters <br>";
            }
        }
    }

    


    /**
     * @param $data, store a key/value pair array where key is the name of the form control
     * in this case 'email' and value is the input entered by the user
     * @return array, containing email error
     */
   public function check_email($data){

        $userEmail = 'Email';
       //htmlspecialchars() - Convert special characters to HTML entities
       //html_entity_decode() - Convert all HTML entities to their applicable characters
       $key = htmlspecialchars_decode($userEmail, ENT_QUOTES);
        //check if the key email exist in data array
        if(array_key_exists($key, $data)){

            //check if the email field has a value
            if($_POST[$key] != null){

                // Remove all illegal characters from email
                $key = filter_var($key, FILTER_SANITIZE_EMAIL);

                //check if input is a valid email address
                if(filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false){
                   echo $error[]= "-".$key." is not a valid email address <br>";
                    //echo $emailError;
                }
            }
        }
                //echo $form_errors;
    }

    public function CheckDuplicateRecord($table, $conditions): bool
    {
        // Build WHERE clause from a condition array
        $where_parts = [];
        $params = [];

        foreach ($conditions as $column => $value) {
            $where_parts[] = "$column = ?";
            $params[] = $value;
        }

        try {

            $where_clause = implode(' AND ', $where_parts);
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

            $query = "SELECT COUNT(*) as count FROM $table WHERE $where_clause";

            // Execute the query and return true if the record exists
            // Implementation depends on your database connection method
            // Return true if count > 0, false otherwise

            $statement = $adb->query($query);

            if ($statement->fetch() > 0) {
                return true;
            }

        }catch (PDOException $ex) {
            echo "Registration Failed" . $ex->getMessage();
        }
        return false;
    }
     

    /**
     * @param $value, provided by user
     * in this case 'email' and value is the input entered by the user
     *  @param $adb,database connection
     * @return true,  on success and false on failure
     */
    public function checkDuplicateEmails($value, $adb){

        try {
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $sqlQuery = "SELECT email FROM users WHERE  email=:email";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute(array(':email' => $value));

            if ($row = $statement->fetch()) {
               return true;
            }

        } catch (PDOException $ex) {

        }
        return false;
    }
    public function checkDuplicateValues($value,$column,$table, $adb){

        try {
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $sqlQuery = "SELECT ".$column." FROM ".$table." WHERE  ".$column."=:email";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute(array(':email' => $value));

            if ($row = $statement->fetch()) {
               return true;
            }

        } catch (PDOException $ex) {

        }
        return false;
    }
  function checkDuplicateUserNames($value){
        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        try {
            $sqlQuery = "SELECT username FROM users WHERE  username=:username";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute(array(':username' => $value));

            if ($row = $statement->fetch()) {
                return true;
            }
            else{
                return false;
            }

        } catch (PDOException $ex) {
         echo "Registration Failed" . $ex->getMessage();
        }

    }
    
function checkDuplicateUserNamesUpdate($value,$uid){
        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        try {
            $sqlQuery = "SELECT username FROM users WHERE  username=:username and user_id=:user_id ";
            $statement = $adb->prepare($sqlQuery);
             $statement->bindParam(':username', $value);
             $statement->bindParam(':user_id', $uid);
            //array(':username' => $value);
            $statement->execute();

            if ($row = $statement->fetch()) {
                return true;
            }
            else{
                return false;
            }

        } catch (PDOException $ex) {
         echo "Registration Failed" . $ex->getMessage();
        }

    }

}

////////////////////////////////////////////////////////////////////////////////////

//communities functions 
//@Mbah Cedric
//Begin
//*****************************************************************************
//this function is used to generate random tokens for uploading pictures to the database


function generateSessionToken()
{
	$data['_token'] = md5(uniqid(rand(), true));
	$_SESSION['_token'] = $data['_token'];
}

 
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////functions to manage the user entity
///////////////////////////////create new users delete users and update user profiles
//////////////////////////////*****************************************************
//***********************************************************************************
//***********************************************************************************
    
class register
{
  
public static function  user_profile_edit($email,$name,$phone,$token)
     
     {
        
        if(isset($token)){
    $runQ = new QueryControllers();

    if ($runQ->validate_token($token)) {

      //columns as Array
        //$fields[] =  "user_id";
//        $fields[] = "email";
        $fields[] = "name";
        $fields[] = "phone";
        $fields[] = "dateupdated";
       
        //values as Array

       // $values[] ="";
//        $values[] = filter_var($email,FILTER_SANITIZE_STRING);
        $_SESSION['ccc_cususername'] = filter_var($name,FILTER_SANITIZE_SPECIAL_CHARS);
        $values[] = filter_var($name,FILTER_SANITIZE_SPECIAL_CHARS);
        $values[] = filter_var($phone,FILTER_SANITIZE_NUMBER_INT);
        date_default_timezone_set('Africa/Douala');
        $values[] = date('Y-m-d H:i:s');
 
//         $uservalidity=$runQ->checkDuplicateValues($email,'email','customer_credentials','');
//         $uservalidity2=$runQ->checkDuplicateValues($phone,'phone','customer_credentials','');


//if($uservalidity==false){
     $results = $runQ->UpdateData('customer_credentials', $fields, $values,'customer_id='.$_SESSION['ccc_cusid']);
        if ($results===true) {
            die ('1');
        } else {
            die ('Update Failed : try using another phone number');
        }
    
//}
//        else{
//            
//            die('sorry, username or email already exist');
//        }

       

    }
    else{
       die('ERROR! Token mismatch your security token is not genuine');
    }
}
else{
    die ("Security key missing");
}         
         
        
    } 
    
    
    
    
     public static function  user_insert($email,$password,$name,$phone,$token)
     
     {
        
        if(isset($token)){
    $runQ = new QueryControllers();

    if ($runQ->validate_token($token)) {
$new_security= new security;
$encpass = $new_security->encryptor($password);
      //columns as Array
        //$fields[] =  "user_id";
        $fields[] = "email";
        $fields[] = "name";
        $fields[] = "status";
        $fields[] = "privil_id";
        $fields[] = "phone";
        $fields[] = "authenticate";
        $fields[] = "password";
        $fields[] = "datecreated";
        $fields[] = "dateupdated";

        //values as Array

       // $values[] ="";
        $values[] = filter_var($email,FILTER_SANITIZE_EMAIL);
        $values[] = filter_var($name,FILTER_SANITIZE_SPECIAL_CHARS);
        $values[] = 1;
        $values[] = 0;
        $values[] = filter_var($phone,FILTER_SANITIZE_NUMBER_INT);
        $values[] = 0;
        $values[] = $encpass;
        date_default_timezone_set('Africa/Douala');
        $values[] = date('Y-m-d H:i:s');
        $values[] = date('Y-m-d H:i:s');
 
         $uservalidity=$runQ->checkDuplicateValues($email,'email','customer_credentials','');
         $uservalidity2=$runQ->checkDuplicateValues($phone,'phone','customer_credentials','');


if($uservalidity==false && $uservalidity2==false){
     $results = $runQ->InsertData('customer_credentials', $fields, $values);
        if ($results===true) {
            die ('1');
        } else {
            die ('Insert Failed');
        }
    
}
        else{
            
            die('sorry, username or email already exist');
        }

       

    }
    else{
       die('ERROR! Token mismatch your security token is not genuine');
    }
}
else{
    die ("Security key missing");
}         
         
        
    }
    
    
    public  function  user_update($username,$password,$name,$privil,$token,$uid)
     
     {
        
        if(isset($token)){
    $runQ = new QueryControllers();

    if ($runQ->validate_token($token)) {
$new_security= new security;
        if ($password!=""){$encpass = $new_security->encryptor($password);}

      //columns as Array
        //$fields[] =  "user_id";
        $fields[] = "username";
        $fields[] = "name";
        $fields[] = "status";
        $fields[] = "privil_id";
        
        if($password!=""){ 
        $fields[] = "auth";
        $fields[] = "password";
        $fields[] = "datecreated";
        }
       
        $fields[] = "dateupdated";

        //values as Array
       date_default_timezone_set('Africa/Douala');
       // $values[] ="";
        $values[] = $username;
        $values[] = filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS);
        $values[] = 1;
        $values[] = $privil;
        
        if($password!=""){ 
        $values[] = 0;
        $values[] = $encpass;
        $values[] = date('Y-m-d H:i:s');
        }

        $values[] = date('Y-m-d H:i:s');
 
         $uservalidity=$runQ->checkDuplicateUserNames($username);
         $uservalidity2=$runQ->checkDuplicateUserNamesUpdate($username,$uid);


if($uservalidity==true){
    if($uservalidity2==true){
    
     $results = $runQ->UpdateData('users', $fields, $values,'user_id='.$uid);
        if ($results) {
            die ('1');
        } else {
            die ('Update Failed');
        }
    
}
        else{
            
            die('Operation Failed, UserName Exist'.$uservalidity2);
        }

       
}
        else{
           $results = $runQ->UpdateData('users', $fields, $values,'user_id='.$uid);
        if ($results) {
            die ('1');
        } else {
            die ('Update Failed');
        }
     
        }
    }
    else{
       die('ERROR! Token mismatch your security token is not genuine');
    }
}
else{
    die ("Security key missing");
}         
         
        
    } 
    
    
    
    
    
public static function user_refresh($parent){
    
    
$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
if($result=$query->SelectData(['user_id','username','name','privil_id','status','auth','datecreated','dateupdated'],'users','user_id>'.$parent.' ORDER BY user_id DESC')){
     
     foreach($result as $res) {
         
        $line->user_id = $res['user_id'];
        $line->username = $res['username'];
        $line->name = $res['name'];
        $res_two=$query->SelectData(['privil_id','type'],'privil','privil_id='.$res['privil_id'].'');
        $line->privil= $res_two[0]['type'];
         $line->pid= $res['privil_id'];
         $line->status = $res['status'];
         $line->auth = $res['auth'];
         $line->datecreated = $res['datecreated'];
         $line->dateupdated= $res['dateupdated'];
        
         $arr[] = json_encode($line);
   
     
     
                }
    $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}
else{
    return 'error1001';
}
    
    
} 
    
public function get_privil($testprv){
    
$query= new QueryControllers;
$elementholder="";

if($result=$query->SelectData(['privil_id','type'],'privil','')){

foreach($result as $presult)
{
    if($testprv==$presult['privil_id']){
         $elementholder .=  '<option selected value='.$presult['privil_id'].'>'.$presult['type'].'</option>';
    }else{
      $elementholder .=  '<option value='.$presult['privil_id'].'>'.$presult['type'].'</option>'; 
    }

    
}
    return $elementholder;
}

else{
    
return '<option>errorprivilretr100<option>' ;
    
}  
}  
    
    
public function user_delete($parent,$table,$column)
{
 
    
  $query= new QueryControllers;  
   if($query->DeleteData($table, $column, $parent)){
       die('1');
   }
    else{
        die('Delete Failed');
    }
}
    
    
public function user_spec($parent){
    
 
$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
if($result=$query->SelectData(['user_id','username','name','privil_id','status','auth','datecreated','dateupdated'],'users','user_id='.$parent.' ORDER BY user_id DESC')){
     
     foreach($result as $res) {
         
        $line->user_id = $res['user_id'];
        $line->username = $res['username'];
        $line->name = $res['name'];
        $line->privil= $this->get_privil($res['privil_id']);  
         $line->status = $res['status'];
         $line->auth = $res['auth'];
         $line->datecreated = $res['datecreated'];
         $line->dateupdated= $res['dateupdated'];
        
         $arr[] = json_encode($line);
        
                }
    $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}
else{
    return 'error1001';
}
    
    
} 
    
public function pass_update($password,$pass_old,$token){
        
    $error =  array(0,'INPUT ERROR CURRENT PASSWORD DOES NOT MATCH','FATAL ERROR !! UNAUTHORIZED OPERATION USER NOT REGONIZED','OPERATION FAILED: FAILED TO UPDATE DATABASE CONTACT ADMIN');
     if(isset($token)){
    $runQ = new QueryControllers();

    if ($runQ->validate_token($token)) {
          $SelectQuery = $runQ->SelectData('password','customer_credentials','customer_id = "'.$_SESSION['ccc_cusid'].'"');
           
        if($runQ->getrow_num() == 1){
            $new_security= new security;
             
              if ($password!=""){$encpass = $new_security->encryptor($password);}
                foreach ($SelectQuery as $row){
                    
                     $fields[] = "password";
                     $fields[] = "dateupdated";
                     date_default_timezone_set('Africa/Douala');
                       // $values[] ="";

                   
                        $values[] = $encpass;
                        $values[] = date('Y-m-d H:i:s');
        
                     $password2 = $row['password'];
                    if($runQ->password_auth($pass_old,$password2)){
        
                      $results = $runQ->UpdateData('customer_credentials',$fields,$values,'customer_id='.$_SESSION['ccc_cusid']);
                        
                          if($results===true){
     $errorMSG= "PASSWORD UPDATED SUCCESSFULLY";
     $error_msg=[0,$errorMSG];
      echo json_encode($error_msg);
     
  }else{
//       throw new Exception($output);
    
        $errorMSG=  "PASSWORD UPDATE Error: ".$error[3];
     $error_msg=[1,$errorMSG];
      echo json_encode($error_msg);
  }
                              
                                                                 
                 }
            else{
              
                 $error_msg=[1,$error[1]];
      echo json_encode($error_msg);
            }
                                   
                }
                 
   
            }
        
           else {
     $error_msg=[1,$error[2]];
      echo json_encode($error_msg);
              
            }
        
    }
    
    else{
        
        $errorMSG="ERROR! Token mismatch your security token is not genuine";
        $error_msg=[1,$errorMSG];
      echo json_encode($error_msg);
    }
}
else{
    
         $errorMSG="Security key missing";
        $error_msg=[1,$errorMSG];
      echo json_encode($error_msg);
}         
         
        
    }      
        
public static function logs_refresh($parent){
    
    
$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
 
if($result=$query->SelectData('*',' user_logs AS n INNER JOIN users AS t ON n.user_id = t.user_id ORDER BY n.user_id ASC ','')){
     
     foreach($result as $res) {
        $line->log_id = $res['log_id'];
        $line->username = $res['username'];
        $line->login= $res['login_time'];
         $line->logout = $res['logout_time'];
       
        
        
        
         $arr[] = json_encode($line);
   
     
     
                }
    $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}
else{
    return 'error1001';
}
    
    
} 
    
    
}




//this class is build to dynamically return any requested data as long just the table name is provided by the initiator

class dynamic_puller
{
 
public static function get_stats(){
try{
$checker_two=false;
$checker_one=false;
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
 $line2 = new stdClass;
$checker_one;
$checker_two;
    $ERROR_TEST=0;
  
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='accounts' AND COLUMN_NAME IN('Given_Names','Branch','Account_Type','date_created')
 ");
if($query->getrow_num()!=0)
{
 $result=$query->SelectData('dm.Given_Names, dm.Branch,dm.Account_Type,dm.status,dm.date_created,t.motif ','accounts AS dm INNER JOIN stat_tab AS t ON dm.customer_id= t.customer_id AND t.account_id=dm.account_id  AND dm.customer_id='.$_SESSION['ccc_cusid'].' ORDER BY dm.date_created DESC' ,'');
if($query->getrow_num()!=0)
{
   

$checker_one=true;
   
}
else if ($result==''){
   $checker_one=false; 
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}
    
    
 $col2=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='tb_loan' AND COLUMN_NAME IN('Name','Branch','Account_Number','date_created')
 ");
if($query->getrow_num()!=0 )
{
 $result2=$query->SelectData('dm.Name,dm.Branch,dm.Account_Number, dm.status,dm.date_created,t.motif ','tb_loan  AS dm INNER JOIN stat_tab AS t ON dm.customer_id= t.customer_id AND t.loan_id=dm.loan_id AND dm.customer_id='.$_SESSION['ccc_cusid'].' ORDER BY dm.date_created DESC' ,'');
if($query->getrow_num()!=0 )

{
   
 $checker_two=true;  
}
    else if ($result2==''){
   $checker_two=false; 
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result2;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col2;
      $arr[] = json_encode($line);
}      
    
    
    
 if ($checker_one==true){   
    
    
       $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS];  
                        

         }
         
          
          $line->MOTIF = $res['motif']; 
          $line->TYPE = 'ACCOUNT OPENING REQUEST'; 
             if ($res['status']==0){
            $line->STATUS = 'Pending..';
             
         }
         else if ($res['status']==1){
          $line->STATUS = 'Validated..';
         }
         else{
             
         $line->STATUS = 'Rejected..';
 
         }
          $arr[] = json_encode($line);
     }
 }
     if ( $checker_two==true){   
     
     
         foreach($result2 as $res2) {
          
         foreach($col2 as $column2=>$value2)
         {
            $FIELDS2 = $value2['COLUMN_NAME'];
             
      $line2->$FIELDS2 = $res2[$FIELDS2];  
                        

         }
         
         $line2->MOTIF = $res2['motif']; 
          $line2->TYPE = 'LOAN REQUEST'; 
             if ($res2['status']==0){
            $line2->STATUS = 'Pending..';
             
         }
         else if ($res2['status']==1){
          $line2->STATUS = 'Validated..';
         }
         else{
             
         $line2->STATUS = 'Rejected..';
 
         }
          $arr[] = json_encode($line2);
     }
         
      
    
    
 }
    
     if ( $checker_two==false && $checker_one==false){   
         
         $line->ERROR_CHECK='002';
    $line->ERROR_MSG=null;
     $arr[] = json_encode($line);    
         
         
     }
    
    
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}    
    
    
    
    
public static function get_accounts($tab){
try{ 
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    $ERROR_TEST=0;
  
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='".$tab."' AND COLUMN_NAME IN('account_id','Given_Names','Account_Type','date_created')
 ");
if($query->getrow_num()!=0)
{
 $result=$query->SelectData('dm.account_id,dm.Given_Names,dm.Account_Type, dm.status,dm.date_created,t.name ',''.$tab.'  AS dm INNER JOIN customer_credentials AS t ON dm.customer_id= t.customer_id AND dm.customer_id='.$_SESSION['ccc_cusid'] ,'');
if($query->getrow_num()!=0)

{
   
     $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS];  
                        

         }
         
          $line->CREATED_BY = $res['name']; 
             if ($res['status']==0){
            $line->STATUS = 'Pending..';
             
         }
         else if ($res['status']==1){
          $line->STATUS = 'Validated..';
         }
         else{
             
         $line->STATUS = 'Rejected..';
 
         }
          $arr[] = json_encode($line);
     }
       
    

   
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}   
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}
    
 
    
public static function get_loans($tab){
try{ 
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    $ERROR_TEST=0;
  
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='".$tab."' AND COLUMN_NAME IN('loan_id','Name','Loan_purpose','Amount_requested','date_created')
 ");
if($query->getrow_num()!=0)
{
 $result=$query->SelectData('dm.loan_id,dm.Name,dm.Loan_purpose, dm.Amount_requested,dm.status,dm.date_created,t.name ',''.$tab.'  AS dm INNER JOIN customer_credentials AS t ON dm.customer_id= t.customer_id AND dm.customer_id='.$_SESSION['ccc_cusid'] ,'');
if($query->getrow_num()!=0)

{
   
     $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS];  
                        

         }
         
//          $line->CREATED_BY = $res['name']; 
             if ($res['status']==0){
            $line->STATUS = 'Pending..';
             
         }
         else if ($res['status']==1){
          $line->STATUS = 'Validated..';
         }
         else{
             
         $line->STATUS = 'Rejected..';
 
         }
        
          $arr[] = json_encode($line);
     }
       
    

   
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}   
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}
       
    
public static function get_cus_cred($tab){
try{ 
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    $ERROR_TEST=0;
    $field_check= ["","name","email","phone"];
    
    function sorted($s) {
    $a = str_split($s);
    sort($a);
    return implode($a);
} 

    
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='".$tab."'");
if($query->getrow_num()!=0)
{


 $result=$query->SelectData('dm.*',''.$tab.'  AS dm  WHERE dm.customer_id='.$_SESSION['ccc_cusid'],'');;


if($query->getrow_num()!=0)

{
   
     $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
             $pos = array_search(sorted($value['COLUMN_NAME']), array_map("sorted", $field_check));
             if ($pos==true){
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS]; 
             }
                        

         }
         
          $line->CREATED_BY = $res['name']; 
        
          $arr[] = json_encode($line);
     }
       
    

   
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}   
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}        
    
    
    
    
public static function get_($tab,$id){
try{ 
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    $ERROR_TEST=0;
  
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='".$tab."'");
if($query->getrow_num()!=0)
{

if ($tab!="tb_loan"){
 $result=$query->SelectData('dm.*,t.name ',''.$tab.'  AS dm INNER JOIN customer_credentials AS t ON dm.customer_id= t.customer_id AND dm.customer_id='.$_SESSION['ccc_cusid'].' AND dm.account_id='.$id ,'');
}
else{
       $result=$query->SelectData('dm.*,t.name ',''.$tab.'  AS dm INNER JOIN customer_credentials AS t ON dm.customer_id= t.customer_id AND dm.customer_id='.$_SESSION['ccc_cusid'].' AND dm.loan_id='.$id ,'');  
    }
if($query->getrow_num()!=0)

{
   
     $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS];  
                        

         }
         
          $line->CREATED_BY = $res['name']; 
        
          $arr[] = json_encode($line);
     }
       
    

   
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}   
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}    
 

public static function get_cv_tab($tab,$id){
try{ 
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    $ERROR_TEST=0;
  
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='".$tab."'");
if($query->getrow_num()!=0)
{

 $result=$query->SelectData('dm.*',''.$tab.'  AS dm  WHERE dm.id='.$id.' order by id asc' ,'');

if($query->getrow_num()!=0)

{
   
     $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS];  
                        

         }
        
          $arr[] = json_encode($line);
     }

   
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}   
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}    
    
    
    
public static function get_tab($tab,$id){
try{ 
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    $ERROR_TEST=0;
  
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='".$tab."'");
if($query->getrow_num()!=0)
{

if ($tab!="tb_loan"){
 $result=$query->SelectData('dm.*,t.name ',''.$tab.'  AS dm INNER JOIN customer_credentials AS t ON dm.customer_id= t.customer_id  AND dm.account_id='.$id ,'');
}
else{
       $result=$query->SelectData('dm.*,t.name ',''.$tab.'  AS dm INNER JOIN customer_credentials AS t ON dm.customer_id= t.customer_id AND dm.loan_id='.$id ,'');  
    }
if($query->getrow_num()!=0)

{
   
     $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS];  
                        

         }
         
          $line->CREATED_BY = $res['name']; 
        
          $arr[] = json_encode($line);
     }
       
    

   
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}   
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}    
    
    
    
    

public static function get_cus_table($tab,$COLUMN_LIST,$COLUMN_VAL_LIST,$CONDITION){
try{ 
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    $ERROR_TEST=0;
  
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='".$tab."' AND COLUMN_NAME IN (".$COLUMN_LIST.")");
if($query->getrow_num()!=0)
{
 $result=$query->SelectData($COLUMN_VAL_LIST,$tab,$CONDITION);
if($query->getrow_num()!=0)

{
   
     $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS];  
                        

         }
        
          $arr[] = json_encode($line);
     }
       
    

   
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}   
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}       
   
public static function get_accounts_bak($tab){
try{ 
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    $ERROR_TEST=0;
  
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='".$tab."' AND COLUMN_NAME IN('account_id','Given_Names','Account_Type','Branch','date_created')
 ");
if($query->getrow_num()!=0)
{
 $result=$query->SelectData('dm.account_id,dm.Given_Names,dm.Account_Type, dm.Branch,dm.date_created,t.name,dm.status ',''.$tab.'  AS dm INNER JOIN customer_credentials AS t ON dm.customer_id= t.customer_id ','');
if($query->getrow_num()!=0)

{
    if ($_SESSION['ccc_privil']==280 || $_SESSION['ccc_privil']==300  ){
   
     $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS];  
                        

         }
         
          $line->CREATED_BY = $res['name']; 
             if ($res['status']==0){
            $line->STATUS = 'Pending..';
             
         }
         else if ($res['status']==1){
          $line->STATUS = 'Validated..';
         }
         else{
             
         $line->STATUS = 'Rejected..';
 
         }
          $arr[] = json_encode($line);
     }
       
    
    }else{
        
         $line->ERROR_CHECK='002';
    $line->ERROR_MSG='FAILED: YOU ARE NOT AUTHORIZED TO VIEW THIS DATA';
     $arr[] = json_encode($line);
        
    }
   
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}   
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}
        
public static function get_loans_bak($tab){
try{ 
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    $ERROR_TEST=0;
  
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='".$tab."' AND COLUMN_NAME IN('loan_id','Loan_Type','Name','Account_Number','Branch','date_created')
 ");
if($query->getrow_num()!=0)
{
 $result=$query->SelectData('dm.loan_id,dm.Loan_Type,dm.Name,dm.Account_Number, dm.Branch,dm.date_created,t.name,dm.status ',''.$tab.'  AS dm INNER JOIN customer_credentials AS t ON dm.customer_id= t.customer_id ','');
if($query->getrow_num()!=0)

{
    if ($_SESSION['ccc_privil']==270 || $_SESSION['ccc_privil']==300  ){
   
     $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS];  
                        

         }
         
          $line->CREATED_BY = $res['name'];
         if ($res['status']==0){
            $line->STATUS = 'Pending..';
             
         }
         else if ($res['status']==1){
          $line->STATUS = 'Validated..';
         }
         else{
             
         $line->STATUS = 'Rejected..';
 
         }
        
          $arr[] = json_encode($line);
     }
       
    
    }else{
        
         $line->ERROR_CHECK='002';
    $line->ERROR_MSG='FAILED: YOU ARE NOT AUTHORIZED TO VIEW THIS DATA';
     $arr[] = json_encode($line);
        
    }
   
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}   
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}    

    
public static function get_cv_bak($tab){
try{ 
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    $ERROR_TEST=0;
  
$col=$query->SelectData('COLUMN_NAME','information_schema.columns',"table_schema='cccplc_website' AND table_name='".$tab."' AND COLUMN_NAME IN('id','name','email','tel','job','salary','date_created')
 ");
if($query->getrow_num()!=0)
{
 $result=$query->SelectData('dm.id,dm.name,dm.email,dm.tel, dm.job, dm.salary, dm.date_created',''.$tab.'  AS dm ORDER BY dm.id asc ','');
if($query->getrow_num()!=0)

{
    if ($_SESSION['ccc_privil']==260 || $_SESSION['ccc_privil']==300  ){
   
     $line->ERROR_CHECK='001';
     $line->ERROR_MSG='SUCCESS';  
     $arr[] = json_encode($line);
     $line = new stdClass;
    
     foreach($result as $res) {
          
         foreach($col as $column=>$value)
         {
            $FIELDS = $value['COLUMN_NAME'];
             
      $line->$FIELDS = $res[$FIELDS];  
                        

         }
          $arr[] = json_encode($line);
     }
       
    
    }else{
        
         $line->ERROR_CHECK='002';
    $line->ERROR_MSG='FAILED: YOU ARE NOT AUTHORIZED TO VIEW THIS DATA';
     $arr[] = json_encode($line);
        
    }
   
}
else{
    
    $line->ERROR_CHECK='002';
    $line->ERROR_MSG=$result;
     $arr[] = json_encode($line);
}    
    
}
 else{
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$col;
      $arr[] = json_encode($line);
}   
}
catch(Throwable $e) {
    $trace = $e->getTrace();
    $error= $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
     $line->ERROR_CHECK='002';
     $line->ERROR_MSG=$error;
     $arr[] = json_encode($line);
}
     $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}     
    
    
}
    





class comments{
public function level_check($parent){
    $i=0;
    $query= new QueryControllers;
    while($parent!='0'){
   $result=$query->SelectData(['cid','parent'],'comment','cid='.$parent.'');
        $tester=array_filter($result);
       if(!empty ($tester)){
           $parent= $result[0]['parent']; 
       }
        else{
            $parent='';
        }
    $i++;    
    }
    return $i;
}

public function comments_counter($cid){
     $query= new QueryControllers;
  $row_count=$query->getRowCount('comment',['parent'],[''.$cid.'']);  
    return $row_count;
}
    

public static function comment_insert($msg,$post_id,$parent,$token){
   


if ($token === $_SESSION['_token'])
	{


$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;

$response=$query->InsertData('comment',['sid','time','message','parent','children','user_id'],[$post_id,$date,$msg,$parent,'0',$_SESSION['user_id']]);
if($response==="YES"){
    return '1';
}
else{
    return $response;
}
}
else{
    return "Token mismatch detected";
}
}








}





class postal
{
    
public static function getpost($last_id){
  session_start();
$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;

$errorMSG='';
if (empty($last_id)) {
    $last_id=0;
} else {
   $last_id =$last_id;
}

  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
if($result=$query->SelectData(['post_id','cond','video','message','pictures','date_created','date_updated','user_id','com_id'],'post','post_id >'.$last_id.' AND com_id='.$_SESSION['community'].' ORDER BY post_id ASC')){
     foreach($result as $res) {
         if($res['pictures']!='0'){
      $post_pic=unserialize($res['pictures']);
      $post_pic=   json_encode($post_pic);
         }
         else
         {
          $post_pic="";   
         }
        $line->post_id = $res['post_id'];
        $line->message = $res['message'];
        $line->cond = $res['cond'];
        $line->post_pic = $post_pic;
        $line->video = $res['video'];
        $line->date_created = $res['date_created'];
        $line->date_updated = $res['date_updated'];
        $res_two=$query->SelectData(['user_id','firstname','secondname','picture','username'],'users','user_id='.$res['user_id'].' ');
        $line->author_name = $res_two[0]['firstname'].' '.$res_two[0]['secondname'];
        $line->user_id = $res_two[0]['user_id'];
        $line->username = $res_two[0]['username'];
        $line->picture= $res_two[0]['picture'];
        $arr[] = json_encode($line);
   
     
     
                }
    $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
   return $jsonData;
}
else{
    die('errorpostretr1001');
}  
    
}
  
 
//validating request from form


//funciton for pulling the first home comments 

public static function gethomecomments($post_id,$limi){
    
  $date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;

$errorMSG='';
if (empty($_GET["post_id"])) {
   $errorMSG.='accessory one missing';
} else {
   $post_id =$_GET['post_id'];
}  
    
//if (empty($_POST["child_id"])) {
//   $child=0;
//} else {
//   $child =$_POST['child_id'];
//}
//
//if (empty($_POST["post_id"])) {
//   $post=0;
//} else {
//   $post =$_POST['post_id'];
    
//}
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
if($result=$query->SelectData(['cid','time','message','sid','children','parent','user_id'],'comment','sid='.$post_id.' AND parent=0 ORDER BY cid DESC limit '.$limi.'')){
     $comments= new comments;
   // $level=$comments->level_check($post_id);
    $query->SelectData(['cid','time','message','sid','children','parent','user_id'],'comment','sid='.$post_id.' AND parent=0 ORDER BY cid DESC ');
    $rows_num=$query->getrow_num();
     foreach($result as $res) {
        $line->row_count=$comments->comments_counter($res['cid']);
        $line->cid = $res['cid'];
        $line->message = $res['message'];
        $line->sid = $res['sid'];
        $line->children = $res['children'];
        $line->parent_id = $res['parent'];
        $res_two=$query->SelectData(['user_id','firstname','secondname','picture','username'],'users','user_id='.$res['user_id'].' ');
        $line->author_name = $res_two[0]['firstname'].' '.$res_two[0]['secondname'];
        $line->user_id = $res_two[0]['user_id'];
        $line->username = $res_two[0]['username'];
        $line->picture= $res_two[0]['picture'];
      //  $line->level= $level;
        $line->rows_num= $rows_num;
        $arr[] = json_encode($line);
   
     
     
                }
    $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
 return ($jsonData);
}
else{
    die('error1001');
}
  
}
    
}

//**********************************[community code begins here code below is to add members, delete members,rate community,like or dislike community]*******************************

class community{
    public static  function add_member(){
         session_start();
$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;
$response=$query->InsertData('community_members',['com_id','user_id','join_date','exit_date'],[$_SESSION['community'],$_SESSION['user_id'],$date,$date]);
if($response==="YES"){
    return '1';
}
else{
    return $response;
}  
    }
}


//********************[End of community]*****************************
//*****************************************************************************
//End

////////////////////////////////////////////////////////////////////////////////////

class priv_manager{
    
    
public static function _controller_(){

       
  $_p_name = basename($_SERVER['PHP_SELF'],'.php');

    $query= new QueryControllers;

         $res_two=$query->SelectData(['Program_ID','Program_Name'],'prog','Program_Name="'.$_p_name.'"');
        $prog_id= $res_two[0]['Program_ID'];
    
    
         $runQ=$query->SelectData(['prog_dept_id','privil_id','prog_id'],'prog_dept','prog_id='.$prog_id.' and privil_id='.$_SESSION['privil'].' ORDER BY prog_dept_id ASC');
         //testing condition A
          if($query->getrow_num() >= 1){
              
         $runQ=$query->SelectData(['prog_user_id','user_id','status','prog_id'],'prog_user','prog_id='.$prog_id.' and user_id='.$_SESSION['ccc_id'].'  ORDER BY prog_user_id ASC'); 
             
              //testing condition B AND condition C  
              if($query->getrow_num() >= 1){
//                   foreach($runQ as $runner) {
                   $status =$runQ[0]['status'];
//                   }
                  //testing condition for extra case
                 if($status ==0){
                     return false; 
                 }
                  else{
                   return true;   
                  }
             
                  }
              else{
                  
                return true;    
              }
     
          }
         else{
   $runQ=$query->SelectData(['prog_user_id','status','prog_id','user_id'],'prog_user','prog_id='.$prog_id.' and user_id='.$_SESSION['ccc_id'].' and status=1  ORDER BY prog_user_id ASC');  
              //testing condition B AND condition C
              if($query->getrow_num() >= 1){
             return true; 
              
              }
              else{               
                  
                 return false;
              }
          }
      
    
}    
    
    
    
    
    
    
    
    
    
    
    
public static function _dept_prog($privil){
    
    
$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
if($result=$query->SelectData(['Program_ID','Report_Name'],'prog','')){
     
     foreach($result as $res) {
         
        $line->prog_id = $res['Program_ID'];
        $line->report_name = $res['Report_Name'];
//        $line->prog = $res['prog_id'];
//         
         
        $runQ=$query->SelectData(['prog_dept_id','privil_id','prog_id'],'prog_dept','prog_id='.$res['Program_ID'].' and privil_id='.$privil.' ORDER BY prog_dept_id ASC');
          if($query->getrow_num() >= 1){
              
              $line->status = 1; 
             
          } else
          {
             $line->status = 0;  
          }
    
        
         $arr[] = json_encode($line);
   
     
     
                }
    $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}
else{
    return 'error1001';
}
    
    
}
    
    
    
public static function _usr_prog($privil,$usr){
    
    
$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
if($result=$query->SelectData(['Program_ID','Report_Name'],'prog','')){
    
     foreach($result as $res) {
         
        $line->prog_id = $res['Program_ID'];
        $line->report_name = $res['Report_Name'];
//        $line->prog = $res['prog_id'];

        $runQ=$query->SelectData(['prog_dept_id','privil_id','prog_id'],'prog_dept','prog_id='.$res['Program_ID'].' and privil_id='.$privil.' ORDER BY prog_dept_id ASC');
         //testing condition A
          if($query->getrow_num() >= 1){
              
            $runQ=$query->SelectData(['prog_user_id','user_id','status','prog_id'],'prog_user','prog_id='.$res['Program_ID'].' and user_id='.$usr.'  ORDER BY prog_user_id ASC'); 
             
              //testing condition B AND condition C  
              if($query->getrow_num() >= 1){
//                   foreach($runQ as $runner) {
                   $status =$runQ[0]['status'];
//                   }
                  //testing condition for extra case
                 if($status ==0){
                     $line->status = 0;  
                 }
                  else{
                    $line->status = 1;    
                  }
             
                  }
              else{
                  
                $line->status = 1;    
              }
     
          }
         else{
   $runQ=$query->SelectData(['prog_user_id','status','prog_id','user_id'],'prog_user','prog_id='.$res['Program_ID'].' and user_id='.$usr.' and status=1  ORDER BY prog_user_id ASC');  
              //testing condition B AND condition C
              if($query->getrow_num() >= 1){
             $line->status = 1;  
              
              }
              else{               
                  
                 $line->status = 0; 
              }
          }
    
        
         $arr[] = json_encode($line);
   
     
     
                }
    $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}
else{
    return 'error1001';
}
    
    
}
    
    
    
public static function _cat_prog($privil){    
$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
if($result=$query->SelectData(['Program_ID','Report_Name'],'prog','')){
     
     foreach($result as $res) {
         
        $line->prog_id = $res['Program_ID'];
        $line->report_name = $res['Report_Name'];
//        $line->prog = $res['prog_id'];
//         
         
        $runQ=$query->SelectData(['prog_cat_id','cat_id','prog_id'],'prog_cat','prog_id='.$res['Program_ID'].' and cat_id='.$privil.' ORDER BY prog_cat_id ASC');
          if($query->getrow_num() >= 1){
              
              $line->status = 1; 
             
          } else
          {
             $line->status = 0;  
          }
    
        
         $arr[] = json_encode($line);
   
     
     
                }
    $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
}
else{
    return 'error1001';
}
    
    
}
    
 
    
    
    
    
    
    
}



?>
