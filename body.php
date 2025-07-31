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
