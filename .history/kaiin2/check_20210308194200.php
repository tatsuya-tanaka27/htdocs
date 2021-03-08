<?php 

$mailmatch="/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+.[a-zA-Z0-9\._-]+$/";
$passmatch = '/^[a-z]{6,}$/';
$sexmatch = '/^[0-1]$/';
$telmatch = '/^[0-9]{9,11}$/';
$passmatch = '/^[0-9]{4,4}$/';

function chackLoginParam($mail, $pass){

    if(preg_match($mailmatch,$mail) && preg_match($passmatch,$pass)){
	    return true;
    } else{
	    return false;
    }
}

function chackRegistrationParam($mail, $pass, $sex, $tel, $birth){

    if(preg_match($mailmatch,$mail) && preg_match($passmatch,$pass)
        && preg_match($sexmatch,$sex) && preg_match($telmatch,$tel)
        && preg_match($passmatch,$birth)){

        if($birth >= 1900 && $birth >= (date('Y') - 120)){
            return true;
        } else {
            return false;
        }
	    
    } else{
	    return false;
    }
}

function chackRegistrationParam($mail, $pass, $sex, $tel, $birth){

    if(preg_match($mailmatch,$mail) && preg_match($passmatch,$pass)
        && preg_match($sexmatch,$sex) && preg_match($telmatch,$tel)
        && preg_match($passmatch,$birth)){

        if($birth >= 1900 && $birth >= (date('Y') - 120)){
            return true;
        } else {
            return false;
        }
	    
    } else{
	    return false;
    }
}



?>