<?php 

function chackParam($mail, $pass, $tel=null){

    String $check_mail = '/^[a-z]{1,}$/';
    $check_pass = '/^[a-z]{6,}$/';
    $check_tel = '/^[0-9]{9,11}$/';

    if($tel != null && !preg_match($check_tel,$tel)){
        return false;
    }

    if(preg_match($check_mail,$mail) && preg_match($check_pass,$pass)){
	    return true;
    } else{
	    return false;
    }

}



?>