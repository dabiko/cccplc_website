var lastTimeID=0;
var opener_holder=1;
$(document).ready(function() {
  
//start_withdraw_postal();
 prog_catDataPull("accounts","preview_accounts",6);
 prog_catDataPull("tb_loan","preview_loans",6);
 prog_statsDataPull("statistics","preview_stats",7);
    prog_dynDataPull("customer_logs","preview_logs","0001");
    pull_profile("customer_credentials");
}); 



	function formValidate(type,uid,vid){
        
       
         if(vid==3){
             vid="";
         }
        else{
            vid=vid+"_";
        }
       
    // Initiate Variables With Form Content
    var phone = $("#"+vid+"phone").val();
    var name = $("#"+vid+"name").val();
    var password = $("#"+vid+"password").val();
    var password2 = $("#"+vid+"password2").val();
    var email = $("#"+vid+"email").val();
    var token = $("#token_id").val();
   var ulink="";
   var udata="";
   var confirm="";
  var checker=0;
  // var holdtest= ""+username+""+name+""+password+""+password2+""+privil+""+token;
  //alert(holdtest);
     
    if(emptyform(email,name,password,password2,phone,vid)===false){
        checker++;
    }
        
   
      
         if(passConfirm(password,password2,vid)===false){    checker++;
    }else{
         if(passcheck(password,vid,password2)===false){    
             
             checker++;
                                            
                                            
    }
    }
        
   
        if(constraints(email,vid,phone)===false){     
            checker++;
            console.log("checker log : "+checker);
    }     
            
    if (checker===0){
            submitMSG(true,'is being processed this make take seconds....',vid);
              
          if (type==1){
              ulink="resources/registerprocess.php";
              udata="token_id="+token+"&phone="+phone+"&password="+password+"&name="+name+"&email="+email;
          } 
            else{
               ulink="resources/editprocess.php"; 
              udata="token_id="+token+"&phone="+phone+"&password="+password+"&name="+name+"&email="+email+"&uid="+uid;
            }
                    
$.ajax({
type: "POST",  
url: ulink,
data: udata,
        success : function(text){
            if(type==1){
                confirm="Account was created successfully";
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
                          $("#"+vid+"btntext").text("Register");
                          document.getElementById(""+vid+"msgSubmit").innerHTML='';
                
                 setTimeout(function () {
                      location.href = "./customer_home.php";
                 },300)
                
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

//action when submit button is pressed
function submitMSG(valid, msg,vid){
 
    var button ="button button-3d button-primary nomargin disabled";
    if(valid){
         $("#"+vid+"register-form").removeClass().addClass('tada animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass(); 
         });
       
        $("#"+vid+"submitButton").removeClass().addClass(button); 
document.getElementById(""+vid+"msgSubmit").innerHTML='<center><img src="loader2.gif"></center>';
        $("#"+vid+"msg").text(msg);
        $("#"+vid+"btntext").text("processing");
    } else {
        console.log('this is the error message:'+msg+'');       
   
} 
}

function submitError(vid){

    var button ="button button-3d button-primary nomargin";
     
        $("#"+vid+"submitButton").removeClass().addClass(button); 
        $("#"+vid+"msg").text("An Error occured please register again!!");
        $("#"+vid+"btntext").text("Register Again");
        document.getElementById(""+vid+"msgSubmit").innerHTML="";
   
} 


function clearForm(vid){
   
  $("#"+vid+"register-form input[type=text],input[type=password]").each(function() {
                console.log("This data has been cleaned successfully: "+this.name);
               this.value="";
      

            });
var elements= ['name','phone','password','password2','email'];
    for(var i=0;i<elements.length;i++){
     console.log("#"+vid+""+elements[i]+"_box has been cleared");   
     $("#"+vid+""+elements[i]+"").removeClass().addClass('form-control');
        document.getElementById(""+vid+"error_"+elements[i]+"").innerHTML="";
    }

}



function pull_users(){
     jQuery("#preview_display").html('<center><img src="loader2.gif"></center>'); 
    
     var html = "";
   
   var last_id=$("#parent_id").val(); ;
  $.ajax({
    type: "GET",
    url: "resources/call_card.php?parent_id="+last_id 
  }).done( function( data )
  {
      var jsonData = JSON.parse(data);
   
      if(jsonData.results[0].error=='error1001'){
          console.log(jsonData.results[0].error);
//       jQuery("#preview_display").html('<h2> NO RESULTS </h2>'+jsonData.results[0].code); 
           html+= '<h2 style="color: blue;"> NO RESULTS AVAILABLE '+jsonData.results[0].code+'</h2><div class="table-responsive"><table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead><tr><th>TRANSFER_ID</th><th>CLIENT_ID</th><th>CLIENT NAME</th><th>CARD LOCATION</th><th>ACCOUNT</th><th>UPLOAD DATE</th></tr></thead><tfoot><tr><th>TRANSFER_ID</th><th>CLIENT_ID</th><th>CLIENT NAME</th><th>CARD LOCATION</th><th>ACCOUNT</th><th>UPLOAD DATE</th></tr></tfoot><tbody>  </tbody></table>';
//          jQuery("#preview_display").html('NO RESULTS'); 
          
           $('#preview_display').html(html);
      } else{
      
    var jsonData = JSON.parse(data);
    
//          console.log(jsonData["results"]);
    var jsonLength = jsonData.results.length;
          
    var switcher=0;
    var controller=0;
    var stats="";
   var auth="";
    for (var i = 0; i < jsonLength; i++) {
        if(i==0){
          html+= '<div class="table-responsive"><table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead><tr><th>TRANSFER_ID</th><th>CLIENT_ID</th><th>CLIENT NAME</th><th>CARD LOCATION</th><th>ACCOUNT</th><th>UPLOAD DATE</th></tr></thead><tfoot><tr><th>TRANSFER_ID</th><th>CLIENT_ID</th><th>CLIENT NAME</th><th>CARD LOCATION</th><th>ACCOUNT</th><th>UPLOAD DATE</th></tr></tfoot><tbody';
        }
        else if(i==jsonLength){
         html+='</tbody></table>';   
        }
      var result = jsonData.results[i];
        console.log(jsonData.results[i].client_name);
      
   
        
      html += '<tr><td>'+result.card_transfer_id+'</td><td>'+result.client_id+'</td><td>'+result.client_name+'</td><td>'+result.card_branch+'</td><td>'+result.acc+'</td><td>'+result.upload_date+'</td></tr>';
            
      }
     //console.log(html);
    $('#preview_display').html(html);
      }
       
      
    

		$(document).ready(function() {
			$('#datatable1').dataTable();
		});
        
      
        });
   
    
      }



















function pull_data(table_data,loading_text){
    var form = $('form')[0]; 
     jQuery("#preview_display").html('<center><img src="loader2.gif">&nbsp&nbsp'+loading_text+'</center>'); 
     
    
     var html = "";
    
    
   
 var formdata = new FormData(form);
  
    formdata.append( "parent_id", ("#parent_id").value );
    
  $.ajax({
   type: "POST",
dataType: "json",
data: formdata,
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
  }).done( function( data )
  {
   
      if (data.results[0] === 'fatal') {
     // do something 
          console.log(data.results[1])
       jQuery("#preview_display").html(''); 
          var message=data.results[1];
         swal("Error!", message, "error"); 
      } else{
      
    var jsonData = data.results;
//............................important when data is returned with keys
//   Object.keys(data.results).length;
//   data.results[Object.keys(data.results)[i]];
    var jsonLength = data.results.length;
    if (jsonLength!=0){
        var jsoninnerLen = data.results[0].length;
        
    var switcher=0;
    var controller=0;
    var stats="";
   var auth="";
          var data_line ='';

    for (var i = 0; i < jsonLength; i++) {
        for (var j = 0; j < jsoninnerLen; j++) {
        if(j+1 == jsoninnerLen){
         data_line += '<td>'+jsonData[i][j]+'</td></tr>';
 //           console.log(jsonData[i][j]+'.................'+j);
        }
        else if (j==0){
           data_line += '<tr><td>'+jsonData[i][j]+'</td>';  
 //            console.log(jsonData[i][j]+'.................'+j);
            }
          else{
            data_line += '<td>'+jsonData[i][j]+'</td>';  
 //              console.log(jsonData[i][j]+'.................'+j);
          }
      
    }
    }
        
//           if(switcher==0)
//         {
//       controller='<tr class="odd">';
//       switcher=1;
//          }
//        else{
//         controller='<tr class="even">';
//            switcher=0;
//        }
       table_data = ''+data_line+'';   
       var _title = $("#_title").html(); 
    for (var i = 0; i < jsonLength; i++) {
        if(i==0){
         html+= '<div class="table-responsive"><table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead><tr><th>TRANSFER_ID</th><th>CLIENT_ID</th><th>CLIENT NAME</th><th>CARD LOCATION</th><th>ACCOUNT</th><th>UPLOAD DATE</th></tr></thead><tfoot><tr><th>TRANSFER_ID</th><th>CLIENT_ID</th><th>CLIENT NAME</th><th>CARD LOCATION</th><th>ACCOUNT</th><th>UPLOAD DATE</th></tr></tfoot><tbody';
             html += table_data;
        }
        else if(i==jsonLength){
         html+='</tbody></table>';   
         
        }
//      var result = jsonData.results[i];
//        console.log(jsonData.results[i].username);
      
  
//       if(result.login==result.logout)
//       {
//           stats='<button type="button" class="btn btn-outline-info">Active</button>';
//       }else{
//           stats=result.logout;
//       }
        
        
//      html += ''+controller+'<td>'+result.log_id+'</td><td>'+result.username+'</td><td>'+result.login+'</td><td>'+stats+'</td></tr>';
        
           
       
      }
     //console.log(html);
    
      
      
     
   $('#preview_display').html(html);
//   $('#hidden_table').html(html2);

//             $('#dataTables-example').DataTable({
//                        responsive: true,
//                        pageLength:200,
//                        sPaginationType: "full_numbers",
//                        oLanguage: {
//                            oPaginate: {
//                                sFirst: "<<",
//                                sPrevious: "<",
//                                sNext: ">", 
//                                sLast: ">>" 
//                            }
//                        }
//                  
//                    }); 
//        
//        
        
      }
          else{
              $('#preview_display').html("<center>NO DATA</center>");
          }
      
    
    
          
          
    }
  
      
        });
   
    
      }

      
      
      
   











function send_filer(){
var form = $('form')[0]; // You need to use standard javascript object here
    
  jQuery("#loader").html('<center><img src="loader2.gif"></center>');   
var formData = new FormData(form);
    formData.append('filer', $('input[type=file]')[0].files[0]);

    
    
console.log(formData);
                    
$.ajax({
 
url: 'resources/uploadcsv.php',
type: "POST",
dataType: "json",
data: formData,
contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
processData: false,
        success : function(text){
    if(text[0]==1){
          
                          
swal({
                            title: 'ALERT',
                            text: text[1],
                            type: 'error',
                            showConfirmButton: true
                        });                      
          }
            else{
                            
                          
swal({
                            title: 'ALERT',
                            text: text[1],
                            type: 'success',
                            showConfirmButton: true
                        });  
  
     
            }
     
         jQuery("#loader").html('');
        },
    error: function (xhr, ajaxOptions, thrownError) {
                           Swal({
  type: 'error',
  title: 'Oops...',
  text:xhr+''+thrownError,
//  footer: '<a href="">Why do I have this issue?</a>'
})  
        console.log(  thrownError);
         jQuery("#loader").html('');
    }
    }); 


}





function upload_check(){
    var file_data = $('#sortcsv').prop('files')[0];  
    jQuery("#msg").html('<center><img src="loader2.gif"></center>'); 
    var form_data = new FormData();                  
    form_data.append('filer', file_data);
    alert(form_data);                             
    $.ajax({
        url: 'resources/uploadcsv.php', // <-- point to server-side PHP script 
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
             jQuery("#msg").html('PROCESS'); 
            alert(php_script_response); // <-- display response from the PHP script, if any
        }
     });


}

 function scrollToElement(elementId) {
            var element = document.getElementById(elementId);
            element.scrollIntoView({
                behavior: 'smooth'
//                block: 'start',
//                inline: 'nearest'
            });
        } 


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

function open_account_function(){
   
//var form = $('form')[0]; // You need to use standard javascript object here
        if (clear_checker != ""){
          console.log('-------------------------------------'+clear_checker+'clear previous -------------------------------------------------------')
           $("#"+clear_checker).removeClass().addClass('sm-form-control');
      }
    
    
    
    
  jQuery("#loader").html('<center><img src="loader2.gif"></center>');   
    
    
    formdata={}; 
    
$('#template-contactform').find(':input').each(function(){
if ($(this).attr('name')!='submit'){
       if ($(this).is(':checkbox')) {
        if ($(this).prop('checked')) {
            formdata[$(this).attr('name')] = "YES";
        } else {
            formdata[$(this).attr('name')] = "NO";
        }
    }else{
   formdata[$(this).attr('name')] = $(this).prop('value');
    }
}
 
    
});

    
 var  myJsonString= JSON.stringify(formdata);
 console.log(formdata);    
    
    

$.ajax({
    url: 'resources/newaccount_process.php',
    type: "GET",
    dataType: "json",
    data: {
        'action': "exec_find",
        'data': myJsonString
    },
        success : function(text){
          if(text[0]==1){
       clear_checker=text[2];   
              
var field_one=['surname',
'Given_Names',
'address',
'Date_Of_Birth',
'Birth_Place',
'Division',
'Region',
'Nationality',
'Gender',
'Identification_Papers',
'Identification_Number',
'Done_At',
'Done_On',
'Expiry_Date',
'mobile_phone',
'email_address'];

var field_two= [
'Marital_Status',
'Marital_Type',
'Spouse_Address',
'Spouse_Town',
'Spouse_mobile_phone',
'Spouse_email_address',
'Personal_Contact_Name',
'Personal_Contact_Relationship',
'Personal_Contact_Profession',
'Personal_Contact_mobile_phone',
'Personal_Contact_email_address'];
              
              
var field_three = [
'Existing_Account',
'Existing_Account_Number',
'Other_Sources_Details',
'Children_Names',
'Account_Type',
'Branch',
'Activity_Sector',
'Share_holder',
'Profession',
'PEP',
'Source_Of_Funds',
'Other_Income_Sources',
'Average_Monthly_Income'];

var field_four=[
'Spouse_Name',
'Spouse_Date_Of_Birth',
'Spouse_Birth_Place',
'Spouse_Division',
'Spouse_Region',
'Children_Number',
'Association_Member',
'Association_Name', 
'Association_Venue',
'Association_President',
'President_Contact'];  
              
              
       var my_id=text[2].replace(/\s/g, "");
                $("#"+my_id).removeClass().addClass('error sm-form-control');
             if(field_one.includes(my_id)===true){
//                 console.log(my_id+'validated............')
                 $("#tab1").trigger("click");
//                  scroll(my_id);
//                 setTimeout(() => {
//  
//            }, 2000);
    
               
             }
              else if(field_two.includes(my_id)===true){
                    $("#tab2").trigger("click");
//                 scrollToElement(my_id);
              }
               else if(field_three.includes(my_id)===true){
                     $("#tab3").trigger("click");
//                 scrollToElement(my_id);
               }
               else {
                   console.log("------------------log_account_open_4---------------------");
//                 scrollToElement(my_id);
               }
                          
                                  swal({

    title: 'Oops...',
    text: text[1],
    type: 'error',
     showConfirmButton: true
//  footer: '<a href="">Why do I have this issue?</a>'
},function(isConfirm){

   if (isConfirm){
     console.log("check initiation------------");
      scroll(my_id);

    } else {
  console.log("form was closed abruptly");
    }
 });  
                          
          }
            else{
                            swal({

  title: 'Great...',
  text: text[1],
    type: 'success',
     showConfirmButton: true
//  footer: '<a href="">Why do I have this issue?</a>'
},function(isConfirm){

   if (isConfirm){
     console.log("form was updated successfully");
        window.location.replace("customer_home.php");

    } else {
  console.log("form was closed abruptly");
    }
 });   
    
            }
      jQuery("#loader").html('');
        
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
         jQuery("#loader").html('');
    }
    }); 


}



// pull data for all accounts opened 


function prog_catDataPull(tab,display,control){
     jQuery("#"+display).html('<center><img src="loader2.gif"></center>'); 
    
     var table = "";
   
    
  $.ajax({
    type: "GET",
    url: 'resources/dyn_puller',
    data: 'tab='+tab
  }).done( function( data )
  {
   
        var jsonData = JSON.parse(data);
   
    var jsonLength = jsonData.results.length;
    var _build="";
    var controller=0;
    var stats=0;
    var header="";
      var edit_build="";
    var modal_build="";
     var identifier; 
  
        var jsonData = JSON.parse(data);
   
      if(jsonData.results[0].ERROR_CHECK=='002'){
          console.log(jsonData.results[0].ERROR_MSG);
          console.log( "Length of Data Response"+jsonLength);
       jQuery("#"+display).html(''); 
          if (jsonData.results[0].ERROR_MSG == null ){
          _build='NO DATA TO DISPLAY';
          }
          else{
                _build='SORRY ERROR GETTING DATA  WITH ERROR CODE ('+jsonData.results[0].ERROR_MSG+')';
          }
      } else{
      
  
    for (var i = 1; i < jsonLength; i++) {
        
      var result = jsonData.results[i];
//        var token =  $(".token_id").attr("id").slice(10); 
//        Object.keys(result).length
       for(var index in result) {
        if(stats < control){
         header += '<th>'+index+'</th>';
            stats++;
            
            if (stats == control){
             header += '<th>ACTIONS</th>' 
              //this is to make sure controller is higher than the database row head so as to add action buttons
           }
           }
      
       if(controller==0){
                table+="<tr id="+result[index]+">";
//           identifier =result[index];
            }     
       controller++;
//          console.log(controller);
//           console.log(Object.keys(result).length);
                     switch(result[index]) {
  case "Pending..":
    table += '<td id="'+result[index]+'"><button class="btn btn-outline-secondary" >'+result[index]+'</button></td>';                
   edit_build ='<button type="button" id="edit_general" class="btn btn-outline-warning edit-cat-button"> EDIT </button><p></p> ';
    break;
  case "Validated..":
   table += '<td id="'+result[index]+'"><button class="btn btn-outline-success">'+result[index]+'</button></td>'; 
    break;
    case "Rejected..":
   table += '<td id="'+result[index]+'"><button  class="btn btn-outline-danger">'+result[index]+'</button></td>'; 
    break;                 
  default:
    table += '<td id="'+result[index]+'">'+result[index]+'</td>'; 
   break;
} 
      
           
//       modal_build += '<div class="modal dark_bg fade" id="dyn_modal_'+result.privil_id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Editing '+result.type+'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="text-center"><h4  id="2_msg" >All fields are required</h4></div><form class="forming" id="contactForm"  action="#"><div id="dept_box" class="form-group"><label for="recipient-name" class="form-control-label">Department Name:</label><input type="text" class="form-control" id="dept" value="'+result.type+'"   name="dept"><div id="error_dept" class="form-control-feedback"></div><input type="hidden" class="form-control" value="'+token+'" name="token_id"><div style=" display:none;" id="error_token_id" class="form-control-feedback"></div><input type="hidden" class="form-control" value="'+result.privil_id+'" name="privil_id"><div style=" display:none;" id="error_privil_id" class="form-control-feedback"></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" id="submitButton" onclick= "openValidateForm(this.form,this,\'resources/edit_dept\',\'privil\');" class="btn btn-primary btn-labeled btn-labeled-right"><b><i id="msgSubmit"></i></b><span id="btntext"> Edit Department</span></button></div></form></div></div></div></div>';
           
           
           
            if(controller ==control){
             //use this line of code to set the controller to 0 so it can build the next row of the table
            table+= '<td id="'+tab+'">'+edit_build+'<button type="button" id="view_general" class="btn btn-outline-primary edit-cat-button"> VIEW </button></td></tr>';
             
            controller=0;
                break;
        }
            
          
       }       
      }
          
      _build += '<table class="table table-bordered table-striped"><thead><tr>'+header+'</tr></thead><tbody >'+table+'</tbody></table>';  
    
      }
       $('#'+display).html(_build);
//       $('#modal_home').html(modal_build);
      
        
      
        });
   
}





function prog_dynDataPull(tab,display,control){
     jQuery("#"+display).html('<center><img src="loader2.gif"></center>'); 
    
     var table = "";
   
    
  $.ajax({
    type: "GET",
    url: 'resources/dyn_puller',
    data: 'tab='+tab
  }).done( function( data )
  {
   
        var jsonData = JSON.parse(data);
   
    var jsonLength = jsonData.results.length;
    var _build="";
    var controller=0;
    var stats=0;
    var header="";
    var modal_build="";
     var identifier; 
  
        var jsonData = JSON.parse(data);
   
      if(jsonData.results[0].ERROR_CHECK=='002'){
          console.log(jsonData.results[0].ERROR_MSG);
          console.log( "Length of Data Response"+jsonLength);
       jQuery("#"+display).html(''); 
          _build='SORRY ERROR GETTING DATA'+jsonData.results[0].ERROR_MSG;
      } else{
      
  
    for (var i = 1; i < jsonLength; i++) {
        
      var result = jsonData.results[i];
      var data_len =  Object.keys(result).length;
        console.log( "Length of Data inbox"+data_len);
         console.log( "Length of Data Response"+jsonLength);
//        var token =  $(".token_id").attr("id").slice(10); 
//        Object.keys(result).length
       for(var index in result) {
      
        if(stats < data_len){
         header += '<th>'+index+'</th>';
            stats++;
           }
      
            
       if(controller==0){
                table+="<tr id="+result[index]+">";
//           identifier =result[index];
            }     
       controller++;
//          console.log(controller);
//           console.log(Object.keys(result).length);
           if(result[index]=='0001'){ result[index]="<b style ='color:blue;'>CONNECTED</b>"; } else if (result[index]=='0002') {result[index]="<b style ='color:red;'>DISCONNECTED</b>"; }
           table += '<td id="'+result[index]+'">'+result[index]+'</td>';   
           
           
            if(controller ==data_len){
             //use this line of code to set the controller to 0 so it can build the next row of the table
            table+= '</tr>';
             
            controller=0;
                break;
        }
            
          
       }       
      }
          
      _build += '<table class="table table-bordered table-striped"><thead><tr>'+header+'</tr></thead><tbody >'+table+'</tbody></table>';  
    
      }
       $('#'+display).html(_build);
//       $('#modal_home').html(modal_build);
      
        
      
        });
   
}


function prog_statsDataPull(tab,display,control){
     jQuery("#"+display).html('<center><img src="loader2.gif"></center>'); 
    
     var table = "";
   
    
  $.ajax({
    type: "GET",
    url: 'resources/dyn_puller',
    data: 'tab='+tab
  }).done( function( data )
  {
   
        var jsonData = JSON.parse(data);
   
    var jsonLength = jsonData.results.length;
    var _build="";
    var controller=0;
    var stats=0;
    var header="";
      var edit_build="";
    var modal_build="";
     var identifier; 
  
        var jsonData = JSON.parse(data);
   
      if(jsonData.results[0].ERROR_CHECK=='002'){
          console.log("STAT ERROR MESSAGE: "+jsonData.results[0].ERROR_MSG);
          console.log( "Length of Data Response"+jsonLength);
       jQuery("#"+display).html(''); 
          if (jsonData.results[0].ERROR_MSG == null ){
          _build='NO DATA TO DISPLAY';
          }
          else{
                _build='SORRY ERROR GETTING DATA  WITH ERROR CODE ('+jsonData.results[0].ERROR_MSG+')';
          }
      } else{
      
  
    for (var i = 1; i < jsonLength; i++) {
        
      var result = jsonData.results[i];
//        var token =  $(".token_id").attr("id").slice(10); 
//        Object.keys(result).length
       for(var index in result) {
        if(stats < control ){
         header += '<th>'+index+'</th>';
            stats++;
            
            if (stats == control){
//             header += '<th>ACTIONS</th>' 
              //this is to make sure controller is higher than the database row head so as to add action buttons
           }
           }
      
       if(controller==0){
                table+="<tr id="+result[index]+">";
//           identifier =result[index];
            }     
       controller++;
//          console.log(controller);
//           console.log(Object.keys(result).length);
                     switch(result[index]) {
  case "Pending..":
    table += '<td id="'+result[index]+'"><button class="btn btn-outline-secondary" >'+result[index]+'</button></td>';                
   edit_build ='<button type="button" id="edit_general" class="btn btn-outline-warning edit-cat-button"> EDIT </button><p></p> ';
    break;
  case "Validated..":
   table += '<td id="'+result[index]+'"><button class="btn btn-outline-success">'+result[index]+'</button></td>'; 
    break;
    case "Rejected..":
   table += '<td id="'+result[index]+'"><button  class="btn btn-outline-danger">'+result[index]+'</button></td>'; 
    break;                 
  default:
    table += '<td id="'+result[index]+'">'+result[index]+'</td>'; 
   break;
} 
      
           
//       modal_build += '<div class="modal dark_bg fade" id="dyn_modal_'+result.privil_id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Editing '+result.type+'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="text-center"><h4  id="2_msg" >All fields are required</h4></div><form class="forming" id="contactForm"  action="#"><div id="dept_box" class="form-group"><label for="recipient-name" class="form-control-label">Department Name:</label><input type="text" class="form-control" id="dept" value="'+result.type+'"   name="dept"><div id="error_dept" class="form-control-feedback"></div><input type="hidden" class="form-control" value="'+token+'" name="token_id"><div style=" display:none;" id="error_token_id" class="form-control-feedback"></div><input type="hidden" class="form-control" value="'+result.privil_id+'" name="privil_id"><div style=" display:none;" id="error_privil_id" class="form-control-feedback"></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" id="submitButton" onclick= "openValidateForm(this.form,this,\'resources/edit_dept\',\'privil\');" class="btn btn-primary btn-labeled btn-labeled-right"><b><i id="msgSubmit"></i></b><span id="btntext"> Edit Department</span></button></div></form></div></div></div></div>';
           
           
           
            if(controller ==control){
             //use this line of code to set the controller to 0 so it can build the next row of the table
//            table+= '<td id="'+tab+'">'+edit_build+'<button type="button" id="view_general" class="btn btn-outline-primary edit-cat-button"> VIEW </button></td></tr>';
             
            controller=0;
                break;
        }
            
          
       }       
      }
          
      _build += '<table class="table table-bordered table-striped"><thead><tr>'+header+'</tr></thead><tbody >'+table+'</tbody></table>';  
    
      }
       $('#'+display).html(_build);
//       $('#modal_home').html(modal_build);
      
        
      
        });
   
}




