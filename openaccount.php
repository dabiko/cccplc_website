
<!DOCTYPE html>
<?php

require_once('resources/loginity.php');
 auth_cuscheck();
_token();
$_SESSION['header']=1;

require_once('header.php');
?>


<section id="content">
<div class="content-wrap">
<div class="container clearfix">
<div class="row clearfix">
<div class="col-md-9">
<img src="images/icons/avatar.jpg" class="alignleft img-circle img-thumbnail notopmargin nobottommargin" alt="Avatar" style="max-width: 84px;">
<div class="heading-block noborder">
<h3> CCC PLC ONLINE </h3>
<span> WELCOME BACK <?php echo $_SESSION['ccc_cususername']; ?></span>
</div>
<div class="clear"></div>
<div class="row clearfix">
<div class="col-lg-12">

<div id="processTabs">
<ul class="process-steps bottommargin clearfix">
<li>
<a href="#ptab1" id="tab1"  class="i-circled i-bordered i-alt divcenter">1</a>
<h5>PERSONAL INFORMATION</h5>
</li>
<li>
<a href="#ptab2" id="tab2"  class="i-circled i-bordered i-alt divcenter">2</a>
<h5>SOCIAL STATUS</h5>
</li>
<li>
<a href="#ptab3" id="tab3" class="i-circled i-bordered i-alt divcenter">3</a>
<h5>ACCOUNT DETAILS</h5>
</li>
<li>
<a href="#ptab4"  id="tab4" class="i-circled i-bordered i-alt divcenter">4</a>
<h5>OTHER INFORMATION</h5>
</li>
</ul>
<div>
    <form class="nobottommargin" id="template-contactform" name="template-contactform" enctype="multipart/form-data">
<div id="ptab1">
    <p class="beautify">After having read the Account Opening general agreement herein, I (we) the undersigned request Community Credit Company PLC to open an Account for me (us) in their books as follows:</p>

       <div class="fancy-title topmargin title-dotted-border">
                 <h3> PERSONAL INFORMATION </h3>

             </div> 
    <div id="contact-form-overlay" class="clearfix bottommargin">
            
            <div class="col_half">

                <label for="template-contactform-name">Surname<small>*</small></label>
                <input type="text" id="surname" name="surname" class="sm-form-control required" />

            </div>
            <div class="col_half col_last">
                <label for="template-contactform-name">Given Name (s) <small>*</small></label>
                <input type="text" id="Given_Names" name="Given_Names" class="sm-form-control required" />
            </div>
            <div class="col_full">

                <label for="template-contactform-name">Current address: <small>*</small></label>
                <input type="text" id="address" name="address" required class="required sm-form-control" />

            </div>

            <div class="col_half">
                <label for="template-contactform-name">Date Of Birth <small>*</small></label>
                <input type="date" id="Date_Of_Birth" name="Date_Of_Birth" class="required sm-form-control" />
            </div>
            <div class="col_half col_last">
                <label for="template-contactform-name">Place of Birth  <small>*</small></label>
                <input type="text" id="Birth_Place" name="Birth_Place" class="required  sm-form-control" />
            </div>
            <div class="col_half">
                <label for="template-contactform-name">Division <small>*</small></label>
                <input type="text" id="Division" name="Division" class="required  sm-form-control" />
            </div>
            <div class="col_half col_last">
                <label for="template-contactform-name"> Region <small>*</small></label>
                <input type="text" id="Region" name="Region" class="required insurance sm-form-control" />
            </div>
            <div class="col_half">
                <label for="template-contactform-name"> Nationality <small>*</small></label>
                <input type="text" id="Nationality" name="Nationality" class="required insurance sm-form-control" />
            </div>
           <div class="col_half col_last">
               <label for="inputState"> Gender </label>
               <select id="Gender" name="Gender" class="form-control">
                   <option value="">CHOOSE ONE</option>
                   <option value="MALE">MALE</option>
                   <option value="FEMALE">FEMALE</option>
                   <option value="NO_DISCLOSURE">I DO NOT WISH TO DISCLOSE THIS</option>
               </select>
