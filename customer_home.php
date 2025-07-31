
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
<div class="row clearfix">
<div class="col-md-9">
<img src="images/icons/avatar.jpg" class="alignleft img-circle img-thumbnail notopmargin nobottommargin" alt="Avatar" style="max-width: 84px;">
<div class="heading-block noborder">
<h3> CCC PLC ONLINE </h3>
<span> WELCOME BACK <?php echo $_SESSION['ccc_cususername']; ?></span>
</div>
<div class="clear"></div>
<div class="row clearfix">
<div class="col-lg-20">
<div class="tabs tabs-alt clearfix" id="tabs-profile">
<ul class="tab-nav clearfix">
<li><a href="#tab-feeds"><i class="icon-rss2"></i> ACTIVITY</a></li>
<li><a href="#tab-posts"><i class=" icon-realestate-moneybox"></i> LOAN APPLICATION HISTORY</a></li>
<li><a href="#tab-accounts"><i class="i-alt noborder icon-et-wallet"></i> ACCOUNT OPENING HISTORY</a></li>
<li><a href="#tab-connections"><i class="icon-users"></i> LOGON HISTORY </a></li>
</ul>
<div class="tab-container">
<div class="tab-content clearfix" id="tab-feeds">
<!--<p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium harum ea quo! Nulla fugiat earum, sed corporis amet iste non, id facilis dolorum, suscipit, deleniti ea. Nobis, temporibus magnam doloribus. Reprehenderit necessitatibus esse dolor tempora ea unde, itaque odit. Quos.</p>-->
<div  class="col-md-16" id="preview_stats"></div>
</div>
<div class="tab-content clearfix" id="tab-posts">
 <div  class="col-md-16" id="preview_loans"></div>
</div>
<div class="tab-content clearfix" id="tab-accounts">
    <div  class="col-md-16" id="preview_accounts"></div>
</div>
<div class="tab-content clearfix" id="tab-connections">
<div id="preview_logs" class="row topmargin-sm">

    
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="w-100 line d-block d-md-none"></div>
<?php
require_once 'profile_menu.php';

?>
</div>
    
<!--<button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-body">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title title_edit" id="myModalLabel">EDIT ACCOUNT</h4>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div id="body_info" class="modal-body">
    
</div>
</div>
</div>
</div>
</div>    
    
    
</div>
</div>
</section>


<?php
require_once 'footer.php';
?>
<script src="loanapply.js"></script>
<script src="js/components/bs-filestyle.js"></script>
<script src="resources/utilities.js"></script>
<script src="resources/utilities_edit.js"></script>
<script src="resources/modal.js"></script>
<script src="function.js"></script>
<script>
  document.getElementById("logoffner").addEventListener("click", logger_off);
   
    function logger_off(){
    
 $.ajax({
 
url: 'resources/logoff_cus.php',
type: "GET",
dataType: "html",
contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
processData: false,

    statusCode: {
        200: function () {
            console.log("200 - Success");
        },
        404: function(request, status, error) {
            console.log("404 - Not Found");
            console.log(error);
            location.href = "404";
        },
        503: function(request, status, error) {
            console.log("503 - Server Problem");
            console.log(error);
            location.href = "403";
        }
    },
    error: function (jqXHR, status, error) {
        var message= "Request: "+jqXHR+"Status: "+status+"Error Msg: "+error;
        swal("Error!", message, "error");
            console.log(jqXHR);
            console.log(status);
            console.log(error);
         jQuery("#preview_display").html('');
    }
  }).done( function(text)
  {
//   text = text.replace(/[^a-zA-Z0-9 ]/g, '');
//     var text= JSON.parse(data);
    if(text==0){
           console.log('Validated_logout..........');
               window.location='login.php';            

          }
            else{
                 console.log(text);            
  swal({
                            title: "LOGOUT Error ",
                            text:  text,
                             type: 'error',
                            showConfirmButton: true
                        });    
                              

  
     
            }
     
         jQuery("#loader").html('');
      });  
    
    
    
    
    }
     

    
    </script>

<?php
 _browser_shutdown();
?>