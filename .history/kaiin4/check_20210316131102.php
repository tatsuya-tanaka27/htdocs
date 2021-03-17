<?php 

function chackParam($name, $pass, $tel=null){

    $check_name = '/^[a-z]{1,}$/';
    $check_pass = '/^[a-z]{6,}$/';

    if(preg_match($check_name,$name) && preg_match($check_pass,$pass)){
	    return true;
    } else{
	    return false;
    }

}



?>