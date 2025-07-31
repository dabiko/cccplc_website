<!DOCTYPE html>
<?php

require_once('resources/loginity.php');
$_SESSION['header']=1;
auth_check();
_token();
require_once('header.php');
?>
<link rel="stylesheet" href="css/components/bs-filestyle.css" type="text/css" />
<title>CARD UPLOAD</title>
<style>
		.file-caption.icon-visible .file-caption-name {
			font-family: 'Lato', sans-serif;
			color: #666;
		}
		.form-process {
			position: absolute;
			-webkit-transition: all .3s ease;
			-o-transition: all .3s ease;
			transition: all .3s ease;
			background-image: none;
		}

		.form-process > div { background-color: #999;  }

		.form-process,
		#template-wedding-submitted,
		.template-wedding-complete .form-process {
			display: none;
			opacity: 0;
			background-color: rgba(255,255,255,0.7);
		}

		.template-wedding-processing .form-process {
			display: block;
			opacity: 1;
		}

		.divider.divider-center.divider-short:before,
		.divider.divider-center.divider-short:after { border-color: #CCC; }

		.btn-group label.error {
			display: block !important;
			text-transform: none;
			position: absolute;
		    bottom: -34px;
		    left: 0;
		    margin-bottom: 10px;
		}

		.btn-group input.valid ~ label.error,
		.btn-group input[type="text"] ~ label.error,
		.btn-group input[type="email"] ~ label.error,
		.btn-group input[type="number"] ~ label.error,
		.btn-group select ~ label.error { display: none !important; }

	</style>


<section id="content">
<div class="content-wrap bg-light">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-7 col-md-10">
<div class="card my-5 shadow-sm">
<div class="card-body p-5">
<h4 class="ls4 center">UPLOAD EXCEL TO DATABASE</h4>
<div class="divider divider-short divider-center text-dark"><i class="icon-credit-card1"></i></div>
<div class="form-widget" data-alert-type="false">
<div class="form-result"></div>
<div class="form-process css3-spinner">
<div class="css3-spinner-double-bounce1"></div>
<div class="css3-spinner-double-bounce2"></div>
</div>
<form class="nobottommargin" id="template-wedding" enctype="multipart/form-data">
<div class="row">
<div class="col-12 center mb-5">
<h6 class="font-body uppercase ls3">WELCOME BACK <?php echo $_SESSION['ccc_username'] ?></h6>
<h6 class="font-body uppercase ls3  h6"> PLEASE CHOOSE THE RIGHT DOCUMENT FORMAT</h6>
</div>


<div class="col-12  bottommargin">
<label>Allowed Only "txt" &amp; "csv" Files:</label><br>
<input id="sortcsv" name="filer" multiple type="file" class="file file-loading" data-allowed-file-extensions='["csv", "txt"]' data-show-preview="false"></div>
<div class="col-6">
    <button type="button" onclick="send_filer()"   id="upload" class="btn btn-primary btn-block btn-lg"><span id="msg">PROCESS</span></button>
</div><div class="col-6">
    
    <button id='logoffner' type="submit"  class="btn btn-secondary btn-block btn-lg">LOGOUT</button>
</div>
<input type="hidden" name="prefix" value="template-wedding-">
</div>
</form>
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
<script src="js/components/bs-filestyle.js"></script>
<script src="function.js"></script>
<script src="resources/utilities.js"></script>

<script>
  document.getElementById("logoffner").addEventListener("click", logger_off);
   
    function logger_off(){
    
 $.ajax({
 
url: 'resources/logoff',
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
               window.location='login_locate';            

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
<script>
		$(document).ready(function() {
			$("#input-5").fileinput({showCaption: false});

			$("#input-6").fileinput({
				showUpload: false,
				maxFileCount: 10,
				mainClass: "input-group-lg",
				showCaption: true
			});

			$("#input-8").fileinput({
				mainClass: "input-group-md",
				showUpload: true,
				previewFileType: "image",
				browseClass: "btn btn-success",
				browseLabel: "Pick Image",
				browseIcon: "<i class=\"icon-picture\"></i> ",
				removeClass: "btn btn-danger",
				removeLabel: "Delete",
				removeIcon: "<i class=\"icon-trash\"></i> ",
				uploadClass: "btn btn-info",
				uploadLabel: "Upload",
				uploadIcon: "<i class=\"icon-upload\"></i> "
			});

			$("#input-9").fileinput({
				previewFileType: "text",
				allowedFileExtensions: ["txt", "md", "ini", "text"],
				previewClass: "bg-warning",
				browseClass: "btn btn-primary",
				removeClass: "btn btn-secondary",
				uploadClass: "btn btn-secondary",
			});

			$("#input-10").fileinput({
				showUpload: false,
				layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					"   <div class=\'input-group-append\'>\n" +
					"       {browse}\n" +
					"       {upload}\n" +
					"       {remove}\n" +
					"   </div>\n" +
					"   {caption}\n" +
					"</div>"
				}
			});

			$("#input-11").fileinput({
				maxFileCount: 10,
				allowedFileTypes: ["image", "video"]
			});

			$("#input-12").fileinput({
				showPreview: false,
				allowedFileExtensions: ["zip", "rar", "gz", "tgz"],
				elErrorContainer: "#errorBlock"
			});
		});

	</script>