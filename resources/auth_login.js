/**
 * Created by dabiko on 01-Nov-17.
 */


/**Function for Getting data from the form using their Id's*/
function _(id){
    return document.getElementById(id);
}

//Ajax Submit Function
function loginForm(){
    
    _("loginBtn").disabled = true;
    //$("#msgSubmit").innerHTML = '';
    $("#msgSubmit").show();



    var formdata = new FormData();
    formdata.append( "username", _("username").value );
    formdata.append( "password", _("password").value );
//    alert( _("username").value+""+ _("password").value);
//    if(document.getElementsByName('remember')[0].checked){
//      var rememberMe = "yes";
//        formdata.append('remember',rememberMe);
//    }else {
//       var noRemMe = "";
//        formdata.append('remember',noRemMe);
//    }

    var ajax = new XMLHttpRequest();

    ajax.open( "POST","auth_login",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200){
             jQuery("#loginError").html('<center><img src="loader2.gif"></center>');   
            setTimeout(function () {

                /**Function for Displaying Errors sent back by Ajax*/
                function ajaxResponseError(error) {
                    _("loginError").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button><strong>Ooops!!!</strong> '+error+' </div>';
//                    setTimeout(function () {
//                       
//                    }, 1000);
                    _("loginBtn").disabled = false;
                     $("#msgSubmit").hide();
                }

                    if (ajax.responseText == 0){
                        ajaxResponseError('Invalid Request');

                    }else if(ajax.responseText == 1){
                        ajaxResponseError('Please Enter Username and Password');

                    }else if(ajax.responseText == 2){
                        ajaxResponseError('Invalid Username');

                    }else if(ajax.responseText == 3){
                     ajaxResponseError('Invalid Password');

                    }else if (ajax.responseText){
                        var jsonData = JSON.parse(ajax.responseText);
                        var jsonLength = jsonData.results.length;
                        for (var i = 0; i < jsonLength; i++) {
                            var result = jsonData.results[i];
                            var AdminName = result.cccplcname
                        }
                        swal({
                            title: "welcome back "+AdminName,
                            text: "You're being Logged In.",
                            type: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        setTimeout(function(){
                            $("#msgSubmit").show();
                            window.location='filehandle.php';
                        }, 3000);

                    }
                 }, 300);
        }
                else if (ajax.readyState == 0){
                    _("loginError").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button><strong>Ooops!!!</strong> request not initialized  </div>';
                }
              else if (ajax.readyState == 500){
                    _("loginError").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button><strong>Ooops!!!</strong> Server connection Error  </div>';
                }
                 else if ( ajax.status == 403){
                   window.location="403";   
                }
                
                else if ( ajax.status == 404){
                   window.location="404"; 
                }

           


        
        
    };
    ajax.send( formdata );

}



///customer login form

function logincustomerForm(){
    
//    _("loginBtn").disabled = true;
    //$("#msgSubmit").innerHTML = '';
    $("#msgSubmit").show();



    var formdata = new FormData();
    formdata.append( "username", _("username").value );
    formdata.append( "password", _("password").value );
//    alert( _("username").value+""+ _("password").value);
//    if(document.getElementsByName('remember')[0].checked){
//      var rememberMe = "yes";
//        formdata.append('remember',rememberMe);
//    }else {
//       var noRemMe = "";
//        formdata.append('remember',noRemMe);
//    }

    var ajax = new XMLHttpRequest();

    ajax.open( "POST","customer_login",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200){
             jQuery("#loginError").html('<center><img src="loader2.gif"></center>');   
            setTimeout(function () {

                /**Function for Displaying Errors sent back by Ajax*/
                function ajaxResponseError(error) {
                    _("loginError").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button><strong>Ooops!!!</strong> '+error+' </div>';
//                    setTimeout(function () {
//                       
//                    }, 1000);
                    _("loginBtn").disabled = false;
                     $("#msgSubmit").hide();
                }

                    if (ajax.responseText == 0){
                        ajaxResponseError('Invalid Request');

                    }else if(ajax.responseText == 1){
                        ajaxResponseError('Please Enter Username and Password');

                    }else if(ajax.responseText == 2){
                        ajaxResponseError('Invalid Username');

                    }else if(ajax.responseText == 3){
                     ajaxResponseError('Invalid Password');

                    }else if (ajax.responseText){
                        var jsonData = JSON.parse(ajax.responseText);
                        var jsonLength = jsonData.results.length;
                        for (var i = 0; i < jsonLength; i++) {
                            var result = jsonData.results[i];
                            var AdminName = result.cccplcname
                        }
                        swal({
                            title: "welcome back "+AdminName,
                            text: "You're being Logged In.",
                            type: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        setTimeout(function(){
                            $("#msgSubmit").show();
                            window.location='./customer_home.php';
                        }, 3000);

                    }
                 }, 300);
        }
                else if (ajax.readyState == 0){
                    _("loginError").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button><strong>Ooops!!!</strong> request not initialized  </div>';
                }
              else if (ajax.readyState == 500){
                    _("loginError").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button><strong>Ooops!!!</strong> Server connection Error  </div>';
                }
                 else if ( ajax.status == 403){
                   window.location="403";   
                }
                
                else if ( ajax.status == 404){
                   window.location="404"; 
                }

           


        
        
    };
    ajax.send( formdata );

}
