$(document).ready(function() {
  
//start_withdraw_postal();
 $("#Other_Sources_Details").defaultValue = "NONE STATED"; 
  $("#association_details").defaultValue = "NONE STATED"; 
  load_error();
}); 
// --------------general functions------------------------

function single_disabled(id,element){
  if ( $(element).prop('value')=='YES'){
          $("#"+id).prop('readonly', false);
         $("#"+id).attr("disabled", false);
       
    }
    else{ 
         $("#"+id).prop('readonly', true);
         $("#"+id).attr("disabled", true);
        $("#"+id).defaultValue = "NONE STATED"; 
         
    }
     console.log($("#"+id).prop('value'));
}

function load_error(){
//-----------------------------------------
$('#Other_Income_Sources').on('change', function() {
     single_disabled("Other_Sources_Details",this);

});

//-----------------------------------------
    $('#Association_Member').on('change', function() {
    if ( $(this).prop('value')=='YES'){

        
        
        $('#association_details').find(':input').each(function(){


      $(this).prop('disabled', false);
      $(this).prop('readonly', false);
 
    
});
    }
    else{ 
         
         $('#association_details').find(':input').each(function(){
       $(this).prop('disabled', true);
         $(this).prop('readonly', true);
             $(this).defaultValue = "NONE STATED"; 
              console.log($(this).prop('defaultValue'));
      });
          
    }

});
 
//-----------------------------------------

    $('#Marital_Status').on('change', function() {
    if ( $(this).prop('value')!='SINGLE'){

        
        
        $('#Spouse_details').find(':input').each(function(){


      $(this).prop('disabled', false);
      $(this).prop('readonly', false);
 
    
});
    }
    else{ 
         
         $('#Spouse_details').find(':input').each(function(){
       $(this).prop('disabled', true);
         $(this).prop('readonly', true);
             $(this).defaultValue = "NONE STATED"; 
              console.log($(this).prop('defaultValue'));
      });
          
    }

});


//-------------------------------------
  $('#Any_Children').on('change', function() {
    if ( $(this).prop('value')!='NO'){

        
        
        $('#Children_details').find(':input').each(function(){


      $(this).prop('disabled', false);
      $(this).prop('readonly', false);
 
    
});
    }
    else{ 
         
         $('#Children_details').find(':input').each(function(){
       $(this).prop('disabled', true);
         $(this).prop('readonly', true);
             $(this).defaultValue = "NONE STATED"; 
              console.log($(this).prop('defaultValue'));
      });
          
    }

});

//----------------------------------------


    $('#Other_Payment_Means').on('change', function() {
    if ( $(this).prop('value')=='YES'){

        
        
        $('#other_repayment').find(':input').each(function(){


      $(this).prop('disabled', false);
      $(this).prop('readonly', false);
 
    
});
    }
    else{ 
         
         $('#other_repayment').find(':input').each(function(){
       $(this).prop('disabled', true);
         $(this).prop('readonly', true);
             $(this).defaultValue = "NONE STATED"; 
              console.log($(this).prop('defaultValue'));
      });
          
    }

});
 //-------------------------------------------



  $('#Account_Other_Banks').on('change', function() {
      single_disabled("Name_Of_Banks",this);
});

//------------------------------------------------------


  $('#Engagement_Other_Banks').on('change', function() {
   single_disabled("Engagement_Amounts",this);
      var counter =0;
      var textholder;
        $('#template-contactform').find(':input').each(function(){
       counter++;
         console.log(counter); 
        console.log( $(this).attr('id')); 
        textholder+=counter; 
        textholder+='<br/>';
        textholder+=$(this).attr('id');
        textholder+='<br/>';
        
      });
               jQuery("#table_builder").html(textholder); 
  
     
});

//------------------------------------------ sending to server


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
function loan_function(){
   
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
    url: 'resources/loan_process.php',
    type: "GET",
    dataType: "json",
    data: {
        'action': "exec_find",
        'data': myJsonString
    },
        success : function(text){
          if(text[0]==1){
            clear_checker=text[2];
       
var field_one=["Name", "Account_Number", "Branch", "NIU", "Identification_Papers", "Identification_Number", "Done_At", "Done_On", "mobile_phone", "email_address", "Customer_Address", "Customer_Town"];
var field_two=[ "Marital_Status", "Marital_Type", "Spouse_Name", "Spouse_Profession", "Spouse_mobile_phone", "Spouse_email_address", "Personal_Contact_Name", "Personal_Contact_Relationship", "Personal_Contact_Profession", "Personal_Contact_mobile_phone", "Personal_Contact_email_address", "Any_Children", "Children_Number", "children_mobile_phone", "Association_Member", "Association_Name", "Association_Venue", "Association_President", "President_Contact"];
var field_three=["Amount_requested", "Loan_duration", "Loan_Type", "Loan_purpose", "Loan_security", "Principal_Payment_Means", "Other_Payment_Means", "Secondary_Payment_Means", "Source_Of_Funds", "Surety_Name", "Surety_Identification_Papers", "Surety_Identification_Number", "Surety_Done_At", "Surety_Done_On", "Surety_Contact_Profession", "Surety_Contact_mobile_phone", "Surety_Contact_email_address"];
var field_four=[ "Current_Employer", "Employment_Date", "Matricule", "Employer_Mobile_Phone", "Employer_Email_Address", "Employer_Street", "Employer_Town", "Employer_Region", "Average_Monthly_Salary", "Other_Income_Sources", "Other_Sources_Details", "Average_Monthly_Income", "Rents","Feeding", "Transportation", "Utility_Bills", "Social_Contributions", "Donations","Health", "Other_Expenses", "Average_Monthly_Expenditure", "Account_Other_Banks", "Name_Of_Banks", "Engagement_Other_Banks", "Engagement_Amounts"];
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
                   console.log("------------------logtab4---------------------");
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
     console.log("form was updated successfully ------------");
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