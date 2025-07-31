<?php

require_once('resources/loginity.php');
 auth_cuscheck();
_token();
$_SESSION['header']=1;

require_once('header.php');
?>

<section id="content">
<div class="content-wrap">
<div class="container clearfix">
<div class="col_one_third nobottommargin">
<div class="well well-lg nobottommargin">
 <div class=" bottommargin center">
<img src="images/services/service_lady2.png" alt="CCC PLC SERVICES">
</div>
</div>
</div>
<div class="col_two_third col_last nobottommargin">
<h3>CHANGE PASSWORD</h3>
<p id='msg'>Enter New Password and Confirm</p>
<form id="register-form" name="register-form" class="nobottommargin">
<!--
<div class="col_half">
<label for="register-form-name">Sur Name:</label>
<input type="text" id="surname" name="surname" value="" class="form-control" />
<small id="error_surname" class="form-text text-muted"></small>
</div>
-->
<!--
<div  class="col_full">
<label for="register-form-givenname">Names:</label>
<input type="text" id="name"   name="name"  class="form-control" />
<small id="error_name" class="form-text text-muted"></small>
</div>
<div class="clear"></div>
<div class="col_half">
<label for="register-form-email">Email Address:</label>
<input type="text" id="email" name="email"  class="form-control" />
<small id="error_email" class="form-text text-muted"></small>

</div>
<div class="col_half col_last">
<label for="register-form-phone">Phone:</label>
<input type="number" id="phone" name="phone"  class="form-control" />

<small id="error_phone" class="form-text text-muted"></small>

</div>
-->
<div class="clear"></div>
<div class="col_half">
<label for="register-form-password">Old Password:</label>
<input type="password" id="password3" name="password3" class="form-control" />
<small id="error_password3" class="form-text text-muted"></small>
</div>
<div class="col_half">
<label for="register-form-password">New Password:</label>
<input type="password" id="password" name="password" class="form-control" />
<small id="error_password" class="form-text text-muted"></small>
</div>
<div class="col_half">
<label for="register-form-repassword">Confirm Password:</label>
<input type="password" id="password2" name="password2" class="form-control" />
<input type="hidden" class="form-control" value="<?php echo  $_SESSION['_token']; ?>" id="token_id">
<small id="error_password2" class="form-text text-muted"></small>

</div>
<div class="clear"></div>
<div class="col_full nobottommargin">
<button class="button button-3d button-primary nomargin"  type="button" id="submitButton"  onclick="Pass_reset(0,3)"><span id="btntext"> RESET </span><span id="msgSubmit"></span> </button>
</div>
</form>
</div>
</div>
</div>
</section>

<script src="js/plugins.js"></script>
<script src="resources/utilities.js"></script>
<?php
require_once 'footer.php';
?>

<script src="resources/form_validation.js"></script>