<!--               <div class="clear"></div>-->

           </div>
            <div class="col_half">
               
                <label for="inputState">  Identification Papers </label>
                <select id="Identification_Papers"  name="Identification_Papers" class="form-control">
                    <option value="">CHOOSE ONE</option>
                    <option value="National_Identity_Card"> National Identity Card</option>
                    <option value="Passport">Passport</option>
                    <option value="Driving License">Driving License</option>
                </select> 
            </div>
            <div class="col_half col_last">
                <label for="template-contactform-email"> Identification Number <small>*</small></label>
                <input type="text" id="Identification_Number" name="Identification_Number" class="required code sm-form-control" />
            </div>
             <div class="col_one_third">
                <label for="template-contactform-name">AT  <small>*</small></label>
                <input type="text" id="Done_At" name="Done_At" class="required  sm-form-control" />
            </div>
             <div class="col_one_third">
                <label for="template-contactform-name">ON  <small>*</small></label>
                <input type="text" id="Done_On" name="Done_On" class="required  sm-form-control" />
            </div>
            <div class="col_one_third col_last">
                <label for="template-contactform-email"> Expiry Date <small>*</small></label>
                <input type="date" id="Expiry_Date" name="Expiry_Date" class="required code sm-form-control" />
            </div>
            <div class="col_half">
                <label for="template-contactform-name">Mobile Number <small>*</small></label>
                <input type="number" id="mobile_phone" name="mobile_phone" class="required  sm-form-control" />
            </div>
            <div class="col_half col_last">
                <label for="template-contactform-email"> Email Address <small>*</small></label>
                <input type="email" id="email_address" name="email_address" class="required code sm-form-control" />
            </div>

        </div>
              
             <div class="line"></div>
             <!--    <div id='err'></div>-->

    
<a href="#" class="button button-3d nomargin fright tab-linker" rel="2">NEXT</a>  
</div>
<div id="ptab2">
     <div class="fancy-title topmargin title-dotted-border">
                 <h3> SOCIAL STATUS </h3>

             </div>


             <div id="contact-form-overlay" class="clearfix topmargin bottommargin">
            <div class="col_half">

                <label for="template-contactform-name">Marital Status <small>*</small></label>
                <input type="text" id="Marital_Status" name="Marital_Status" class="sm-form-control required" />

            </div>
            <div class="col_half col_last">
                <label for="template-contactform-name">Type <small>*</small></label>
                <input type="text" id="Marital_Type" name="Marital_Type" class="sm-form-control required" />
            </div>
                 <div class="col_half">
                <label for="template-contactform-name"> Address <small>*</small></label>
                <input type="text" id="Spouse_Address" name="Spouse_Address" class="sm-form-control required" />
            </div>
                 <div class="col_half col_last">
                <label for="template-contactform-name">Town <small>*</small></label>
                <input type="text" id="Spouse_Town" name="Spouse_Town" class="sm-form-control required" />
            </div>
                  <div class="col_half">
                <label for="template-contactform-name">Mobile Number <small>*</small></label>
                <input type="number" id="Spouse_mobile_phone" name="Spouse_mobile_phone" class="required  sm-form-control" />
            </div>
            <div class="col_half col_last">
                <label for="template-contactform-email"> Email Address <small>*</small></label>
                <input type="email" id="Spouse_email_address" name="Spouse_email_address" class="required code sm-form-control" />
            </div>
             </div>
         <div class="fancy-title topmargin title-dotted-border">
                 <h3> CONTACT PERSON </h3>

             </div>


             <div id="contact-form-overlay" class="clearfix topmargin bottommargin">
            <div class="col_half">

                <label for="template-contactform-name">Name <small>*</small></label>
                <input type="text" id="Personal_Contact_Name" name="Personal_Contact_Name" class="sm-form-control required" />

            </div>
            <div class="col_half col_last">
                <label for="template-contactform-name">Relationship <small>*</small></label>
                <input type="text" id="Personal_Contact_Relationship" name="Personal_Contact_Relationship" class="sm-form-control required" />
            </div>
                 <div class="col_full">
                <label for="template-contactform-name"> Profession <small>*</small></label>
                <input type="text" id="Personal_Contact_Profession" name="Personal_Contact_Profession" class="sm-form-control required" />
            </div>
                  <div class="col_half">
                <label for="template-contactform-name">Mobile Number <small>*</small></label>
                <input type="text" id="Personal_Contact_mobile_phone" name="Personal_Contact_mobile_phone" class="required  sm-form-control" />
            </div>
            <div class="col_half col_last">
                <label for="template-contactform-email"> Email Address <small>*</small></label>
                <input type="email" id="Personal_Contact_email_address" name="Personal_Contact_email_address" class="required code sm-form-control" />
            </div>
             </div>
<div class="line"></div>
<a href="#" class="button button-3d nomargin tab-linker" rel="1">PREVIOUS</a>
<a href="#" class="button button-3d nomargin fright tab-linker" rel="3"> NEXT</a>
</div>
<div id="ptab3">
   
  <div class="fancy-title topmargin title-dotted-border">
