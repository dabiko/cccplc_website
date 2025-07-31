var lastTimeID=0;
var opener_holder=1;
$(document).ready(function() {
 
//start_withdraw_postal();
    var control = $('.naming_doc').parent().attr('id');
    console.log('This is our controller: '+control);
    if (control=="cv_situations"){
    
 prog_cvDataPull("cv_bak","preview_cv","hr",7);
    
   }
    else if (control=="account_opening_situations"){
 prog_catDataPull("accounts_bak","preview_accounts","accounts",7);
    }else{
//     initDatatable;
prog_catDataPull("tb_loans_bak","preview_loans","tb_loan",8);
    }
    prog_dynDataPull("customer_logs","preview_logs","0001");
 


}); 


// pull data for all accounts opened 





function initDatatable(){
     console.log("Initialize Found  *********1111*************");
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
         console.log("Initialize Found  **********************");
        
    });
 
   
    var table = $('#example').DataTable(
        
        {

     autoWidth: false,
  
                // The columns are explicitly
                // specified as the column array
//                columns: [
//                    { "width": "10%" },
//                    { "width": "20%" },
//                    { "width": "10%" },
//                    { "width": "15%" },
//                    { "width": "15%" },
//                    { "width": "20%" },
//                    { "width": "10%" }
//                ],
        initComplete: function () {
            // Apply the search
            
            var api=this.api()
                .columns()
                .every(function () {
                    var that = this;
  console.log("Initialize Found  **********************");
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
       
        api.columns.adjust();
        api.responsive.recalc();;
        
        },

    });
    
}
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


function validator(message){
    
     swal({  
      title: " Confirm?",  
      text: message,  
      type: "warning",  
      showCancelButton: true,  
      confirmButtonClass: "btn-danger",  
      confirmButtonText: " Confirm !",  
      cancelButtonText: "No, cancel ",  
      closeOnConfirm: true,  
      closeOnCancel: false  
    },  
    function(isConfirm) {  
      if (isConfirm) {  
          
         $(".bs-example-modal-sm").modal('show');  
      } else {  
     swal({
                            title: 'ALERT',
                            text: 'Operation Cancelled',
                            type: 'success',
                            showConfirmButton: true
                        });   
      }  
    });  
    
}

//this is tho handle validation of loans
 $(document).on("click", '#uni_validate_loan', function () {

report_header.ID=$("#carry").html();
var Namer=$("#Name").val();
report_header.TAB='tb_loan';
report_header.STATUS='1';
report_header.CUSTOMER=$("#identify_cus").html();
     
  jQuery("#preview_edit").html('<center><img src="loader2.gif"></center>'); 
     
     validator("ARE YOU SURE YOU WANT VALIDATE "+Namer+" LOAN ?");
    
    
})

//this is to handle rejection of loans
 $(document).on("click", '#uni_reject_loan', function () {

report_header.ID=$("#carry").html();
var Namer=$("#Name").val();
report_header.TAB='tb_loan';
report_header.STATUS='2';
report_header.CUSTOMER=$("#identify_cus").html();
     
  jQuery("#preview_edit").html('<center><img src="loader2.gif"></center>'); 
     
     validator("ARE YOU SURE YOU WANT REJECT "+Namer+" LOAN ?");
    
    
})

//this is to handle validation of accounts

 $(document).on("click", '#uni_validate_acc', function () {

report_header.ID=$("#carry").html();
var Namer=$("#Given_Names").val();
report_header.TAB='accounts';
report_header.STATUS='1';
report_header.CUSTOMER=$("#identify_cus").html();
     
  jQuery("#preview_edit").html('<center><img src="loader2.gif"></center>'); 
     
     validator("ARE YOU SURE YOU WANT VALIDATE "+Namer+" LOAN ?");
    
    
})

//this is to handle rejection of accounts 

 $(document).on("click", '#uni_reject_acc', function () {

report_header.ID=$("#carry").html();
var Namer=$("#Given_Names").val();
report_header.TAB='accounts';
report_header.STATUS='2';
report_header.CUSTOMER=$("#identify_cus").html();
     
  jQuery("#preview_edit").html('<center><img src="loader2.gif"></center>'); 
     
     validator("ARE YOU SURE YOU WANT REJECT "+Namer+" LOAN ?");
    
    
})


function delval_process(){
     var table = "";
//     var unique_id;
//     if (tab=="tb_loan"){
//          unique_id="loan_id";
//     } else{
//          unique_id="account_id";
//     }
//   $("#taboner").trigger("click");
    
var motif =$("#comment").val();
  $.ajax({
    type: "GET",
    url: 'resources/delval.php',
    data: {
        "id": report_header.ID, 
        "tab": report_header.TAB, 
        "motif": motif,
        "customer_id": report_header.CUSTOMER, 
        "status": report_header.STATUS
    },
   success : function(text){
        var text = JSON.parse(text);
       
       console.log(text);
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
                
                
                
  var control = $('.naming_doc').parent().attr('id');
    if (control=="account_opening_situations"){
 prog_catDataPull("accounts_bak","preview_accounts","accounts",7);
    }else{
//     initDatatable;
prog_catDataPull("tb_loans_bak","preview_loans","tb_loan",8);
     
            }
                 $(".bs-example-modal-lg").modal('hide');
                 $(".bs-example-modal-sm").modal('hide');
     
         jQuery("#loader").html('');
        }
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




// pull data for all accounts opened 


function prog_catDataPull(tab,display,mytab,control){
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
           
           
           
            if(controller == control){
             //use this line of code to set the controller to 0 so it can build the next row of the table
                if (tab=="accounts_bak"){
                    
                 table+= '<td id="'+mytab+'"><p></p><button type="button" id="view_general_accounts" class="btn btn-outline-primary edit-cat-button"> VIEW </button></td></tr>';    
                    
                }else{
            table+= '<td id="'+mytab+'"><p></p><button type="button" id="view_general" class="btn btn-outline-primary edit-cat-button"> VIEW </button></td></tr>';
                }
            controller=0;
                break;
        }
            
          
       }       
      }
          
      _build += '<div class="col-md-9 "><table id="example" class="display" ><thead><tr>'+header+'</tr></thead><tbody >'+table+'</tbody><tfoot><tr>'+header+'</tr></tfoot></table></div>';  
    
      }
       $('#'+display).html(_build);
//       $('#modal_home').html(modal_build);
      
        
  initDatatable();
});
      
       
  
}



// pull data for all accounts opened 


function prog_cvDataPull(tab,display,mytab,control){
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
 table += '<td id="'+result[index]+'">'+result[index]+'</td>'; 
           console.log('CONTROLLER COUNTER'+controller)
           
           
            if(controller == control){
             //use this line of code to set the controller to 0 so it can build the next row of the table
              
                    
                 table+= '<td id="'+mytab+'"><p></p><button type="button" id="view_cv_accounts" class="btn btn-outline-primary edit-cat-button"> VIEW DETAILS </button></td></tr>';    
                    console.log('wrting equivelance');
             
            controller=0;
                break;
        }
            
          
       }       
      }
          
      _build += '<div class="col-md-9 "><table id="example" class="display" ><thead><tr>'+header+'</tr></thead><tbody >'+table+'</tbody><tfoot><tr>'+header+'</tr></tfoot></table></div>';  
    
      }
       $('#'+display).html(_build);
//       $('#modal_home').html(modal_build);
      
        
  initDatatable();
});
      
       
  
}



