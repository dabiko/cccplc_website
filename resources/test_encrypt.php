<?php

require_once 'encrypt.php';

function password_auth($password){
    $new_security= new security;
       
            $decpass = $new_security->decryptor($password);
          echo $decpass; 
}

password_auth('13713985610326HYW032911213321119.1;119P.2;9912.3;1191.4;');


?>