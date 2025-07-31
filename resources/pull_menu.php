<?php
//validating request from form
require_once('menu.php');

$reginstance =new menu_builder;
  $jsonData = $reginstance->get_menu();
  print $jsonData;
?>