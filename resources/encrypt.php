
<?php
class security{
public function summer($num){
   $num *= 3;
   $num += 200;
    return $num+111;
}  
public function reversesummer($num){
      
   $num -= 200;
   $num -= 111;
    return $num/3;
}
    
public function izrand($length = 4) {

                $random_string="";
                while(strlen($random_string)<$length && $length > 0) {
                        $randnum = random_int(0,61);
                        $random_string .= ($randnum < 10) ?
                                chr($randnum+48) : ($randnum < 36 ? 
                                        chr($randnum+55) : $randnum+61);
                 }
    if(strlen($random_string)>4){
         $random_string =substr($random_string, 0, 4);
        
    }
                return $random_string;
}

public function reversealphabetictester($word){
    $letters=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    $num='';
  
    if (count((array)$word) > -1) {
         $num=$letters[$word];  
      }
        
    
     return $num;
}
    
public function alphabetictester($word){
    $letters=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    $num='';
  
    if (count((array)$word) > 0) {
      foreach ($letters as $worder) {
       if(strcmp($word,$worder)==0){  
         $num=array_search($word,$letters);  
       }
      }
        
      
    }
     return $num;
}
    
   
public  function encryptor($word){
    $output='';
    $counter = strlen($word);

    if ($counter > 0) {
      
      for ($i=0; $i<$counter; $i++) {
          
          $enc='';
       
           
          if(preg_match('/[a-zA-Z]/',$word[$i])==1){
             
            $enc=$this->summer($this->alphabetictester($word[$i]));
             
          }
            else{
               
                 $enc=".".$word[$i].";";
            }
            $output .=$this->izrand().$enc;
      
        }
      
    }
   return $output;
}
    
public function decryptor($codex){
  $counter = strlen($codex);
    $total=$counter;
    $counter=$counter/7;
    $dec=array();
    $pass='';
    if ($counter > 0) {
      
      for ($i=0; $i<$counter; $i++) {
          
    $codex=substr($codex, 4, $total);
     $dec[]=substr($codex,0,3);
     if(substr($dec[$i],0,1)=='.' && substr($dec[$i],2,3)==';'){
         $pass.=substr($dec[$i],1,1);
        
     }
          else{
            $pass.= $this->reversealphabetictester($this->reversesummer($dec[$i]));
             
          }
 
       
     $codex =substr($codex,3,$total);
         
          
}
    }
  return $pass;  
}

}
    //testing encryption

    


?>

