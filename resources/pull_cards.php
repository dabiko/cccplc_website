<?php
require_once 'Database.php';
require_once 'encrypt.php';
require_once 'utilities.php';
class register_now
{
    
public function user_spec($parent){
    
 
$date=date('d/m/Y h:i:s a', time());
$query= new QueryControllers;
  $arr = array();
 $jsonData = '{"results":[';
 $line = new stdClass;
 $results = "";
$result=$query->SelectData(['card_transfer_id','client_id','user_id','client_name','card_branch','acc','upload_date'],'card_transfers','acc='.$parent.' ORDER BY card_branch DESC');
$result_count=$query->getrow_num();
if($result_count!=0){
     
     foreach($result as $res) {
         
        $line->user_id = $res['user_id'];
        $line->client_name = $res['client_name'];
        $line->client_id = $res['client_id'];
        $line->card_branch= $res['card_branch'];  
         $line->acc = $res['acc'];
         $line->card_transfer_id = $res['card_transfer_id'];
         $line->upload_date = $res['upload_date'];
        
         $arr[] = json_encode($line);
        
                }
    $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
   
    
    
  // print_r($result);
    
    // $data['results']= $result;
    //$data=json_encode($data);
    return $jsonData;
    
}
    else{
     
      $line->error= 'error1001';
      $line->code= $result;
      $arr[] = json_encode($line);    
    $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
        
         return $jsonData;
        }
}

}
?>