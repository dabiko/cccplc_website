<?php
require_once 'sessionset.php';
$_SESSION['header']=2;
require_once 'header.php';
?>
<link rel="stylesheet" href="css/components/bs-datatable.css" type="text/css" />
 
    


<section id="page-title">
<div class="container clearfix">
<h1>LOCATE YOUR ATM CARD</h1>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php">Home</a></li>
<li class="breadcrumb-item"><a href="index">online services</a></li>
<li class="breadcrumb-item active" aria-current="page">CARD TRANSFERS</li>
</ol>
</div>
</section>





<!--
 <input type='text' value='372132731' id="parent_id">
    <input type="button" onclick="pull_data('','TEST'');">
-->

<section id="content">
<div class="content-wrap">
<div class="container clearfix">
    
    
  <div class="line"></div>
<h3>FIND YOUR ATM CARD WITHIN OUR NETWORK</h3>
<form id="card_form">
    

    
    <div class="form-row topmargin topborder">
<div class="form-group col-md-6">

<input type="text" class="form-control" id="parent_id" name="parent_id" placeholder="PLEASE ENTER ACCOUNT NUMBER">
</div>
<div class="form-group col-md-6">
<button type="button"  onclick="pull_users()" class="btn btn-primary">GENERATE</button>
</div>
</div>

</form>  
    
    
    
    
    
    <div id="preview_display">

<div class="table-responsive"><table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead><tr><th>TRANSFER_ID</th><th>CLIENT_ID</th><th>CLIENT NAME</th><th>CARD LOCATION</th><th>ACCOUNT</th><th>UPLOAD DATE</th></tr></thead><tfoot><tr><th>TRANSFER_ID</th><th>CLIENT_ID</th><th>CLIENT NAME</th><th>CARD LOCATION</th><th>ACCOUNT</th><th>UPLOAD DATE</th></tr></tfoot>
<tbody>

</tbody>
</table>
</div>
</div>
</div>
</div>
</section>

<?php
require_once 'footer.php';
?>


<script src="js/components/bs-datatable.js"></script>

<script src="js/functions.js"></script>
<script src="resources/utilities.js"></script>
<script>

		$(document).ready(function() {
			$('#datatable1').dataTable();
		});

	</script>
