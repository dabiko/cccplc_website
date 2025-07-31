<?php
require_once 'sessionset.php';
$_SESSION['header']=2;
require_once 'header.php';
?>
<section id="page-title" class="page-title-parallax page-title-dark" style="background-image: url('images/extra/services.jpg'); padding: 120px 0; background-size: cover; background-position: center center;" data-bottom-top="background-position:0px 550px;" data-top-bottom="background-position:0px -500px;">
<div class="container clearfix">
<!--
<h1>OUR SERVICES</h1>
<span>Get more insight on CCC PLC Services</span>
-->
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">services</li>
</ol>
</div>
</section>
<section>
<div class="container clear-bottommargin topmargin topborder clearfix">
 <div class="heading-block center">
           <div class="fancy-title title-center title-dotted-border topmargin-sm">
               <h2><span>Our products and services</span></h2></div>
<span>With the following services we are able to offer you a broad spectrum of products, find innovative solutions which are appropriate for your wealth management needs.</span>
</div>
<div class="row bottommargin">
<div class="col-lg-4 col-md-6 bottommargin">
<div class="feature-box fbox-right topmargin" data-animate="fadeIn">
<div class="fbox-icon">
<a href="atm.php"><i class="icon-credit-card i-alt"></i></a>
</div>
<h3>ATM Services</h3>
<p> CCC Plc places ATMs are open 24/7 in its branches for clients....</p>
</div>
<div class="feature-box fbox-right topmargin" data-animate="fadeIn" data-delay="200">
<div class="fbox-icon">
<a href="credit.php"><i class="icon-hand-holding-usd i-alt"></i></a>
</div>
<h3>Credit Facilities</h3>
<p> Utility loans, Line of credit, Business loans, ...</p>
</div>
<div class="feature-box fbox-right topmargin" data-animate="fadeIn" data-delay="200">
<div class="fbox-icon">
<a href="transfer.php"><i class="icon-exchange-alt i-alt"></i></a>
</div>
<h3>Transfer Rates</h3>
<p> Transfer your money at cheap and affordable rates..</p>
</div>
<div class="feature-box fbox-right topmargin" data-animate="fadeIn" data-delay="400">
<div class="fbox-icon">
<a href="other.php"><i class="icon-globe-americas i-alt"></i></a>
</div>
<h3>Others</h3>
<p>International Transfers via Western Union, Orange Money, MTN Mobile Money... .</p>
</div>
</div>
<div class="col-lg-4 d-md-none d-lg-block bottommargin center">
<img src="images/services/service_lady.png" alt="CCC PLC SERVICES">
</div>
<div class="col-lg-4 col-md-6 bottommargin">
<div class="feature-box topmargin" data-animate="fadeIn">
<div class="fbox-icon">
<a href="current.php"><i class="icon-et-wallet i-alt"></i></a>
</div>
<h3>Current Accounts</h3>
<p>Enables account holders to benefit from credit facilities....</p>
</div>
<div class="feature-box topmargin" data-animate="fadeIn" data-delay="200">
<div class="fbox-icon">
<a href="savings.php"><i class="icon-realestate-moneybox i-alt"></i></a>
</div>
<h3>Savings Accounts</h3>
<p>Your finances are secured and guaranteed..</p>
</div>
<div class="feature-box topmargin" data-animate="fadeIn" data-delay="200">
<div class="fbox-icon">
<a href="term.php"><i class="icon-medical-i-billing  i-alt"></i></a>
</div>
<h3> Term/time deposit </h3>
<p> Interest is calculated and paid based on amount deposited..</p>
</div>
<div class="feature-box topmargin" data-animate="fadeIn" data-delay="400">
<div class="fbox-icon">
<a href="atm.php"><i class="icon-line2-screen-smartphone i-alt"></i></a>
</div>
<h3>Mobile Banking</h3>
<p>CCC Plc embraces mobile banking technology</p>
</div>
</div>
</div>
</div>
</section>
    
<?php
require_once 'footer.php';
?>