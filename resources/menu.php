<?php


// this script is under development the intension of this script is to  display the menus under which  the different reports are grouped 
//this script is build to be put in a form
require_once('utilities.php');

class menu_builder
{
    
public static function get_menu(){
    
$query= new QueryControllers;


    
$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;
$query= new QueryControllers;
  $arr = array();
  $arr_g = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
    
  if($cat_res=$query->SelectData(['cat_id','cat_name'],'cat order by cat_name asc','')){  
    
     foreach($cat_res as $cat_holder) {
        
   
 if($result=$query->SelectData('privil_id','users','user_id='.$_SESSION['ccc_id'])){  
     $privil =$result[0]['privil_id'];
     $usr=$_SESSION['ccc_id'];
   if($cat_holder['cat_id']!=4){
    
if($result=$query->SelectData(['a.prog_id','b.Program_Name','b.Program_ID','b.Report_Name'],'prog_cat a LEFT JOIN prog b ON (a.prog_id=b.Program_ID)','a.cat_id='.$cat_holder['cat_id'])){
    
     foreach($result as $res) {
         
        $line->prog_id = $res['Program_ID'];
        $line->report_name = $res['Report_Name'];
        $line->program_name = $res['Program_Name'];
        $line->top_menu = $cat_holder['cat_name'];

//        $line->prog = $res['prog_id'];

        $runQ=$query->SelectData(['prog_dept_id','privil_id','prog_id'],'prog_dept','prog_id='.$res['Program_ID'].' and privil_id='.$privil.'');
         //testing condition A
          if($query->getrow_num() >= 1){          
              
              
            $runQ=$query->SelectData(['prog_user_id','user_id','status','prog_id'],'prog_user','prog_id='.$res['Program_ID'].' and user_id='.$usr.''); 
            
              //testing condition B AND condition C  
              if($query->getrow_num() >= 1){
//                   foreach($runQ as $runner) {
                   $status =$runQ[0]['status'];
//                   }
                  //testing condition for extra case
                 if($status ==0){
                     $line->status = 0;  
                 }
                  else{
                    $line->status = 1;    
                  }
             
                  }
              else{
                  
                $line->status = 1;    
              }
     
          }
         else{
   $runQ=$query->SelectData(['prog_user_id','status','prog_id','user_id'],'prog_user','prog_id='.$res['Program_ID'].' and user_id='.$usr.' and status=1 ');  
              //testing condition B AND condition C
              if($query->getrow_num() >= 1){
             $line->status = 1;  
              
              }
              else{               
                  
                 $line->status = 0; 
              }
          }
    
        
         
         
         
   
      $arr[] = json_decode(json_encode($line), True);
     
                }
    
//        array_push($arr_g,$arr);
    
        
}
else{
//    echo 'errorfailedprogextract1001';
}
 
 }
     else{
         
         
      //.................................................................   
         
       if($result=$query->SelectData('privil_id','users','user_id='.$_SESSION['ccc_id'])){  
     $privil =$result[0]['privil_id'];
     $usr=$_SESSION['ccc_id'];
// $result=$query->SelectData(['a.prog_id','b.Program_Name','b.Program_ID','b.Report_Name'],'prog_cat a LEFT JOIN prog b ON (a.prog_id=b.Program_ID)','a.cat_id='.$cat_holder['cat_id']) 
    
if($result=$query->SelectData(['Program_ID','Report_Name','Program_Name'],'prog ORDER BY Program_Name ASC;','')){
    
     foreach($result as $res) {
         
       
      

//        $line->prog = $res['prog_id'];

        $runQ=$query->SelectData(['prog_dept_id','privil_id','prog_id'],'prog_dept','prog_id='.$res['Program_ID'].' and privil_id='.$privil.'');
         //testing condition A
          if($query->getrow_num() >= 1){          
              
              
            $runQ=$query->SelectData(['prog_user_id','user_id','status','prog_id'],'prog_user','prog_id='.$res['Program_ID'].' and user_id='.$usr.''); 
            
              //testing condition B AND condition C  
              if($query->getrow_num() >= 1){
//                   foreach($runQ as $runner) {
                   $status =$runQ[0]['status'];
//                   }
                  //testing condition for extra case
                 if($status ==0){
                     
                     
                 }
                  else{
                    
                      
                  $result=$query->SelectData('prog_cat_id','prog_cat','prog_id='.$res['Program_ID'].'');     
                      
                      
                     if($query->getrow_num() >= 1){
                         
                         
                    
                  
                         
                         
                     }else{
                      
                  $line->prog_id = $res['Program_ID'];
                    $line->report_name = $res['Report_Name'];
                    $line->program_name = $res['Program_Name'];         
                    $line->status = 1;
                    $line->top_menu = $cat_holder['cat_name'];
                    $line->top_menu_id = $cat_holder['cat_id'];
                   $arr[] = json_decode(json_encode($line), True);
                         
                     }
                  }
             
                  }
              else{
                 $result=$query->SelectData('prog_cat_id','prog_cat','prog_id='.$res['Program_ID'].'');     
                      
                      
                     if($query->getrow_num() >= 1){
                         
                         
                    
                  
                         
                         
                     }else{
                      
                  $line->prog_id = $res['Program_ID'];
                    $line->report_name = $res['Report_Name'];
                    $line->program_name = $res['Program_Name'];         
                    $line->status = 1;
                    $line->top_menu = $cat_holder['cat_name'];
                    $line->top_menu_id = $cat_holder['cat_id'];
                   $arr[] = json_decode(json_encode($line), True);
                         
                     }
              
              
              }
     
          }
         else{
   $runQ=$query->SelectData(['prog_user_id','status','prog_id','user_id'],'prog_user','prog_id='.$res['Program_ID'].' and user_id='.$usr.' and status=1 ');  
              //testing condition B AND condition C
              if($query->getrow_num() >= 1){
                  
                 $result=$query->SelectData('prog_cat_id','prog_cat','prog_id='.$res['Program_ID'].'');     
                      
                      
                     if($query->getrow_num() >= 1){
                         
                         
                    
                  
                         
                         
                     }else{
                      
                  $line->prog_id = $res['Program_ID'];
                    $line->report_name = $res['Report_Name'];
                    $line->program_name = $res['Program_Name'];         
                    $line->status = 1;
                    $line->top_menu = $cat_holder['cat_name'];
                    $line->top_menu_id = $cat_holder['cat_id'];
                   $arr[] = json_decode(json_encode($line), True);
                         
                     }
              
              }
              else{               
                  
              
              }
          }
    
        
         
         
         
   
      
     
                }
    
//        array_push($arr_g,$arr);
// if(!empty($arr)){
//    $jsonData .='[';
//     $jsonData .= implode(",", $arr);
//    $jsonData .=']';
//    $arr='';
// }
        
}
else{
   
}
    
    
}  
         
            
         
         
         
      //.................................................................   
     
          
         
     }
  if(!empty($arr)){
   $jsonData .='[';
    $arr_g[] = $arr;
    $jsonData .=']';
    $arr='';
  }
           
     
     
}
else{
//    return 'errorfaileduserextract1001';
}
      
  }
//      print_r($arr_g);
    
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return json_encode($arr_g); 
          
      
      
      
      
      
}
else{
    return 'errorfailedcategoryextract1001';
}
}  
}
































