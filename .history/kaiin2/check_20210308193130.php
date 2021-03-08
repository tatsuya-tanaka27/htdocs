<?php 

$mailmatch="/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+.[a-zA-Z0-9\._-]+$/";
$passmatch = '/^[a-z]{6,}$/';
$sexmatch = '/^[0-9]$/';
    $telmatch = '/^[0-9]{9,11}$/';
    $passmatch = '/^[0-9]{4,4}$/';

function chackParam($mail, $pass, $tel=null){



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