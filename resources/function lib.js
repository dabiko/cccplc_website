 function table_compressor(data,total_load){
   var total=0;
   var tbody='';
   var theader= '<th>BRANCH</th><th>  BUSINESS ACCOUNT   </th><th> CURRENT/SALARY ACCOUNT </th><th>  SAVINGS ACCOUNT  </th><th> TOTAL  </th>';
   
    for (var i = 0; i < data.length; i++) { 
          
        while (data[i].length!=4){
                data[i].push('NAN:00');
            }
        
        total= parseInt(data[i][1].substring(4))+parseInt(data[i][2].substring(4))+parseInt(data[i][3].substring(4));
        for (var j = 0; j < data[i].length; j++) {     
        if (j==0){
            data[i][j] =branches[parseInt(data[i][j].substring(1, 3))];
           tbody += '<tr><td>'+data[i][j]+'</td>';  
 //            console.log(jsonData[i][j]+'.................'+j);
            }
            
            else if (j==1){
            switch(data[i][j].substring(0,3)){
                    
                case '371':
                    if(data[i][j+1].substring(0,3)!='372' && data[i][j+2].substring(0,3)=='373')
                    {
                         
                      tbody += '<td>'+data[i][j].substring(4)+'</td><td>NO ACCOUNT</td><td>'+data[i][j+2].substring(4)+'</td><td>'+total+'</td></tr>';    
                    }
                    else if(data[i][j+1].substring(0,3)=='372' && data[i][j+2].substring(0,3)!='373')
                        {
                           
                      tbody += '<td>'+data[i][j].substring(4)+'</td><td>'+data[i][j+1].substring(4)+'</td><td>NO ACCOUNT</td><td>'+total+'</td></tr>';   
                        }
                    else if(data[i][j+1].substring(0,3)!='372' && data[i][j+2].substring(0,3)!='373')
                        {
                            if(data[i][j+1].substring(0,3)=='373'){
                        tbody += '<td>'+data[i][j].substring(4)+'</td><td>NO ACCOUNT</td><td>'+data[i][j+1].substring(4)+'</td><td>'+total+'</td></tr>';   
                            }
                            else{
                         tbody += '<td>'+data[i][j].substring(4)+'</td><td> NO ACCOUNT</td><td> NO ACCOUNT</td><td>'+total+'</td></tr>';        
                            }
                        }
                
                    else{
                      tbody += '<td>'+data[i][j].substring(4)+'</td><td>'+data[i][j+1].substring(4)+'</td><td>'+data[i][j+2].substring(4)+'</td><td>'+total+'</td></tr>';     
                    }
                    
                    break;
                case '372':
                    
                     if(data[i][j-1].substring(0,3)!='371' && data[i][j+1].substring(0,3)=='373')
                    {
                      tbody += '<td>NO ACCOUNT</td><td>'+data[i][j].substring(4)+'</td><td>'+data[i][j+1].substring(4)+'</td><td>'+total+'</td></tr>';    
                    }
                    else if(data[i][j-1].substring(0,3)=='371' && data[i][j+1].substring(0,3)!='373')
                        {
                      tbody += '<td>'+data[i][j-1].substring(4)+'</td><td>'+data[i][j].substring(4)+'</td><td>NO ACCOUNT</td><td>'+total+'</td></tr>';   
                        }
                    else if(data[i][j-1].substring(0,3)!='372' && data[i][j+1].substring(0,3)!='373')
                        {
                      tbody += '<td> NO ACCOUNT</td><td>'+data[i][j].substring(4)+'</td><td> NO ACCOUNT</td><td>'+total+'</td></tr>';       
                        }
                    else{
                      tbody += '<td>'+data[i][j-1].substring(4)+'</td><td>'+data[i][j].substring(4)+'</td><td>'+data[i][j+1].substring(4)+'</td><td>'+total+'</td></tr>';     
                    }
                    
                    break;
                case '373':
         tbody += '<td> NO ACCOUNT</td><td> NO ACCOUNT</td><td>'+data[i][j].substring(4)+'</td><td>'+total+'</td></tr>'; 
                    
//                     if(data[i][j-2].substring(0,3)!='371' && data[i][j-1].substring(0,3)=='372')
//                    {
//                      tbody += '<td>NO ACCOUNT</td><td>'+data[i][j-1].substring(4)+'</td><td>'+data[i][j].substring(4)+'</td></tr>';    
//                    }
//                    else if(data[i][j-2].substring(0,3)=='371' && data[i][j-1].substring(0,3)!='372')
//                        {
//                      tbody += '<td>'+data[i][j-2].substring(4)+'</td><td>NO AMOUNT</td><td>'+data[i][j].substring(4)+'</td></tr>';   
//                        }
//                    else if(data[i][j-1].substring(0,3)!='372' && data[i][j-2].substring(0,3)!='371')
//                        {
//                      tbody += '<td> NO ACCOUNT</td><td> NO ACCOUNT</td><td>'+data[i][j].substring(4)+'</td></tr>';       
//                        }
//                    else{
//                      tbody += '<td>'+data[i][j-2].substring(4)+'</td><td>'+data[i][j-1].substring(4)+'</td><td>'+data[i][j].substring(4)+'</td></tr>';     
//                    }
//                    
                    break;
            }
            }
        }
    }
      tbody+='<tr><td>TOTAL</td><td></td><td><td/><td>'+total_load+'</td>';
       var tstructure= '<table class="table" id="dataTables-example"><thead><tr>'+theader+'</tr></thead><tbody >'+tbody+'</tbody></table>'; 
    $('.table_holder').html(tstructure);
      console.log(tstructure);
  }  
    
    
    
    
