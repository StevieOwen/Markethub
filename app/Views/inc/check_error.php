<?php 
$check_error= function ($errors,$key){
     if(array_key_exists('cust_firstname', $errors)){ 
        echo $errors[$key];
     
     }else{$errors[$key]="";
     
     }
}

?>