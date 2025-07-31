<?php
require_once('utilities.php');
function auth_check(){
    $adb=1;
$RunQuery = new QueryControllers();
if (isset($_SESSION['ccc_username']) || isset($_SESSION['ccc_id']) || $RunQuery->isCookieValid($adb)) {
//echo '0000000000000000000000000000000';
}else{
    $RunQuery->redirectToPage('login_locate.php');
    echo '0000000111111111111111111100000';
}
}

function auth_check_login(){
 $adb=1;
ob_start();  ob_end_clean();
$RunQuery = new QueryControllers();
if (isset($_SESSION['ccc_username']) || isset($_SESSION['ccc_id']) || $RunQuery->isCookieValid($adb)) {
    $RunQuery->redirectToPage('filehandle.php');
//     echo '0000000111111111111111111100000';
}

}



//customer auth test

function auth_cuscheck(){
    $adb=1;
$RunQuery = new QueryControllers();
if (isset($_SESSION['ccc_cususername']) || isset($_SESSION['ccc_cusid']) || $RunQuery->iscusCookieValid($adb)) {

}else{
    $RunQuery->redirectToPage('./login.php');
//    echo '0000000111111111111111111100000';
}
}

function auth_cuscheck_login(){
 $adb=1;
ob_start();  ob_end_clean();
$RunQuery = new QueryControllers();
if (isset($_SESSION['ccc_cususername']) || isset($_SESSION['ccc_cusid']) || $RunQuery->iscusCookieValid($adb)) {
    $RunQuery->redirectToPage('./customer_home.php');
//     echo '0000000111111111111111111100000';
}

}



//this function is used to control access to authorized pages
function _call_ctrl(){

    $RunQuery = new priv_manager();
   return $RunQuery->_controller_();
 
}



function _token(){
       $data['_token'] = md5(uniqid(mt_rand(), true));
	$_SESSION['_token'] = $data['_token'];
    }



function _browser_shutdown(){
    if (isset($_SESSION['logger'])){ 
//echo $_SESSION['logger'];
}

    else{
        
        echo'<script>
        swal({
                         title: "Ooops",
                         text:"LOGOUT_AUTHERRORX!000001_IMPROPER_SHUTDOWN",
                         type: "error",
                         confirmButtonText: "Ok!"});
                             var delay = 1000;
setTimeout(function() { console.log("tried to logout"); logger_off();     }, delay);


    function logger_off(){
    
 $.ajax({
 
url: "resources/logoff_cus.php",
type: "GET",
dataType: "html",
contentType: false,
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
         jQuery("#preview_display").html("");
    }
  }).done( function(text)
  {
    if(text==0){
           console.log("Validated_logout..........");
               window.location="login.php";            

          }
            else{
                 console.log(text);            
  swal({
                            title: "LOGOUT Error ",
                            text:  text,
                             type: "error",
                            showConfirmButton: true
                        });    
                              
 window.location="login.php";   
  
     
            }
     
         jQuery("#loader").html("");
      });  
    
    
    
    
    }
                    </script> ';
    }
}

function _passval(){
    if (isset($_SESSION['_auth'])){ 
if ($_SESSION['_auth']==0){
    echo'<script>
    pass_validation();</script>';
}
}
    else{
        
        echo'<script>swal({
                         title: "Ooops",
                         text:"_AUTHERRORX!000001",
                         type: "error",
                         confirmButtonText: "Ok!"});
                             var delay = 500;
setTimeout(function() {
  $( "#logoffner" ).trigger( "click" );
}, delay);
                    </script>
                    
                    
                    
                    ';
    }
}
?>