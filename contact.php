<?php
require_once 'sessionset.php';
$_SESSION['header']=2;
require_once 'header.php';
?>

<section id="page-title">
<div class="container clearfix">
<h1>Contact</h1>
<span>Get in Touch with Us</span>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Contact</li>
</ol>
</div>
</section>

<div id="page-menu">
<div id="page-menu-wrap">
<div class="container clearfix">
<div class="menu-title">Contact <span>Options</span></div>
<nav>
    <ul>
<li class="current"><a href="contact"><div>Working Days  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monday-Saturday &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8:00am-05:00pm</div></a></li>

</ul>
</nav>
<div id="page-submenu-trigger"><i class="icon-reorder"></i></div>
</div>
</div>
</div>

<section id="map-overlay">
<div class="container clearfix">

<div id="contact-form-overlay-mini" class="clearfix">
<div class="fancy-title title-dotted-border">
<h3>Send us an Email</h3>
</div>
<div class="form-widget">
<div class="form-result"></div>

<form class="nobottommargin" id="template-contactform" name="template-contactform" action="http://themes.semicolonweb.com/html/canvas/include/form.php" method="post">
<div class="col_full">
<label for="template-contactform-name">Name <small>*</small></label>
<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
</div>
<div class="col_full">
<label for="template-contactform-email">Email <small>*</small></label>
<input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control" />
</div>
<div class="clear"></div>
<div class="col_full">
<label for="template-contactform-phone">Phone</label>
<input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" />
</div>
<div class="col_full">
<label for="template-contactform-service">Services</label>
<select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
<option value="">-- Select One --</option>
<option value="Wordpress">Wordpress</option>
<option value="PHP / MySQL">PHP / MySQL</option>
<option value="HTML5 / CSS3">HTML5 / CSS3</option>
<option value="Graphic Design">Graphic Design</option>
</select>
</div>
<div class="clear"></div>
<div class="col_full">
<label for="template-contactform-subject">Subject <small>*</small></label>
<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control" />
</div>
<div class="col_full">
<label for="template-contactform-message">Message <small>*</small></label>
<textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
</div>
<div class="col_full hidden">
<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
</div>
<div class="col_full">
<button class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Send Message</button>
</div>
<input type="hidden" name="prefix" value="template-contactform-">
</form>
</div>
</div>
</div>

<iframe id="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.8201539375755!2d9.698811164585315!3d4.057065174633825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4b30b5aca4784073!2sCCC%20PLC!5e0!3m2!1sen!2scm!4v1598437148827!5m2!1sen!2scm" width="2000" height="2000" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    
</section>

<?php
require_once 'footer.php';
?>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyBdGvcnka2RYSR3CePUK17rXI5slzdxlFc"></script>
<script src="js/jquery.gmap.js"></script>
