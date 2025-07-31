<!DOCTYPE html>
<?php

require_once('resources/loginity.php');
 auth_cuscheck();
_token();
$_SESSION['header']=1;

require_once('footer_backend.php');
?>


<section id="content" >
<div class="content-wrap">
<div class="container clearfix" style="padding:0px; max-width: 1384px; ">
<div class="row clearfix">
<div class="col-md-9">
<img src="images/icons/avatar.jpg" class="alignleft img-circle img-thumbnail notopmargin nobottommargin" alt="Avatar" style="max-width: 84px;">
<div class="heading-block noborder">
<h3> CCC PLC ONLINE </h3>
    <span> WELCOME BACK  <?php echo $_SESSION['ccc_cususername']; ?> </span>
</div>
<div class="clear"></div>
<div class="row clearfix">
<div class="col-md-9">

    
    
    
    
<!--
            <div id='account_opening_situations' class="btn-group pull-right">
             <button id="uni_key" class="btn btn-primary btn-round" data-toggle="modal" ><span class="text">Download PDF</span> <i class="fa fa-download ml-2"></i></button>        
             <button id="uni_key2" class="btn btn-primary btn-round naming_doc" data-toggle="modal" ><span  class="text">Download EXCEL</span> <i class="fa fa-download ml-2"></i></button>
              <button id="acc_ctrl" class="refreshdyn btn btn-primary btn-round" data-toggle="modal" ><span class="text">Refresh</span> <i class="fa fa-refresh ml-2"></i></button> 
                   
              </div> 
-->
           
    <div id="preview_cv">
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011-07-25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012-03-29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008-11-28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012-12-02</td>
                <td>$372,000</td>
            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012-08-06</td>
                <td>$137,500</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
    </div>
                    <img id="scream" style="display:none"  src="test-datatables/small_logo.png" alt="The Scream">
    

</div>
</div>
</div>
<div class="w-100 line d-block d-md-none"></div>
<?php
require_once 'profile_menu.php';

?>
</div>
    
<!--<button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-body">
<div class="modal-content">
<div class="modal-header">
   
<h4 class="modal-title title_edit" id="myModalLabel">VIEW APPLICATION</h4>&nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp;   
    &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp;
      &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp; 
      &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp; 
      &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp; 
      &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;   &nbsp; 
     <div id='cv_situations' class="btn-group">
         <button id="uni_key_cv" class="button button-rounded button-small button-purple btn-block nomargin naming_doc" ><span class="text">Download APPLICATION</span> </button>
    </div> 
    
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div id="body_info" class="modal-body">
    
</div>
</div>
</div>
</div>
</div>    
    <div id="exp_hidden" style="" hidden> </div>
     <div id="carry" style="display:none;"></div>
     <div id="identify_cus" style="display:none;"></div>
    
</div>
</div>
</section>


<?php
require_once 'footer.php';

?>
<!--<script src="loanapply.js"></script>-->

<script src="pdf/html2canvas.js"></script>
<script src="pdf/html2pdf.bundle.min.js"></script>
<script src="pdf/html2pdf.bundle.min.js.map"></script>
<script src="pdf/SourceSansPro.js"></script>
<script src="test-datatables/export_lib2.js"></script>


<script src="js/components/bs-filestyle.js"></script>
<script src="resources/utilities_back.js"></script>
<script src="resources/utilities_modal.js"></script>
<!--<script src="resources/modal.js"></script>-->
<!--<script src="function.js"></script>-->

<!--<script src="test-datatables/downloadresources/jsPDF-master/dist/jspdf.umd.js"></script>-->
<!--<script src="test-datatables/downloadresources/jspdf2/dist/jspdf.plugin.autotable.js"></script>-->

<script src="test-datatables/downloadresources/jspdf2/examples/examples.js"></script>
<script src="test-datatables/downloadresources/jspdf2/examples/libs/faker.min.js"></script>
<!--<script src="test-datatables/downloadresources/autotable.jspdf.js"></script>-->
<!--<script src="test-datatables/downloadresources/jspdf.js"></script>-->
<!--<script src="test-datatables/downloadresources/tableExportNormal.js"></script>-->


<!--<script src="js/functions.js"></script>-->
<script>
//    var today = new Date();
//var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
     
    report_header.SUBTITLE="***ACCOUNT OPENING FILE FOR"; report_header.TITLE='CCC PLC ONLINE';
////      report_CONF.FOOTER.START=15;
//      report_CONF.HEADER.START=0;
//      report_CONF.HEADER.STOP=14;
////      report_CONF.FOOTER.STOP=20;
         
//       report_CONF.HEADER.EXTRA_TITLE_WIDTH=290;
//       report_CONF.HEADER.SUB_TITLE_WIDTH=340;
//       report_CONF.HEADER.TITLE_WIDTH=350;
//    report_header.EXTRA_TITLE="***DATE FROM : TO: ***";
//      report_CONF.HEADER.PAGE_ORIENTATION='P';
//      signature_footer.SIGNATORY_ONE='BENEFICIARY';
//      signature_footer.SIGNATORY_TWO='MANAGER';
//      signature_footer.SIGNATORY_THREE='CHAIRMAN LOAN COMM';
//      signature_footer.SIGNATORY_FOUR='CHAIRMAN BOARD';
//   
    
//    $(document).ready(function () {
//    // Setup - add a text input to each footer cell
//    $('#example tfoot th').each(function () {
//        var title = $(this).text();
//        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
//         console.log("Initialize Found");
//    });
// 
    // DataTable
//    var table = $('#dexample').DataTable({
//        initComplete: function () {
//            // Apply the search
//            this.api()
//                .columns()
//                .every(function () {
//                    var that = this;
// 
//                    $('input', this.footer()).on('keyup change clear', function () {
//                        if (that.search() !== this.value) {
//                            that.search(this.value).draw();
//                        }
//                    });
//                });
//        },
//    });
//});

    
// line break -------------------------------------------    
    
    
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