var lastTimeID=0;
var opener_holder=1;

  
//start_withdraw_postal();




function pull_profile(tab){

  jQuery("#preview_edit").html('<center><img src="loader2.gif"></center>'); 
     var table = "";

//   $("#taboner").trigger("click");
  $.ajax({
    type: "GET",
    url: 'resources/pull_cus_pro_edit',
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
      
          _build='SORRY ERROR GETTING DATA'+jsonData.results[0].ERROR_MSG;
      } else{
      
  
    for (var i = 1; i < jsonLength; i++) {
        
      var result = jsonData.results[i];
//        var token =  $(".token_id").attr("id").slice(10); 
//        Object.keys(result).length
       for(var index in result) {
         $("#_"+index).val(result[index]);
           
           if (index=='account_id' || index=='loan_id' ){
                 $("#nomkey").val(result[index]);
           }
//           console.log('counter acceleration'+i)
//          console.log('key showing now....'+index);
//           console.log('Length columns....'+Object.keys(result).length);
    
            
          
       }       
      }
          

          
      }
        });
}