<html>
    <head>
        <style>
      body { 
 
  background-color:lightgray;
          
  
}
            .form{
                border:3px solid;
                border-radius: 3px;
                background-color:bisque;
            }
            .submit{
                background-color:goldenrod;
                text-align: center;
                color:white;
                width:70px;
                height:50px;
                border-radius: 10px;
                border:2px goldenrod solid;
                
            }
            .submit:hover{
                background-color:darkgoldenrod;
            }
            .form-control{
                width:800px;
                height: 50px;
                background-color:black;
                margin-left:26%;
                margin-right:5%;
                margin-top:5%;
                margin-bottom:5%;
                color:aqua;
                font-size:30px;
            }
            h2{
                color:darkgoldenrod;
                
            }
            h4{
                color:firebrick;
            }
        </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    </head>
    <body>
        <div class="form">
            <center><h2>BLAST DECRYPTOR</h2></center>
<form method="post" action="decrypt.php">
<input class="form-control" placeholder="PLEASE ENTER CODEX FOR DECRYPTION" type="text" name="password"/>
    <input class="submit" type="submit" name="submit" value="Decode"/>
    <a href="encrypt.php"><button type="button" name="button" value=""></button><h3>Encrypt</h3></a>

</form>
</div>
    </body>
</html>


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

    /**
     * @throws \Random\RandomException
     */
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
  
    if (count($word) > -1) {
         $num=$letters[$word];  
      }
        
    
     return $num;
}
    
public function alphabetictester($word){
    $letters=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    $num='';
  
    if (count($word) > 0) {
      foreach ($letters as $worder) {
       if(strcmp($word,$worder)==0){  
         $num=array_search($word,$letters);  
       }
      }
        
      
    }
     return $num;
}
public function encryptor($word){
    $output='';
    $counter = strlen($word);

    if ($counter > 0) {
      
      for ($i=0; $i<$counter; $i++) {
          
          $enc='';
       
           
          if(preg_match('/[a-zA-Z]/',$word[$i])==1){
              echo $counter;
            $enc=$this->summer($this->alphabetictester($word[$i]));
              echo $enc.'*****************************************************************************************************<br/>';
          }
            else{
                echo $counter;
                 $enc=".".$word[$i].";";
                echo $enc.'************************************************************************************************************<br/>';
            }
               
           
           
            $output .=$this->izrand().$enc;
         echo $output.'****************************************************************************************************************<br/>';
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
          echo '************************************************************************************************<br/>'.$codex.'<br/>';
     $dec[]=substr($codex,0,3);
     if(substr($dec[$i],0,1)=='.' && substr($dec[$i],2,3)==';'){
         $pass.=substr($dec[$i],1,1);
        
     }
          else{
            $pass.= $this->reversealphabetictester($this->reversesummer($dec[$i]));
             
          }
 
          print_r ($dec);
     $codex =substr($codex,3,$total);
          echo $codex.'<br/>***********************************************************************************************<br/>';
          
}
    }
  return $pass;  
}

}
    //testing encryption
if(isset($_POST['password'])){
$pass =$_POST['password'];
    
$secured= new security;
    echo'<h3>Decryption Begins</h3>'; 
$dec=$secured->decryptor($pass);
    echo'<h3>Decryption Ends</h3>'; 

echo "<h4>Decrypted Word:&nbsp; ".$dec."</h4>";
}
?>

