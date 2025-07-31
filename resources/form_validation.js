function emptyform(email,name,password,password2,phone,vid){
     var test=0;
     
      if (name =="") {
        // handle the  invalid form...
        test++;
        $("#"+vid+"name").removeClass().addClass('error sm-form-control');
          $("#"+vid+"error_name").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_name").innerHTML="Please enter your full names";
     
       
    } 
     else{
        $("#"+vid+"name").removeClass().addClass('sm-form-control valid success');
          $("#"+vid+"error_name").removeClass().addClass('success form-text');
        document.getElementById(""+vid+"error_name").innerHTML="";
        document.getElementById(""+vid+"error_name").innerHTML="Ok";
         
      
      
     }
     
    if (email =="") {
        // handle the  invalid form...
        test++;
        
        $("#"+vid+"email").removeClass().addClass('error sm-form-control');
         $("#"+vid+"error_email").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_email").innerHTML="Please enter email";
     
       
    } 

 
if(vid=="")
{
 
 if (password =="") {
        // handle the  invalid form...
        test++;
      $("#"+vid+"password").removeClass().addClass('error sm-form-control');
        $("#"+vid+"error_password").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password").innerHTML="Please enter password";
   
       
    }
     
 
 if (password2 =="") {
        // handle the  invalid form...
        test++;
        $("#"+vid+"password2").removeClass().addClass('error sm-form-control');
      $("#"+vid+"error_password2").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password2").innerHTML="Please retype password";
     
    
    }
     else{
         $("#"+vid+"password2").removeClass().addClass('error sm-form-control');
          $("#"+vid+"error_password2").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password2").innerHTML="";
     }
}
     
 
  if (phone =="") {
        // handle the  invalid form...
        test++;
        $("#"+vid+"phone").removeClass().addClass('error sm-form-control');
       $("#"+vid+"error_phone").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_phone").innerHTML="Please enter a valid phone number";
     
       
    } 
    

 
 if(test>0){
      submitMSG(false, "Please fill the form properly no Empty fields!",vid);
         formError(vid);
     return false;
 }
else{
    return true;
}

 }

    
//test password
function passConfirm(password,password2,vid){
     if(password === password2){
          $("#"+vid+"password2").removeClass().addClass('success sm-form-control');
        $("#"+vid+"error_password2").removeClass().addClass('success form-text');
        document.getElementById(""+vid+"error_password2").innerHTML="";
        document.getElementById(""+vid+"error_password2").innerHTML="Ok";
      
      
         return true;
 }
    else{
        
      $("#"+vid+"password2").removeClass().addClass('error sm-form-control');
      $("#"+vid+"password").removeClass().addClass('error sm-form-control');
                $("#"+vid+"error_password2").removeClass().addClass('error form-text');
                $("#"+vid+"error_password").removeClass().addClass('error form-text');
         document.getElementById(""+vid+"error_password2").innerHTML="";
        document.getElementById(""+vid+"error_password2").innerHTML="Password does not match";
        document.getElementById(""+vid+"error_password").innerHTML="Password does not match";
         formError(vid);
submitMSG(false, "Passwords don't match?",vid);
        return false;
 }
    
    
        
}



function constraints(email,vid,phone)
           {    
    
    var usertest=0;
    var phonetest=0;
    console.log(phone);
    var alphaExp2= /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     var alphaExp = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]");
        if(alphaExp2.test(email)){
            
              $("#"+vid+"email").removeClass().addClass('success sm-form-control');
            $("#"+vid+"error_email").removeClass().addClass('success form-text');
        document.getElementById(""+vid+"error_email").innerHTML="";
        document.getElementById(""+vid+"error_email").innerHTML="Ok";
        }
    else{
        usertest++;
         $("#"+vid+"email").removeClass().addClass('error sm-form-control');
        $("#"+vid+"error_email").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_email").innerHTML="";
        document.getElementById(""+vid+"error_email").innerHTML="Please enter a valid email!";
        submitMSG(false, "please enter a valid email!", vid);
        
        
    }
    
   if(phone.length<9){
        phonetest++;
        $("#"+vid+"phone").removeClass().addClass('error sm-form-control');
        $("#"+vid+"error_phone").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_phone").innerHTML="";
        document.getElementById(""+vid+"error_phone").innerHTML="Phone Number must be above 9 characters?";
     
        submitMSG(false, "phone number must be above 9 characters?",vid); 
          console.log("phone character check: false"+phone.length);
        
    }
               else{
         $("#"+vid+"phone").removeClass().addClass('success sm-form-control');
          $("#"+vid+"error_phone").removeClass().addClass('success form-text');
        document.getElementById(""+vid+"error_phone").innerHTML="";
        document.getElementById(""+vid+"error_phone").innerHTML="Ok";
               }
 if(usertest>0 || phonetest>0){
  
         formError(vid);
     return false;
    
 }
