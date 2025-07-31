 function scrollToElement(elementId) {
      var element = document.getElementById(elementId);
     const offset = 300;
     var container = document.getElementById('processTabs');
    const bodyRect = container.getBoundingClientRect().top;
    const elementRect = element.getBoundingClientRect().top;
    const elementPosition = elementRect - bodyRect;
    const offsetPosition = elementPosition - offset;
    element.scrollIntoView({ top:offsetPosition, behavior: 'smooth', block: 'start', inline: 'nearest' })
//element.scrollIntoView({  behavior: 'smooth', block: 'nearest', inline: 'start' });
     
//var container = $('#processTabs'),
//    scrollTo = $(elementId);
//    scrollTo =$('#'+elementId);

//container.scrollTop(
//    scrollTo.offset().top - container.offset().top + container.scrollTop()
//);
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


function edit_account_function(){
   
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
    url: 'resources/editaccount_process.php',
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
//      scroll(my_id);
       scrollToElement(my_id);

    } else {
  console.log("form was closed abruptly");
    }
 });  
                          
          }
            else{
                  prog_catDataPull("accounts","preview_accounts"); 
                            swal({

  title: 'Great...',
  text: text[1],
    type: 'success',
     showConfirmButton: true
//  footer: '<a href="">Why do I have this issue?</a>'
} ,function(isConfirm){

   if (isConfirm){
     console.log("form was updated successfully");
         $(".bs-example-modal-lg").modal('hide');

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



function loan_update_function(){
   
//var form = $('form')[0]; // You need to use standard javascript object here
      
    
    
    
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
    url: 'resources/editloan_process.php',
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
                          
          }
            else{
                  prog_catDataPull("tb_loan","preview_loans"); 
swal({

  title: 'Great...',
  text: text[1],
    type: 'success',
     showConfirmButton: true
//  footer: '<a href="">Why do I have this issue?</a>'
} ,function(isConfirm){

   if (isConfirm){
     console.log("form was updated successfully");
         $(".bs-example-modal-lg").modal('hide');

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