//
//class menu_builder
//{
//    
//public static function get_menu(){
//    
//$query= new QueryControllers;
//
//
//    
//$date=date('d/m/Y h:i:s a', time());
//$query= new QueryControllers;
//  $arr = array();
// $jsonData = '{"results":[';
// $line = new stdClass;
//    
//    
//    
// if($result=$query->SelectData('privil_id','users','user_id='.$_SESSION['ccc_id'])){  
//     $privil =$result[0]['privil_id'];
//     $usr=$_SESSION['ccc_id'];
//  
//    
////if($result=$query->SelectData(['Program_ID','Report_Name','Program_Name'],'prog ORDER BY Program_Name ASC;','')){
//    
//     foreach($result as $res) {
//         
//        $line->prog_id = $res['Program_ID'];
//        $line->report_name = $res['Report_Name'];
//        $line->program_name = $res['Program_Name'];
////        $line->prog = $res['prog_id'];
//
//        $runQ=$query->SelectData(['prog_dept_id','privil_id','prog_id'],'prog_dept','prog_id='.$res['Program_ID'].' and privil_id='.$privil.'');
//         //testing condition A
//          if($query->getrow_num() >= 1){          
//              
//              
//            $runQ=$query->SelectData(['prog_user_id','user_id','status','prog_id'],'prog_user','prog_id='.$res['Program_ID'].' and user_id='.$usr.''); 
//            
//              //testing condition B AND condition C  
//              if($query->getrow_num() >= 1){
////                   foreach($runQ as $runner) {
//                   $status =$runQ[0]['status'];
////                   }
//                  //testing condition for extra case
//                 if($status ==0){
//                     $line->status = 0;  
//                 }
//                  else{
//                    $line->status = 1;    
//                  }
//             
//                  }
//              else{
//                  
//                $line->status = 1;    
//              }
//     
//          }
//         else{
//   $runQ=$query->SelectData(['prog_user_id','status','prog_id','user_id'],'prog_user','prog_id='.$res['Program_ID'].' and user_id='.$usr.' and status=1 ');  
//              //testing condition B AND condition C
//              if($query->getrow_num() >= 1){
//             $line->status = 1;  
//              
//              }
//              else{               
//                  
//                 $line->status = 0; 
//              }
//          }
//    
//        
//         $arr[] = json_decode(json_encode($line), True);
//   
//     
//     
//                }
//    $jsonData .= implode(",", $arr);
//      $jsonData .= ']}';
//   
//    
//    
//  // print_r($result);
//    
//    // $data['results']= $result;
//    //$data=json_encode($data);
//    return $jsonData;
//}
//else{
//    return 'errorfailedprogextract1001';
//}
//    
//    
//}
//else{
//    return 'errorfaileduserextract1001';
//}
//}  
//}
?>