$(document).ready( function() {
    load_acc_errors();
    
    });
function load_acc_errors(){

$('#Existing_Account').on('change', function() {
    if ( $(this).prop('value')=='YES'){
var text=' <div class="col_half col_last"><label for="template-contactform-email">( IF YES ) Existing Account Number <small>*</small></label> <input type="text" id="Existing_Account_Number" name="Existing_Account_Number"  class="required Existing_Account_Number sm-form-control" /></div>';
 jQuery("#Existing_Account_Details").html(text); 
    }
    else{ 
         jQuery("#Existing_Account_Details").html(''); 
    }
    console.log($(this).prop('value'));
});
    
    
$('#Other_Income_Sources').on('change', function() {
    if ( $(this).prop('value')=='YES'){
var text=' <div class="col_full"><label for="template-contactform-email"> WHAT ARE YOUR OTHER SOURCES ? (IF ANY) <small>*</small></label> <input type="text" id="Other_Sources_Details" name="Other_Sources_Details"  class="required Other_Sources_Details sm-form-control" /></div>';
 jQuery("#Income_Sources_Details").html(text); 
    }
    else{ 
         jQuery("#Income_Sources_Details").html(''); 
    }
    console.log($(this).prop('value'));
});
 
    
 $('#Children_Number').on('input',function(){
    if ( $(this).prop('value')>0){
var text='<div class="col_full"><label for="template-contactform-email"> CHILDREN NAMES AND DATE OF BIRTH <small>*</small></label><TEXTAREA type="text" id="Children_Names" name="Children_Names"  class="required Children_Names sm-form-control" ></TEXTAREA></div>';
 jQuery("#Children_Details").html(text); 
         console.log(text);
    }
    else{ 
         jQuery("#Children_Details").html(''); 
    }
   
});    
    

    $('#Association_Member').on('change', function() {
    if ( $(this).prop('value')=='YES'){
var text='   <div class="col_half"> <label for="template-contactform-name">ASSOCIATION NAME <small>*</small></label> <input type="text" id="Association_Name" name="Association_Name" class="required sm-form-control" /> </div> <div class="col_half col_last"> <label for="template-contactform-name"> MEETING VENUE <small>*</small></label> <input type="text" id="Association_Venue" name="Association_Venue" class="required sm-form-control" /> </div> <div class="col_half"> <label for="template-contactform-email"> NAME OF THE ASSOCIATION\'S PRESIDENT <small>*</small></label> <input type="text" id="Association_President" name="Association_President" class="required code sm-form-control" /> </div> <div class="col_half col_last"><label for="template-contactform-name"> PRESIDENT CONTACT <small>*</small></label> <input type="number" id="President_Contact" name="President_Contact" class="required sm-form-control" /></div>';
 jQuery("#association_details").html(text); 
    }
    else{ 
         jQuery("#association_details").html(''); 
    }
    console.log($(this).prop('value'));
});
    
}


