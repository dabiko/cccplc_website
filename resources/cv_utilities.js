  function scroll(elementId){
    const element = document.getElementById(elementId);
    const offset = 150;
    const bodyRect = document.body.getBoundingClientRect().top;
    const elementRect = element.getBoundingClientRect().top;
    const elementPosition = elementRect - bodyRect;
    const offsetPosition = elementPosition - offset;
      
window.scrollTo({
  top: offsetPosition,
  behavior: 'smooth'
});
  }



var clear_checker="";

function cv_ctl(){
var formdata = new FormData();
  var ctl_validate_form="";
    var ctl_validate_id="";
//var form = $('form')[0]; // You need to use standard javascript object here
        if (clear_checker != ""){
          console.log('-------------------------------------'+clear_checker+'cv form clear previous -------------------------------------------------------')
           $("#"+clear_checker).removeClass().addClass('sm-form-control');
      }
    
    
    
    
  jQuery("#loader").html('<center><img src="loader2.gif"></center>');   
    
    
 
    
$('#template-contactform').find(':input').each(function(){
     ctl_validate_id= $(this).attr('id');
if ($(this).attr('name')!='submit'){
       if ($(this).is(':checkbox')) {
        if ($(this).prop('checked')) {
            formdata.append($(this).attr('name'),"YES");
        } else {
            formdata.append($(this).attr('name'),"NO");
        }
    }else{
        if ( $(this).prop('value')==""){
      ctl_validate_form=$(this).attr('name');
         ctl_validate_id= $(this).attr('id');
              $("#"+ctl_validate_id).removeClass().addClass('error sm-form-control required valid');
           return false;
          
        }else{
            if ($(this).attr('name')=="email"){
             var alphaExp2= /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     var alphaExp = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]");
        if (alphaExp2.test($(this).prop('value'))) {
            
            formdata.append($(this).attr('name'), $(this).prop('value'));
            
             $("#"+ctl_validate_id).removeClass().addClass('success sm-form-control required valid');

        } else {
 ctl_validate_form=$(this).attr('name');
         ctl_validate_id= $(this).attr('id');
              $("#"+ctl_validate_id).removeClass().addClass('error sm-form-control required valid');
return false;
        }
            }else{
                if($(this).is(':file')) {
                     
                     formdata.append($(this).attr('name'), $("#"+ctl_validate_id).prop('files')[0]);
                    
                }else{
                    if ($(this).attr('name')=='cover_letter'){
                    formdata.append($(this).attr('name'), '<pre>'+$(this).prop('value')+'</pre>');
                }else {
                    formdata.append($(this).attr('name'), $(this).prop('value'));
                }
                }
            
            
             $("#"+ctl_validate_id).removeClass().addClass('success sm-form-control required valid');
            }
        }
    }
}
 
    
});

 if (ctl_validate_form!=""){
       swal({

            title: 'Oops...',
            text: 'PLEASE ENTER A VALID VALUE FOR FIELD '+ctl_validate_form,
            type: 'error',
            showConfirmButton: true
            //  footer: '<a href="">Why do I have this issue?</a>'
        }, function (isConfirm) {

            if (isConfirm) {
                console.log("check initiation------------");
                scroll(ctl_validate_id);
               
              jQuery("#loader").html('<div style="color:red;">CORRECT ERROR AND SUBMIT FORM </div>');
            } else {
                console.log("form was closed abruptly");
               
            }
        });
     
  
     
 }   
    else{
 //var  myJsonString= JSON.stringify(formdata);
 console.log(formdata);    

$.ajax({
        url: 'resources/cv_process.php',
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: formdata,                         
        type: 'post',
        success : function(text){
            if(text==1){
         $('#loader').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon-hand-up"></i><strong>GREAT !!!</strong> YOUR APPLICATION WAS SUBMITTED SUCCESSFULLY.</div>');
         
           $("#template-contactform input[type=text],textarea,input[type=email],input[type=file],input[type=number],input[type=tel],select").each(function() {
                console.log("This data has been cleaned successfully: "+this.value);
               this.value="";

            });
                
                 swal({

                             title: 'GREAT!!',
                             text: 'APPLICATION WAS SUBMITTED SUCCESSFULLY. WE WILL GET BACK TO YOU SHORTLY',
                             type: 'success',
                             showConfirmButton: true
                             //  footer: '<a href="">Why do I have this issue?</a>'
                         }, function (isConfirm) {

                             if (isConfirm) {
                                 console.log("success form confirmed-----------");
                             } else {
                                 console.log("success form was closed abruptly");
                             }
        });
            
            }
            else{
               
                       swal({

                             title: 'OOOPS...',
                             text: 'ERROR: '+text,
                             type: 'error',
                             showConfirmButton: true
                             //  footer: '<a href="">Why do I have this issue?</a>'
                         }, function (isConfirm) {

                             if (isConfirm) {
                                 console.log("error form confirm------------");
                             } else {
                                 console.log("error form message closed abruptly");
                             }
        });
                
                $('#loader').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon-hand-up"></i><strong>Oooops !</strong> '+text+'.</div>');
            }
//             jQuery("#loader").html(''); 
        
        },
    error: function (xhr, ajaxOptions, thrownError) {
    $('#loader').html('<a href="#" class="list-group-item list-group-item-action list-group-item-info">'+xhr+' ERROR: '+thrownError+'</a>');
        
        swal({

                             title: 'OOOPS...',
                             text: 'ERROR: '+thrownError,
                             type: 'error',
                             showConfirmButton: true
                             //  footer: '<a href="">Why do I have this issue?</a>'
                         }, function (isConfirm) {

                             if (isConfirm) {
                                 console.log("error form confirm------------");
                             } else {
                                 console.log("error form message closed abruptly");
                             }
    }); 

}
 });
       }
}
       