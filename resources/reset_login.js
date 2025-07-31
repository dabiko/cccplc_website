
function _(id){
    return document.getElementById(id);
}



function reset_mail() {
    var form = $('form')[0]; // You need to use standard javascript object here

    jQuery("#loader").html('<center><img src="loader2.gif"></center>');
    var formData = new FormData(form);

    if (_("username").value != "") {
        var alphaExp2 = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var test_value= _("username").value;
        if (alphaExp2.test(test_value)) {

            formData.append("username", _("username").value);

            console.log(formData);
$.ajax({
type: "POST",  
url: 'reset_login.php',
data: formData,
contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
processData: false,
        success : function(text){
            if(text==1){
         $('#error').html('<a href="#" class="list-group-item list-group-item-action list-group-item-info"> GREAT!! A PASSWORD RESET  EMAIL WAS SENT. VISIT YOUR MAIL AND RESET YOUR PASSWORD </a>');
         
           $("#loginForm input[type=text],textarea,input[type=email],input[type=file],select").each(function() {
                console.log("This data has been cleaned successfully: "+this.value);
               this.value="";
               
                             swal({

                             title: 'GREAT...',
                             text: 'A PASSWORD RESET  EMAIL WAS SENT. VISIT YOUR MAIL AND RESET YOUR PASSWORD',
                             type: 'success',
                             showConfirmButton: true
                         }, function (isConfirm) {

                             if (isConfirm) {
                                 console.log("error form email sent-----------");
                             } else {
                                 console.log("error form  email reset message closed abruptly");
                             }
    }); 

            });
            
            }
            else{
                $('#error').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon-hand-up"></i><strong>Oooops !</strong> '+text+'.</div>');
            }
             jQuery("#loader").html(''); 
        
        },
    error: function (xhr, ajaxOptions, thrownError) {
    $('#error').html('<a href="#" class="list-group-item list-group-item-action list-group-item-info">'+xhr+' ERROR: '+thrownError+'</a>');
         jQuery("#loader").html(''); 
    }
    }); 
        }
           else{
           console.log("initiated email test");
                  swal({

                             title: 'OOOPS...',
                             text: 'ERROR: INVALID EMAIL FORMAT GIVEN',
                             type: 'error',
                             showConfirmButton: true
                         }, function (isConfirm) {

                             if (isConfirm) {
                                 console.log("error form confirm------------");
                             } else {
                                 console.log("error form message closed abruptly");
                             }
    }); 
                   jQuery("#loader").html(''); 
           }
}
    else{
          $('#error').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon-hand-up"></i><strong>Oooops ! &nbsp;&nbsp; </strong>Email is compulsory.</div>');
        jQuery("#loader").html(''); 
    }
}