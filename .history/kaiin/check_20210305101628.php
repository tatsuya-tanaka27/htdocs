<?php 

$check_name = '/^[a-z]{1,}$/';
$check_pass = '/^[a-z]{6,}$/';
$check_tel = '/^[a-z]{10,11}$/';


function chackParam($name, $pass, $tel){

    if(preg_match($check_name,$name) && preg_match($check_pass,$pass) ){
	    return true;
    } else{
	    return false;
    }

    if(preg_match($check_pass,$pass)){
	    return true;
    } else{
	    return false;
    }

    if(preg_match($check_tel,$tel)){
	    return true;
    } else{
	    return false;
    }

}



?>