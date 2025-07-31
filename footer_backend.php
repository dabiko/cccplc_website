<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content=" ccc plc" />
<link rel="icon" href="images/logo.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="css/dark.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />

<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
<link rel="stylesheet" href="css/animate.css" type="text/css" />
<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />
<link rel="stylesheet" href="css/tooltip.css" type="text/css" />
<link rel="stylesheet" href="css/tooltip.min.css" type="text/css" />
<link rel="stylesheet" href="css/responsive.css" type="text/css" />
<link rel="stylesheet" href="demos/real-estate/css/font-icons.css" type="text/css" />
<link rel="stylesheet" href="demos/medical/css/medical-icons.css" type="text/css" />
<link rel="stylesheet" href="one-page/css/et-line.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet"  type="text/css"   href="css/sweetalert.css" />

<link rel="stylesheet" type="text/css" href="include/rs-plugin/css/settings.css" media="screen" />
<link rel="stylesheet" type="text/css" href="include/rs-plugin/css/layers.css">
<link rel="stylesheet" type="text/css" href="include/rs-plugin/css/navigation.css">
<link rel="stylesheet" type="text/css" href="pdf/style.css">
    
        <link rel="stylesheet" href="test-datatables/datatables.css" type="text/css" />
         <script src="test-datatables/downloadresources/jq.js"></script>
<!--        <link rel="stylesheet" href="css/font-icons.css" type="text/css" />-->
        <script src="test-datatables/datatables.js"></script>
        <script src="test-datatables/datatables3.js"></script>
       
        <style>
            
        tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
        </style>   


    


<title>CCC | PLC</title>
<style>
/*
      @media (min-width: 1500px)
.container {
  max-width: 1500px;
}
*/
    
       table.display {
  margin: 30 auto;
  width: 180%;
  clear: both;
           font-size:12px;
  border-collapse: collapse;
  font-family: 'Raleway', sans-serif;
/*  table-layout: fixed;         */
/*  word-wrap:break-word;      */
}
    * {
      font-family: 'Raleway', sans-serif;    
          font-size:12px;
    }
		.revo-slider-emphasis-text {
			font-size: 64px;
			font-weight: 700;
			letter-spacing: -1px;
			font-family: 'Raleway', sans-serif;
			padding: 15px 20px;
			border-top: 2px solid #FFF;
			border-bottom: 2px solid #FFF;
		}

		.revo-slider-desc-text {
			font-size: 20px;
			font-family: 'Lato', sans-serif;
			width: 650px;
			text-align: center;
			line-height: 1.5;
		}

		.revo-slider-caps-text {
			font-size: 16px;
			font-weight: 400;
			letter-spacing: 3px;
			font-family: 'Raleway', sans-serif;
		}

		.tp-video-play-button { display: none !important; }

		.tp-caption { white-space: nowrap; }
        
 .tooltiper:hover {
  fill: #E1E1E1;
}   
   
pre {

overflow-x: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-size: 11px;
            width:700px;
            font-family: 'Raleway', sans-serif;
            
/*
     display:block;
  overflow-wrap: break-word !important;
    white-space: wrap; 
  overflow: hidden !important;
*/
}
 

	</style>
    
<!--<script src="js/jquery.js"></script>-->
    
<script src="js/plugins.js"></script>


</head>
<body class="stretched">

<div id="wrapper" class="clearfix">
<?php 
if ($_SESSION['header']==1) {
echo '<header id="header" class="transparent-header full-header" data-sticky-class="not-dark">
';
}
    
else{
    echo'
       <header id="header" class="transparent-header semi-transparent full-header">';
}
    ?>
    <div id="header-wrap">
<div class="container clearfix">
<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

<div id="logo">
<a href="index" class="standard-logo" data-dark-logo="images/logo.png"><img src="images/logo.png" alt="CCC plc Logo"></a>
<a href="index" class="retina-logo" data-dark-logo="images/logo.png"><img src="images/logo.png" alt="CCC PLc Logo"></a>
</div>

<nav id="primary-menu">
<ul>
<li class="current"><a href="index"><div>Home</div></a>
</li>
<li><a href="aboutus.php"><div>About Us</div></a>
<ul>
    <li><a href="aboutus.php#vision"><div>Our Vision</div></a></li>
<li><a href="aboutus.php#mission"><div>Our Mission</div></a></li>
    <li><a href="aboutus.php#strength"><div>Our Strength</div></a></li>
<li><a href="aboutus.php#team"><div>Management Team</div></a></li>
<li><a href="aboutus.php#antimoney"><div>Anti-Money Laundering Policies</div></a></li>
<li><a href="aboutus.php#keyfigures"><div>Key Figures</div></a></li>
</ul>
</li>
<li><a href="services.php"><div>Products and Services</div></a>
<ul>
<li><a href="savings.php"><div>Savings Account</div></a></li>
<li><a href="current.php"><div>Current Account</div></a></li>
<li><a href="term.php"><div>Term/Time Deposits</div></a></li>
<li><a href="credit.php"><div>Credit Facilities</div></a></li>
<li><a href="transfer.php"><div>Transfer Rate</div></a></li>
<li><a href="atm.php"><div>ATM Services</div></a></li>
<li><a href="mobile.php"><div>Mobile Banking</div></a></li>
<li><a href="other.php"><div>Other Services</div></a></li>
</ul>
</li>
<li><a href="network.php"><div>Our Network</div></a>
<ul>
<li><a href="nw.php"><div>North-West</div></a></li>
<li><a href="sw.php"><div>South-West</div></a></li>
<li><a href="center.php"><div>Center</div></a></li>
<li><a href="littoral.php"><div>Littoral</div></a></li>
<li><a href="south.php"><div>South</div></a></li>
<li><a href="west.php"><div>West</div></a></li>
<li><a href="north.php"><div>North</div></a></li>
</ul>
</li>
<li><a href="career.php"><div>Career</div></a>
<ul>
<li><a href="career.php"><div>Job Description and Specialities</div></a></li>
<li><a href="cv.php"><div>Send us your CV</div></a></li>
</ul>
</li>
<li><a href="contact.php"><div>Contact Us</div></a></li>


</ul>
<div id="top-cart">
<a href="login_locate.php"><i class="icon-user-tie"></i><span>ad</span></a>
</div>
<div id="top-search">
<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
<form action="" method="get">
<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
</form>
</div>
</nav>
</div>
</div>
</header>