<?php
const DB_DSN = 'mysql:host=localhost;port=3306; dbname=cccplc_website';
const DB_USER = 'root';
const DB_PASSWORD = '';


try{
//create an instance of the PDO class with the required paramters
    $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

//set PDO error mode to exception
    $adb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $adb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $adb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

//display success message
  //  echo "Connected Successfully".'<br>';

}catch(PDOException $ex) {

//display error message
    echo "Connection to database Failed" . $ex->getMessage();

    //$adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
     //echo "Connected Successfully".'<br>';
}

