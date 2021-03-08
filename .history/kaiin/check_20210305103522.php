<?php 

function chackParam($name, $pass, $tel=null){

    $check_name = '/^[a-z]{1,}$/';
    $check_pass = '/^[a-z]{6,}$/';
    $check_tel = '/^[a-z]{8,}$/';

    if($tel != null && !preg_match($check_tel,$tel)){

        return false;
    }

    if(preg_match($check_name,$name) && preg_match($check_pass,$pass)){
	    return true;
    } else{
	    return false;
    }

}



?>