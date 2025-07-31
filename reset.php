<?php
require_once 'resources/loginity.php';
auth_cuscheck_login();
$_SESSION['header']=1;
require_once 'header.php';

?>

<!--
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

-->

<!--<body class="stretched">-->

<!--<div id="wrapper" class="clearfix">-->

<section id="content">
<div class="content-wrap nopadding">
<div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: url('new_images/testi_two.jpg') center center no-repeat; background-size: cover;"></div>
<div class="section nobg full-screen nopadding nomargin">
<div class="container-fluid vertical-middle divcenter clearfix">
<div class="card divcenter noradius noborder" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
<div class="card-body" style="padding: 40px;">
<div id='error'></div>
<form name="login-form"  id="loginForm"  enctype="multipart/form-data" onsubmit="reset_mail(); return false" class="nobottommargin" >
    <center><h3>PASSWORD RESET</h3></center>
<div id="loginError"></div>
<div class="col_full">
<label for="login-form-username">Enter an Existing Email:</label>
<input type="text" id="username" name="username" value="" class="form-control not-dark" />
</div>
<div class="col_full nobottommargin">
    <button class="button button-3d button-teal nomargin"  type="submit" id="submit" name="submit"  value="submit">RESET<i style="display:none;" id="msgSubmit" class="fa fa-spinner fa-spin"></i></button><br>
     <div><span id="loader"></span></div>
    <br>
   <span style="margin-bottom: 5px;"> <a href='login.php'> GO BACK TO LOGIN ? </a></span>
    </div>
   </form>
<div class="line line-sm"></div>
<div class="center">
<p style="margin-bottom: 10px;">Do you have a login ? if not , Register Now:</p>
<a href="register" class="button button-rounded si-facebook si-colored">CREATE ACCOUNT</a>
</div>
</div>
</div>
<div class="center dark"><small>Copyrights &copy; All Rights Reserved CCC PLC.</small></div>
</div>
</div>
</div>
</section>
</div>

<div id="gotoTop" class="icon-angle-up"></div>
<!--
<div id="gotoTop" class="icon-angle-up"></div>
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="resources/auth_login.js" ></script>

<script src="js/sweetalert.min.js"></script>
<script src="js/functions.js"></script>
-->
</body>

       
<?php
require_once 'footer.php';
?>
<script src="resources/reset_login.js" ></script>

<script src="js/sweetalert.min.js"></script>