else{
    return true;
      
  
}

 
   
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////function to run the entire valdiation process and upload the new password to the server for update and crosschecking//////////////
/////////////////////////////////////////////
////////////////////////////////////////////

function Pass_reset(uid,vid){
        
       
         if(vid==3){
             vid="";
         }
        else{
            vid=vid+"_";
        }
       
    // Initiate Variables With Form Content

     var old_password = $("#"+vid+"password3").val();
    var password = $("#"+vid+"password").val();
    var password2 = $("#"+vid+"password2").val();
    var token = $("#token_id").val();
   var ulink="";
   var udata="";
   var confirm="";
  var checker=0;
  // var holdtest= ""+username+""+name+""+password+""+password2+""+privil+""+token;
  //alert(holdtest);
     
    if(emptypass(old_password,password,password2,vid)===false){
        checker++;
    }
        
   
      
         if(passConfirm(password,password2,vid)===false){    checker++;
    }
    else{
         if(passcheck(password,vid,password2)===false){    
             
             checker++;
                                            
                                            
    }
    }
        
   
     
            
    if (checker===0){
            submitMSG(true,'is being processed this make take seconds....',vid);
              
         
//              ulink="";
//              udata="token_id="+token+"&password="+password+"&password1="+old_password;
//          
        formdata={};    
        formdata["token_id"] = token;
        formdata["password"] = password;
        formdata["password1"] = old_password;
                    
var  myJsonString= JSON.stringify(formdata);
// console.log(formdata);    
    
    

$.ajax({
    url: 'resources/passprocess.php',
    type: "GET",
    dataType: "json",
    data: {
        'action': "exec_find",
        'data': myJsonString
    },
        success : function(text){
          if(text[0]==1){
          
                          
                        swal({

    title: 'Oops...',
    text: text[1],
    type: 'error',
     showConfirmButton: true
//  footer: '<a href="">Why do I have this issue?</a>'
})  
        jQuery("#msgSubmit").html(''); 
               $("#msg").text("All Fields Are Required!!");
                          $("#btntext").text("Register");
              document.getElementById("msgSubmit").innerHTML='';
             
          }
            else{
//                  prog_catDataPull("accounts","preview_accounts"); 
                            swal({

  title: 'Great...',
  text: text[1],
    type: 'success',
     showConfirmButton: true
//  footer: '<a href="">Why do I have this issue?</a>'
})  
                
                jQuery("#msgSubmit").html('');
              clearpassForm(vid);
                 submitMSG(true,'updated successfully',vid);
                  $("#msg").text("All Fields Are Required!!");
                          $("#btntext").text("Register");
              document.getElementById("msgSubmit").innerHTML='';
               $("#register-form").reset();
            }
      
        
        },
    error: function (xhr, ajaxOptions, thrownError) {
                          swal({
 
  title: 'Oops...',
   text: xhr+''+thrownError,
    type: 'error',
     showConfirmButton: true                           
 
//  footer: '<a href="">Why do I have this issue?</a>'
})  
        console.log(  thrownError);
         jQuery("#msgSubmit").html('');
       
    }
    }); 

        
        
        
        
        
        
        
    }
    }

  

