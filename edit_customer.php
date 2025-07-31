
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

<h3>Update your profile.</h3>
<p id='_msg'>Updating your information is crucial for your security access. Make sure to remember your updated information</p>
<form id="_register-form" name="register-form" class="nobottommargin">

<div  class="col_full">
<label for="register-form-givenname">Names:</label>
<input type="text" id="_name"   name="name"  class="form-control" />
<small id="_error_name" class="form-text text-muted"></small>
</div>
<div class="clear"></div>
<div class="col_half">
<label for="register-form-email">Email Address:</label>
<input type="text" id="_email" name="email"  class="form-control" readonly />
<small id="_error_email" class="form-text text-muted"></small>

</div>
<div class="col_half col_last">
<label for="register-form-phone">Phone:</label>
<input type="number" id="_phone" name="phone"  class="form-control" />
<input type="hidden" class="form-control" value="<?php echo  $_SESSION['_token']; ?>" id="_token_id">
<small id="_error_phone" class="form-text text-muted"></small>

</div>
<!--
<div class="clear"></div>
<div class="col_half">
<label for="register-form-password">Choose Password:</label>
<input type="password" id="password" name="password" class="form-control" />
<small id="error_password" class="form-text text-muted"></small>
</div>
<div class="col_half col_last">
<label for="register-form-repassword">Re-enter Password:</label>
<input type="password" id="password2" name="password2" class="form-control" />
<small id="error_password2" class="form-text text-muted"></small>
</div>
-->
<div class="clear"></div>
<div class="col_full nobottommargin">
<button class="button button-3d button-primary nomargin"  type="button" id="submitButton"  onclick="form_editValidate(1,0,2)"><span id="_btntext"> Update Now </span><span id="_msgSubmit"></span> </button>
</div>
</form>    
    
    
    
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
<script src="resources/profile_pull.js"></script>
<script src="js/components/bs-filestyle.js"></script>
<script src="resources/utilities.js"></script>
<script src="resources/form_validation.js"></script>

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