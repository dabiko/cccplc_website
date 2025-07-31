<?php
session_start();

//  // If the session vars aren't set, try to set them with a cookie
//  if (!isset($_SESSION['ccc_id'])) {
//    if (isset($_COOKIE['ccc_user']) && isset($_COOKIE['ccc_user'])) {
//      $_SESSION['ccc_id'] = $_COOKIE['ccc_id'];
//      $_SESSION['ccc_user'] = $_COOKIE['ccc_user'];
//    }
//  }
//  if (!isset($_SESSION['ccc_id'])) {
//      echo'<script> window.location="signin.php"</script>';
//   
//	}
//	 else {
//
//  // Connect to the database
//  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//	  $query = "SELECT username,picture,firstname,email,descr,tel,facebook,linkedin,twitter,secondname,position,company,country,date_created,date_updated FROM users WHERE user_id= '" . $_SESSION['ipa_id'] . "'";
//      $data = mysqli_query($dbc, $query);
//	  $row = mysqli_fetch_array($data);
//	  $username = $row['username'];
//      $picture = $row['picture'];
//      $name=$row['firstname']." ".$row['secondname'];
//      $firstname=$row['firstname'];
//      $secondname=$row['secondname'];
//      $position=$row['position'];
//      $company=$row['company'];
//      $email=$row['email'];
//      $desc=$row['descr'];
//      $country=$row['country'];
//      $facebook=$row['facebook'];
//      $linkedin=$row['linkedin'];
//      $twitter=$row['twitter'];
//      $tel=$row['tel'];
//             
//
//	}

    
  ?>