function table_comp(data){
    console.log(data);
   var tbody='';
   var theader= '<th>BRANCH</th><th>  BUSINESS ACCOUNT   </th><th> CURRENT/SALARY ACCOUNT </th><th>  SAVINGS ACCOUNT  </th><th> TOTAL  </th>';
   
    for (var i = 0; i < data.length; i++) { 
        for (var j = 0; j < data[i].length; j++) {
           
         
            
               if(j+1 == data[i].length){
                   if(data[i][j].substring(0,3)=='373'){
                     tbody += '<td>'+data[i][j].substring(4)+'</td></tr>';  
                   }
                   else if(data[i][j].substring(0,3)=='372'){
                        tbody += '<td>'+data[i][j].substring(4)+'</td><td></td></tr>'; 
                   }
                   else{
                        tbody += '<td>'+data[i][j].substring(4)+'</td><td></td><td> </td></tr>'; 
                   }
         
 //           console.log(jsonData[i][j]+'.................'+j);
        }
        else if (j==0){
             data[i][j] =branches[parseInt(data[i][j].substring(1, 3))];
           tbody += '<tr><td>'+data[i][j]+'</td>';  
 //            console.log(jsonData[i][j]+'.................'+j);
            }
          else if (j==1){
            if(data[i][j].substring(0,3)=='371'){
                     tbody += '<td>'+data[i][j].substring(4)+'</td>';  
                   }
                   else if(data[i][j].substring(0,3)=='372'){
                        tbody += '<td></td><td>'+data[i][j].substring(4)+'</td>'; 
                   }
                   else{
                        tbody += '<td></td><td></td><td>'+data[i][j].substring(4)+'</td>'; 
                   }
 //              console.log(jsonData[i][j]+'.................'+j);
          }
            else if (j==2){
              if(data[i][j].substring(0,3)=='372'){
                     tbody += '<td>'+data[i][j].substring(4)+'</td>';  
                   }
                   else{
                        tbody += '<td>'+data[i][j].substring(4)+'</td><td></td>'; 
                   }
                  
            }
            
      
            
        }
    }
    var tstructure= '<table class="table" id="dataTables-example"><thead><tr>'+theader+'</tr></thead><tbody >'+tbody+'</tbody></table>'; 
    $('.table_holder').html(tstructure);
}
    
  var branches=['','Bamenda','Batibo','Warda','Republique','Buea','Kumba','Liberte','Bonaberi','Tiko','Saphir','Acropole','Bafoussam','Head Office','Kribi','Muyuka','Limbe','Biyemassi','NdogPassi','Bambili'];
