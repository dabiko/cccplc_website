<?php
require_once('resources/loginity.php');
auth_check_login();
?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="ccc plc" />
<link rel="icon" href="images/logo.png">

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="css/dark.css" type="text/css" />
<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
<link rel="stylesheet" href="css/animate.css" type="text/css" />
<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />
<link rel="stylesheet" href="css/responsive.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet"  type="text/css"   href="css/sweetalert.css" />
    </head>
<body class="stretched">

<div id="wrapper" class="clearfix">

<section id="content">
<div class="content-wrap nopadding">
<div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: url('images/extra/locate.jpg') center center no-repeat; background-size: cover;"></div>
<div class="section nobg full-screen nopadding nomargin">
<div class="container-fluid vertical-middle divcenter clearfix">
<div class="center">
<a href="index.php"><img src="images/logo.png" alt="CCC PLC Logo"></a>
</div>
<div class="card divcenter noradius noborder" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
<div class="card-body" style="padding: 40px;">
<form name="login-form"  id="loginForm" onsubmit="loginForm(); return false;" method="POST" class="nobottommargin" action="#" method="post">
<h3>ACCESS CARD PORTAL</h3>
<div id="loginError"></div>
<div class="col_full">
<label for="login-form-username">Username:</label>
<input type="text" id="username" name="username" value="" class="form-control not-dark" />
</div>
<div class="col_full">
<label for="login-form-password">Password:</label>
<input type="password" id="password" name="password" value="" class="form-control not-dark" />
</div>
<div class="col_full nobottommargin">
<button class="button button-3d button-black nomargin"  type="submit" id="loginBtn" name="loginBtn"  value="login">Login<i style="display:none;" id="msgSubmit" class="fa fa-spinner fa-spin"></i></button>
     <br/>
    
<a href="#" class="fright">Forgot Password?</a>
</div>
</form>
<div class="line line-sm"></div>
</div>
</div>
<div class="center dark"><small>Copyrights &copy; All Rights Reserved by CCC Plc.</small></div>
</div>
</div>
</div>
</section>
</div>

<div id="gotoTop" class="icon-angle-up"></div>
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="resources/auth_login.js" ></script>

<script src="js/sweetalert.min.js"></script>
<script src="js/functions.js"></script>
</body>

<!-- Mirrored from themes.semicolonweb.com/html/canvas/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 May 2019 16:08:47 GMT -->
</html>