function resetupload(vid){
   
    
      // Initiate Variables With Form Content
    vid=vid+"_";
    var password1 = $("#"+vid+"old_password").val();
    var password = $("#"+vid+"password").val();
    var password2 = $("#"+vid+"password2").val();
    var token = $("#token_id").val();
   var ulink="";
 
   var confirm="";
    
     var formdata = new FormData();
    formdata.append( "password", password1);
    formdata.append( "password1",password);
    formdata.append( "token_id",token);

  // var holdtest= ""+email+""+name+""+password+""+password2+""+email+""+token;
  //alert(holdtest);
     
    if(emptypass(password1,password,password2,vid)===true){
      if(passcheck(password,vid)===true){
        if(passConfirm(password,password2,vid)===true){
            submitMSG(true,'is being processed this make take seconds....',vid);
              ulink="resources/passprocess.php";
              
        
             var ajax = new XMLHttpRequest();

    ajax.open( "POST",ulink,true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200){
            setTimeout(function () {

                /**Function for Displaying Errors sent back by Ajax*/
                function ajaxResponseError(error) {
                    submitError(vid);
                     formError(vid);
                     submitMSG(false,'Failed'+error,vid);
                swal({
                         title: "Ooops",
                         text:error,
                         type: "error",
                         confirmButtonText: "Ok!"});
                    
                }

                    if (ajax.responseText == 0){
                      submitMSG(true,'Processed Successfully',vid);
                         document.getElementById(""+vid+"msgSubmit").innerHTML="";
                        swal("Update Successful!", "Password update operation succesfull!", "success");
                         location.reload();
                        
                    }
                        else{
                           ajaxResponseError(ajax.responseText);  
                        }
            
                       }, 300);
        }
                else if (ajax.readyState == 0){
                    swal("OOpsa!", "Request not initialized!", "error");
                }
                 else if ( ajax.status == 403){
                   window.location="403.html";   
                }
                
                else if ( ajax.status == 404){
                   window.location="404.html"; 
                }

            


        
        
    };
    ajax.send( formdata );
                    
                     

}
}
}
        return false;
}





///////////////////////////////////////////////////////////////
//password empty used by password reset form
//
///
///////////////////
/////////////////////////
//
function emptypass(old_password,password1,password2,vid){
    var test="";
 if (old_password =="") {
        // handle the  invalid form...
        test++;
      $("#"+vid+"password3").removeClass().addClass('error sm-form-control');
      $("#"+vid+"error_password3").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password3").innerHTML="Please enter Old password";
   
       
    }
    else 
    {
        $("#"+vid+"password3").removeClass().addClass('success sm-form-control');
        $("#"+vid+"error_password3").removeClass().addClass('success form-text');
        document.getElementById(""+vid+"error_password3").innerHTML="";
        document.getElementById(""+vid+"error_password3").innerHTML="Ok";
    }
    
  if (password1 =="") {
        // handle the  invalid form...
        test++;
      $("#"+vid+"password").removeClass().addClass('error sm-form-control');
        $("#"+vid+"error_password").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password").innerHTML="Please enter password";
   
       
    }
     
 
 if (password2 =="") {
        // handle the  invalid form...
        test++;
        $("#"+vid+"password2").removeClass().addClass('error sm-form-control');
      $("#"+vid+"error_password2").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password2").innerHTML="Please retype password";
     
    
    }
     else{
         $("#"+vid+"password2").removeClass().addClass('error sm-form-control');
          $("#"+vid+"error_password2").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password2").innerHTML="";
     }
    
     if(test>0){
      submitMSG(false, "Please fill the form properly no Empty fields!",vid);
         formError(vid);
     return false;
 }
else{
    return true;
}
    
}

///////////////////
/////////////////////////////
//validating password strength
function passcheck(pass,vid,pass2){
    if (pass!=""){
     var alphaExp =  new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{8,})");
    if(pass.length<8){
        $("#"+vid+"password").removeClass().addClass('error sm-form-control');
        $("#"+vid+"password2").removeClass().addClass('error sm-form-control');
         $("#"+vid+"error_password").removeClass().addClass('error form-text');
         $("#"+vid+"error_password2").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password").innerHTML="";
        document.getElementById(""+vid+"error_password2").innerHTML="password must be above 8 characters";
        document.getElementById(""+vid+"error_password").innerHTML="password must be above 8 characters";
         formError(vid);
        submitMSG(false, "password must be above 8 characters?",vid); 
        return false;
    }
    else{
    if(alphaExp.test(pass)){
        
         $("#"+vid+"password").removeClass().addClass('success sm-form-control');
         $("#"+vid+"error_password").removeClass().addClass('success form-text');
         $("#"+vid+"error_password2").removeClass().addClass('success form-text');
        document.getElementById(""+vid+"error_password").innerHTML="";
        document.getElementById(""+vid+"error_password").innerHTML="Ok";
     $("#"+vid+"password2").removeClass().addClass('success sm-form-control');
        document.getElementById(""+vid+"error_password2").innerHTML="";
        document.getElementById(""+vid+"error_password2").innerHTML="OK";
           return true;
    }
    else{
         $("#"+vid+"password").removeClass().addClass('error sm-form-control');
         $("#"+vid+"password2").removeClass().addClass('error sm-form-control');
         $("#"+vid+"error_password").removeClass().addClass('error form-text');
         $("#"+vid+"error_password2").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password").innerHTML="";
        document.getElementById(""+vid+"error_password").innerHTML="password is too weak!(Put Capital letters, Symbols to make it strong)";
        document.getElementById(""+vid+"error_password2").innerHTML="password is too weak!(Put Capital letters, Symbols to make it strong)";
        formError(vid);
        submitMSG(false, "password is too weak!",vid);
        return false;
       }  
   
    }
    

}
    else{
          $("#"+vid+"password").removeClass().addClass('error sm-form-control');
         $("#"+vid+"error_password").removeClass().addClass('error form-text');
        
        document.getElementById(""+vid+"error_password").innerHTML="";
        document.getElementById(""+vid+"error_password").innerHTML="please enter password";
        $("#"+vid+"error_password2").removeClass().addClass('error form-text');
        
        if (pass2==""){
     $("#"+vid+"password2").removeClass().addClass('error sm-form-control');
        document.getElementById(""+vid+"error_password2").innerHTML="";
        document.getElementById(""+vid+"error_password2").innerHTML="please retype password";
        }
        
        return false;
    }
}