<h3>ACCOUNT DETAILS </h3>

</div>   
    
       
     <div id="contact-form-overlay" class="clearfix topmargin bottommargin">
         
        
   <div class="col_half">
       <label for="inputState"> DO YOU HAVE AN ACCOUNT WITH US?</label>
       <select id="Existing_Account" name="Existing_Account" class="form-control">
           <option value="">CHOOSE ONE</option>
           <option value="YES">YES</option>
           <option value="NO">NO</option>
       </select>
   </div>
   <div id="Existing_Account_Details"> </div>
   <div class="col_half">
       <label for="inputState"> ACCOUNT TYPE </label>
       <select id="Account_Type" name="Account_Type" class="form-control">
           <option value="">CHOOSE ONE</option>
           <option value="CURRENT">CURRENT</option>
           <option value="SAVINGS">SAVINGS</option>
           <option value="BUSINESS">BUSINESS</option>
       </select>
   </div>                   

     <div class="col_half col_last">
               
                <label for="inputState">  BRANCH </label>
                <select id="Branch"  name="Branch" class="form-control">
                    <option value="">CHOOSE ONE</option>
                      <option value="BAMENDA"> 00100: BAMENDA</option>
                      <option value="BATIBO"> 00200: BATIBO</option>
                       <option value="WARDA">00300: WARDA</option>
                       <option value="REPUBLIQUE">00400: REPUBLIQUE</option>
                       <option value="BUEA">00500: BUEA</option>
                       <option value="KUMBA">00600: KUMBA</option>
                       <option value="LIBERTE">00700: LIBERTE</option>
                       <option value="BONABERI">00800: BONABERI</option>
                       <option value="TIKO">00900: TIKO</option>
                       <option value="SAPHIR">01000: SAPHIR</option>
                       <option value="ACROPOLE">01100: ACROPOLE</option>   
                       <option value="BAFOUSSAM">01200: BAFOUSSAM</option>
<!--                       <option value="HEAD OFFICE">01300: HEAD OFFICE</option>-->
                       <option value="KRIBI">01400: KRIBI</option>
                       <option value="MUYUKA">01500: MUYUKA</option>
                       <option value="LIMBE">01600: LIMBE</option>
                       <option value="BIYEMASSI">01700: BIYEMASSI</option>
                       <option value="BAMBILI">01800: NDOGPASSI</option>
                       <option value="BAMBILI">01900: BAMBILI</option>
                       <option value="NGAOUNDERE">00200: NGAOUNDERE </option>
         </select>
    </div>
    
       <div class="col_half">
                <label for="template-contactform-email"> ACTIVITY SECTOR <small>*</small></label>
                <input type="text" id="Activity_Sector" name="Activity_Sector" class="required code sm-form-control" />
            </div>
          <div class="col_half col_last">
       <label for="inputState"> ARE YOU A SHARE HOLDER? </label>
       <select id="Share_holder" name="Share_holder" class="form-control">
           <option value="">CHOOSE ONE</option>
           <option value="YES">YES</option>
           <option value="NO">NO</option>
       </select>
   </div>
    
            <div class="col_half">
                <label for="template-contactform-email"> PROFESSION <small>*</small></label>
                <input type="text" id="Profession" name="Profession" class="required code sm-form-control" />
            </div>
          <div class="col_half col_last">
       <label for="inputState"> ARE YOU A P.E.P ? </label>
       <select id="PEP" name="PEP" class="form-control">
           <option value="">CHOOSE ONE</option>
           <option value="YES">YES</option>
           <option value="NO">NO</option>
       </select>
   </div>
         <div class="col_half">
                <label for="template-contactform-email"> SOURCE OF FUNDS <small>*</small></label>
                <input type="text" id="Source_Of_Funds" name="Source_Of_Funds" class="required code sm-form-control" />
            </div>
         <div class="col_half col_last">
       <label for="inputState"> DO YOU HAVE OTHER SOURCES OF INCOME?</label>
       <select id="Other_Income_Sources" name="Other_Income_Sources" class="form-control">
           <option value="">CHOOSE ONE</option>
           <option value="YES">YES</option>
           <option value="NO">NO</option>
       </select>
   </div>
   <div id="Income_Sources_Details"> </div>
          <div class="col_full">
                <label for="template-contactform-email"> AVERAGE MONTHLY INCOME <small>*</small></label>
                <input type="text" id="Average_Monthly_Income" name="Average_Monthly_Income" class="required code sm-form-control" />
            </div>
            </div>