var acc_type={371:'Savings',372:'Current',373:'Business'};  
    
     function cal_customers(url) {
 var return_box;
        $.ajax({
            type: "GET",
            crossDomain: true,
            dataType: 'jsonp',
            url: url,
            statusCode: {
                200: function(data) {
                 //   console.log("200 - Success");

                var jsonData = data.results;
                //............................important when data is returned with keys
                //   Object.keys(data.results).length;
                //   data.results[Object.keys(data.results)[i]];
                var jsonLength = data.results.length;
                var jsoninnerLen = data.results[0].length;


                var controller = [];
                var compressor=[];
                var stats = 0;
                var statsi = 0;
                var auth = 0;
                var counter=0;
                var data_line = '';
              //  console.log(jsonLength);
   //this loop opens the  data array received from the server and goes through every element             
                for (var i = 0; i < jsonLength; i++) {
                    counter++;
                   // console.log(jsonData);
//                    console.log(controller.length);
//                      if (controller.length != 0){
 // this checks if that element exist in the array if it exist it adds increases the counter variable by one                         
                    for (var j = 0; j < controller.length; j++) {
                       //  console.log(controller);
//                        console.log(jsonData[i][0]+'..............data acc type');
//                        console.log(controller[j][0]+'..............controller acc type');
//                        console.log(controller[j][1]+'..............controller age type');
//                        console.log(jsonData[i][1]+'..............data age type');

                        if ((jsonData[i][0] == controller[j][0]) && (jsonData[i][1] == controller[j][1])) {
                            controller[j][2] += 1;
                           
                            // console.log(controller[j][2]+'..........................controller');
                           //  console.log(controller.length+'..........................controller LENgth');
                            //this varible is used to block the if statment below from adding an array to the array used for counting customers
                            stats = 222;
                          
                             
                        }
                      
                      }
    // else if it does not 
                        if (stats != 222) {
                            //this  adds new branch and account types for each customer
                         jsonData[i].push(1);
                         controller.push(jsonData[i]);
  // this line of code is very useful for debugging this function in cases of error                           
 //                      console.log(controller +'..........................stats'+stats+'value ......................i'+i);
                              stats=0;
                          
                        }
                    else{
                        stats=0;
                    }

                     
//                      }
//                    else{
//                        jsonData[i].push(1);
//                         controller.push(jsonData[i]);
//                       //  console.log(controller[0]); 
//                    }
                }

controller.sort();
// for (var j = 0; j < controller.length; j++) {
   
//      console.log('this is the substring'+age_str);
//      console.log('this is the substring'+ controller[j][1]);
//      console.log('this is the substring'+ branches[age_str]);
              // this code is very important for labelling the different branches and agence
//               controller[j][0] =branches[parseInt(controller[j][0].substring(1, 3))];
//               controller[j][1] =acc_type[controller[j][1]];
//     auth += controller[j][2];
     
// }
                    
                    
                    
                    
                    
                    
                    
                    
      for (var i = 0; i < controller.length; i++) {
                      
                    for (var j = 0; j < compressor.length; j++) {

                        if ((controller[i][0] == compressor[j][0])) {
                          compressor[j].push(controller[i][1]+':'+controller[i][2]);

                            statsi = 222;
                          
                             
                        }
                      
                      }
    // else if it does not 
                        if (statsi != 222) {
                            //this  adds new branch and account types for each customer
                        // jsonData[i].push(1);
                         compressor.push([controller[i][0],controller[i][1]+':'+controller[i][2]]);
                            
//                         function checkind(ind) {
//                             return ind == controller[i][0];
//                                 }
//                            
//                        var value = compressor.findIndex(checkind);
//                            console.log('this is the index: '+value);
//                        compressor[value].push();
  // this line of code is very useful for debugging this function in cases of error                           
 //                      console.log(controller +'..........................stats'+stats+'value ......................i'+i);
                              statsi=0;
                          
                        }
                    else{
                        statsi=0;
                    }

                }              
                    
                    
                    
                    
                    
            
                    
            
  //          console.log(compressor);
 //      console.log(auth+'new auth code from total of customers');         
                    
             table_compressor(compressor,counter);
                  
                   
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
            error: function(jqXHR, status, error) {
                console.log(jqXHR);
                console.log(status);
                console.log(error);
            }
        });
 
 
    }



//...................................................... print library


//................This is used to print the canvas to the pdf document

   // Setar o width da div no formato a4
//        var specialElementHandlers = {
//    '#dataTables-example': function (element, renderer) {
//        return true;
//    }
//};
        
        

  // get size of report page
  var reportPageHeight = $('#data_holder').innerHeight();
  var reportPageWidth = $('#data_holder').innerWidth();

  // create a new canvas object that we will populate with all other canvas objects
  var pdfCanvas = $('<canvas />').attr({
    id: "canvaspdf",
    width: reportPageWidth,
    height: reportPageHeight
  });

  // keep track canvas position
  var pdfctx = $(pdfCanvas)[0].getContext('2d');
  var pdfctxX = 0;
  var pdfctxY = 0;
  var buffer = 100;

  // for each chart.js chart
  $('canvas').each(function(index) {
    // get the chart height/width
    var canvasHeight = $(this).innerHeight();
    var canvasWidth = $(this).innerWidth();

    // draw the chart into the new canvas
    pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
    pdfctxX += canvasWidth + buffer;

    // our report page is in a grid pattern so replicate that in the new canvas
    if (index % 2 === 1) {
      pdfctxX = 0;
      pdfctxY += canvasHeight + buffer;
    }
  });

  // create new pdf and add our new canvas as an image
  var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
  pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);

  // download the pdf
  pdf.save('filename.pdf');

//        doc.fromHTML($('#dataTables-example').html(), 15, 15, {
//        'width': 170,
//        'elementHandlers': specialElementHandlers    
//    });
//        
//        doc.save('NOME-DO-PDF.pdf');




//......................................this code is important for scaling images according to the length of the page before adding them to the page



    $(document).ready(function() {
            var getImageFromUrl = function(url, callback) {
            var img = new Image();
            img.onError = function() {
            alert('Cannot load image: "'+url+'"');
            };
            img.onload = function() {
            callback(img);
            };
            img.src = url;
            }
            var createPDF = function(imgData) {
            var doc = new jsPDF('p', 'pt', 'a4');
            var width = doc.internal.pageSize.width;    
            var height = doc.internal.pageSize.height;
            var options = {
                 pagesplit: true
            };
            doc.text(10, 20, 'Crazy Monkey');
            var h1=50;
            var aspectwidth1= (height-h1)*(9/16);
            doc.addImage(imgData, 'JPEG', 10, h1, aspectwidth1, (height-h1), 'monkey');
            doc.addPage();
            doc.text(10, 20, 'Hello World');
            var h2=30;
            var aspectwidth2= (height-h2)*(9/16);
            doc.addImage(imgData, 'JPEG', 10, h2, aspectwidth2, (height-h2), 'monkey');
            doc.output('datauri');
        }
            getImageFromUrl('thinking-monkey.jpg', createPDF);
            });



/////////// this recent code for editing

//            
//             var reportPageHeight = $('#myChart').innerHeight();
//        var reportPageWidth = $('#myChart').innerWidth();
//        
//            var doc = new jsPDF('p', 'mm','a4');
//            var subtitle = "NEW ACCOUNTS REPORT";
//             var title = "CCC PLC";
//          
//           html2canvas($("#myChart"), {
//                onrendered: function(canvas) { 
//                         const width = 800;
//                const scaleFactor = width /  reportPageWidth;
//                var imgData = canvas.toDataURL('image/png',1.0);  
//       
//                const elem = document.createElement('canvas');
//                elem.width = width;
//                elem.height = reportPageHeight  * scaleFactor;
//                const ctx = elem.getContext('2d');
//             
//               
//                     var destinationImage = new Image;
//                     var logoImage = new Image;
//   
// logoImage.onload = function() {
//    doc.addImage(this, 'png', 0.5, 4.5, 50, 15, 'ccc plc logo');
//      //  doc.addHTML(canvas);
//   teOptions.doc
//       
//    doc.save(title+'gt_lo.pdf');
// };
//    logoImage.crossOrigin = "";  
//    logoImage.src = "logo_dark.png";
//                    
//                    
//    destinationImage.onload = function(){
//        ctx.drawImage(destinationImage, 0, 0, elem.width, elem.height);
//  //      doc.text("CCC PLC REPORT",0.5,9);
//       
//       
//        doc.myText(title,{align: "center"},0,10);
//       doc.myText(subtitle,{align: "center"},0,15);
//                   teOptions.doc.addImage(elem, 'PNG',0,20); 
//         doc.addHTML(canvas);
//                    
//    };
//    destinationImage.src = imgData;
//    
//                    
//                               
//                    } 
//                   });
            

//python code for getting dormant account date difference
//#    def get_date_diff(self,ncp,som) -> str:
//#        try:
//#            with UseDatabase(app.config['dbconfig']) as cursor:
//#                holder=[]
//#                _SQL = "select * from( select distinct dco from bkhis where sen='C' and trim(ncp)= :ncp order by dco desc) where rownum<=2 "
//#                named_params = {"ncp":ncp}
//#                cursor.execute(_SQL, named_params)
//#                for row in cursor.fetchall():
//##                    t = row[0]
//##                    
//#                    holder.append(row[0])
//#                date_diff=holder[0]-holder[1]
//#                store=str(date_diff)
//##               conv = int(store[:2])
//#                if int(store[:2])>= int(som):
//#                    date_out=holder[0].strftime('%m/%d/%Y')
//#                    cond=True
//#                    return cond,date_out
//#                else:
//#                    cond=False
//#                    return cond,0
//#                
//#        except ConnectionError as err:
//#            print('Is your database switched on? Error:', str(err))
//#        except Exception as err:
//#            print('Something went wrong:', str(err))
//#        return 'Error'



//this code is used for looping and asynchronous request to a server
//function cal_period(data){
//   var jsonData = data;
//    var async_request=[];
//    var carrier=[];
//    var jsonLength = data[0].length;
// //   console.log(data[0].length+'.............this is data lenght')
//       for (var i = 0; i < jsonLength; i++) { 
//    var url='http://127.0.0.1:5000/cal_period/'+data[0][i][5]+'&'+data[0][i][0]+'&'+'136';
//   async_request.push($.ajax({
//            type: "GET",
//            crossDomain: true,
//            dataType: 'jsonp',
//            ajaxI:i,
//            url: url,
//            success: function(datas) {
//                i=this.ajaxI;
//                 //   console.log("200 - Success");
//                    if ( !datas.length) { 
//                         jQuery("#preview_msg").html('no results');
//                         jQuery("#preview_display").html('');
//                           swal("Error!", "No Results", "error");
//               
//                     }
//                else {  
//    
//   
//    if (datas.length !=0){
//    var jsonDatas = datas;
//    var jsonLengths = datas.length;
//    if(datas[0]==true){
//               data[0][i].push(datas[1]);
//                carrier.push(data[0][i]);
//                console.log('results for each append for row'+data[0][i]);
//    }
//}
//                    
//                    
//   }
//                   
//                },
//                404: function(request, status, error) {
//                    console.log("404 - Not Found");
//                    console.log(error);
//                    location.href = "404";
//                },
//                503: function(request, status, error) {
//                    console.log("503 - Server Problem");
//                    console.log(error);
//                    location.href = "403";
//                
//            },
//            error: function(jqXHR, status, error) {
//                 var message= "Request: "+jqXHR+"Status: "+status+"Error Msg: "+error;
//               swal("Error!", message, "error");
//                console.log(jqXHR);
//                console.log(status);
//                console.log(error);
//                 jQuery("#preview_display").html('');
//            }
//        }));                  
//                    
//        
//                }
//    
//    
//      $.when.apply(null, async_request).done( function(){
//    // all done
//     
//  //  console.log('all request completed'+carrier)
//   
//});              
//     
//    
//    
//    
//    }
//            