//
//function formSuccess(){
//    $("#contactForm")[0].reset();
//    submitMSG(true, "success click on login!")
//   
//}


function clearpassForm(vid){
  
  $("#"+vid+"register-form input[type=text],input[type=password]").each(function() {
                console.log("This data has been cleaned successfully: "+this.name);
               this.value="";
     

            });
var elements= ['password3','password','password2'];
    for(var i=0;i<elements.length;i++){
     console.log("#"+vid+""+elements[i]+"_box has been cleared");   
     $("#"+vid+""+elements[i]+"").removeClass().addClass('form-control');
        document.getElementById(""+vid+"error_"+elements[i]+"").innerHTML="";
    }

}

function clear_forgotpassForm(vid){
  
  $("#"+vid+"register-form input[type=text],input[type=password]").each(function() {
                console.log("This data has been cleaned successfully: "+this.name);
               this.value="";
     

            });
var elements= ['password','password2'];
    for(var i=0;i<elements.length;i++){
     console.log("#"+vid+""+elements[i]+"_box has been cleared");   
     $("#"+vid+""+elements[i]+"").removeClass().addClass('form-control');
        document.getElementById(""+vid+"error_"+elements[i]+"").innerHTML="";
    }

}



function formError(vid){
    $("#"+vid+"register-form").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}
  

  $(document).on('click', '.edit-button', function() {
     
		var uid= $(this).attr('id'); 
       
      edit_users_modal(uid);
     
      
      // Show textarea
//        $(this).parent().children('.hide-reply-box').show();
//		$(this).hide(); // Hide reply-button
      
		
	}); 


///////// this code is to check empty forgotten password form

function emptyforgot_pass(password1,password2,vid){
    var test="";

    
  if (password1 =="") {
        // handle the  invalid form...
        test++;
      $("#"+vid+"password").removeClass().addClass('error sm-form-control');
        $("#"+vid+"error_password").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password").innerHTML="Please enter password";
   
       
    }
     
 
 if (password2 =="") {
        // handle the  invalid form...
        test++;
        $("#"+vid+"password2").removeClass().addClass('error sm-form-control');
      $("#"+vid+"error_password2").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password2").innerHTML="Please retype password";
     
    
    }
     else{
         $("#"+vid+"password2").removeClass().addClass('error sm-form-control');
          $("#"+vid+"error_password2").removeClass().addClass('error form-text');
        document.getElementById(""+vid+"error_password2").innerHTML="";
     }
    
     if(test>0){
      submitMSG(false, "Please fill the form properly no Empty fields!",vid);
         formError(vid);
     return false;
 }
else{
    return true;
}
    
}

///////////// THis code is for forgotten password control