<div class="line"></div>
<a href="#" class="button button-3d nomargin tab-linker" rel="2">PREVIOUS</a>
<a href="#" class="button button-3d nomargin fright tab-linker" rel="4">NEXT</a>
</div>
<div id="ptab4">
<div class="fancy-title topmargin title-dotted-border">
                 <h3> OTHER INFORMATION </h3>

             </div> 
    <div id="contact-form-overlay" class="clearfix bottommargin">
            
            <div class="col_full">

                <label for="template-contactform-name">Spouse Name <small>*</small></label>
                <input type="text" id="Spouse_Name" name="Spouse_Name" class="sm-form-control required" />

            </div>
            <div class="col_half col_last">
                <label for="template-contactform-name">Date Of Birth <small>*</small></label>
                <input type="date" id="Spouse_Date_Of_Birth" name="Spouse_Date_Of_Birth" class="required sm-form-control" />
            </div>
            <div class="col_half">
                <label for="template-contactform-name">Place of Birth  <small>*</small></label>
                <input type="text" id="Spouse_Birth_Place" name="Spouse_Birth_Place" class="required  sm-form-control" />
            </div>
            <div class="col_half">
                <label for="template-contactform-name">Division <small>*</small></label>
                <input type="text" id="Spouse_Division" name="Spouse_Division" class="required  sm-form-control" />
            </div>
            <div class="col_half col_last">
                <label for="template-contactform-name"> Region <small>*</small></label>
                <input type="text" id="Spouse_Region" name="Spouse_Region" class="required insurance sm-form-control" />
            </div>
            <div class="col_full">
                <label for="template-contactform-name"> Number Of Children <small>*</small></label>
                <input type="number" id="Children_Number" name="Children_Number" class="required insurance sm-form-control" />
            </div>
        <div id="Children_Details"></div>
         
                <div class="col_full">
       <label for="inputState"> ARE YOU A MEMBER OF AN ASSOCIATION ? </label>
       <select id="Association_Member" name="Association_Member" class="form-control">
           <option value="">CHOOSE ONE</option>
           <option value="YES">YES</option>
           <option value="NO">NO</option>
       </select>
   </div>
        <div id="association_details"></div>
      
        <div class="clear"></div>

          
<div class="col_full">
<a href="#" class="button button-3d nomargin tab-linker" rel="3">PREVIOUS</a>
<a href="#" class="button button-3d nomargin fright tab-linker"  type="button" name="submit" onclick="  open_account_function(); " id="template-contactform-submit" > SUBMIT REQUEST <span id="loader"></span></a>    
</div>
          <p class="beautify">
              Thanks for trusting CCC PLC Online. Please Visit the  Branch you selected to complete the procedure come along side with the following documents<br/>
              <b>
                -> Photocopie of Identification Papers <br/>
                -> Location Plan<br/>
                -> 2 Passport size photo &amp; 1 Full<br/>
              </b>
                
            </p>
        </div>
              
    
</div>
    </form>
</div>
</div>    
</div>
</div>
</div>
<div class="w-100 line d-block d-md-none"></div>
<?php
require_once 'profile_menu.php';

?>
</div>
</div>
</div>
</section>


<?php
require_once 'footer.php';

?>
<script src="js/components/bs-filestyle.js"></script>
<script src="function.js"></script>
<script src="resources/utilities.js"></script>

<script>
  document.getElementById("logoffner").addEventListener("click", logger_off);
   
    function logger_off(){
    
 $.ajax({
 
url: 'resources/logoff_cus.php',
type: "GET",
dataType: "html",
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
  }).done( function(text)
  {
//   text = text.replace(/[^a-zA-Z0-9 ]/g, '');
//     var text= JSON.parse(data);
    if(text==0){
           console.log('Validated_logout..........');
               window.location='login';            

          }
            else{
                 console.log(text);            
  swal({
                            title: "LOGOUT Error ",
                            text:  text,
                             type: 'error',
                            showConfirmButton: true
                        });    
                              

  
     
            }
     
         jQuery("#loader").html('');
      });  
    
    
    
    
    }
     

    
    </script>






<script>
		$(function() {
			$( "#processTabs" ).tabs({ show: { effect: "fade", duration: 400 } });
			$( ".tab-linker" ).click(function() {
				$( "#processTabs" ).tabs("option", "active", $(this).attr('rel') - 1);
				return false;
			});
		});
	</script>