function reset_forgot(uid,vid){
        
       
         if(vid==3){
             vid="";
         }
        else{
            vid=vid+"_";
        }
       
    // Initiate Variables With Form Content

    var password = $("#"+vid+"password").val();
    var password2 = $("#"+vid+"password2").val();
   var ulink="";
   var udata="";
   var confirm="";
  var checker=0;
  // var holdtest= ""+username+""+name+""+password+""+password2+""+privil+""+token;
  //alert(holdtest);
     
    if(emptyforgot_pass(password,password2,vid)===false){
        checker++;
    }
        
   
      
         if(passConfirm(password,password2,vid)===false){    checker++;
    }
    else{
         if(passcheck(password,vid,password2)===false){    
             
             checker++;
                                            
                                            
    }
    }
        
   
     
            
    if (checker===0){
            submitMSG(true,'is being processed this make take seconds....',vid);
              
         
//              ulink="";
//              udata="token_id="+token+"&password="+password+"&password1="+old_password;
//          
        formdata={};    
      
        formdata["password"] = password;
                    
var  myJsonString= JSON.stringify(formdata);
// console.log(formdata);    
    
    

$.ajax({
    url: 'resources/passforgot_process.php',
    type: "GET",
    dataType: "json",
    data: {
        'action': "exec_find",
        'data': myJsonString
    },
        success : function(text){
          if(text[0]==1){
          
                          
                        swal({

    title: 'Oops...',
    text: text[1],
    type: 'error',
     showConfirmButton: true
//  footer: '<a href="">Why do I have this issue?</a>'
})  
        jQuery("#msgSubmit").html('');   
             
          }
            else{
//                  prog_catDataPull("accounts","preview_accounts"); 
                            swal({

  title: 'Great...',
  text: text[1],
    type: 'success',
     showConfirmButton: true
//  footer: '<a href="">Why do I have this issue?</a>'
})  
                
                jQuery("#msgSubmit").html('');
                                clear_forgotpassForm(vid);
                                 submitMSG(true, 'updated successfully', vid);
                                  setTimeout(window.location = 'login', 6000);
                                 $("#register-form").reset();
                               
            }
      
        
        },
    error: function (xhr, ajaxOptions, thrownError) {
                          swal({
 
  title: 'Oops...',
   text: xhr+''+thrownError,
    type: 'error',
     showConfirmButton: true                           
 
//  footer: '<a href="">Why do I have this issue?</a>'
})  
        console.log(  thrownError);
         jQuery("#msgSubmit").html('');
       
    }
    }); 

        
        
        
        
        
        
        
    }
    }


//edit customer account

function form_editValidate(type,uid,vid){
        
       
         if(vid==3){
             vid="";
         }
        else{
            vid="_";
        }
       
    // Initiate Variables With Form Content
    var phone = $("#"+vid+"phone").val();
    var name = $("#"+vid+"name").val();
    var password = "";
    var password2 = "";
    var email = $("#"+vid+"email").val();
    var token = $("#"+vid+"token_id").val();
   var ulink="";
   var udata="";
   var confirm="";
  var checker=0;
  // var holdtest= ""+username+""+name+""+password+""+password2+""+privil+""+token;
  //alert(holdtest);
     
    if(emptyform(email,name,password,password2,phone,vid)===false){
        checker++;
    }
         
   
        if(constraints(email,vid,phone)===false){     
            checker++;
            console.log("checker log : "+checker);
    }     
            
    if (checker===0){
            submitMSG(true,'is being processed this make take seconds....',vid);
              
          if (type==1){
              ulink="resources/edit_register_process.php";
              udata="token_id="+token+"&phone="+phone+"&name="+name+"&email="+email;
          } 
            else{
               ulink="resources/edit_register_process.php"; 
              udata="token_id="+token+"&phone="+phone+"&password="+password+"&name="+name+"&email="+email+"&uid="+uid;
            }
                    
$.ajax({
type: "POST",  
url: ulink,
data: udata,
        success : function(text){
            if(type==1){
                confirm="Account was updated successfully";
            }
            else{
                confirm= ""+name+" was updated successfully"; 
            }
            
            if (text==1){
             swal({
                         title: "Great",
                         text:confirm,
                         type: "success",
                         confirmButtonText: "Ok!"});
                          $("#"+vid+"msg").text("All Fields Are Required!!");
                          $("#"+vid+"btntext").text("Update");
                          document.getElementById(""+vid+"msgSubmit").innerHTML='';
                           setTimeout(function(){location.reload()}, 1500);
                           
                
                if(type==1){
                     clearForm(vid);
                }
                        
                
             
                //insert partner enter here 
      }
             else {
              submitError(vid);
                swal({
                         title: "Ooops",
                         text:text,
                         type: "error",
                         confirmButtonText: "Ok!"});
                     $("#"+vid+"btntext").text("Update Again");
            }
        },
    error: function (xhr, ajaxOptions, thrownError) {
    swal({
                         title: "Ooops",
                         text:'status Code:' + xhr.status + 'Error Message :' + thrownError,
                         type: "error",
                         confirmButtonText: "Ok!"});
	           
	        }
    }); 
                                      
    }
    }
