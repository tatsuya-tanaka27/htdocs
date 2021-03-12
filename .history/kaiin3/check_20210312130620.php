<?php 

$mailmatch='/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+.[a-zA-Z0-9\._-]+$/';
$passmatch = '/^[a-z]{6,}$/';
$namematch='/^[ぁ-んァ-ヶー々一-龠０-９]+$/u';
$sexmatch = '/^[0-1]$/';
$postmatch = '/^[0-9]{7}$/';
$telmatch = '/^[0-9]{9,11}$/';

function chackLoginParam($mail, $pass){

    global $mailmatch;
    global $passmatch;

    if(preg_match($mailmatch,$mail) 
        && preg_match($passmatch,$pass)){
	    return true;
    } else{
	    return false;
    }
}

function chackRegistrationParam($mail, $pass, $name, $sex, $post, $tel){

    global $mailmatch;
    global $passmatch;
    global $namematch;
    global $sexmatch;
    global $postmatch;
    global $telmatch;

    if(preg_match($mailmatch,$mail) 
        && preg_match($passmatch,$pass)
        && preg_match($sexmatch,$sex) 
        && preg_match($namematch,$name) 
        && preg_match($postmatch,$post)
        && preg_match($telmatch,$tel)
    ){
        return true;
	    
    } else{
	    return false;
    }
}

function chackUpdateParam($pass, $sex, $name, $post, $tel){

    global $passmatch;
    global $sexmatch;
    global $postmatch;
    global $telmatch;
    
    if(preg_match($passmatch,$pass) 
        && preg_match($sexmatch,$sex) 
        && preg_match($namematch,$name) 
        && preg_match($telmatch,$tel) 
        && preg_match($postmatch,$post)
    ){
        return true;
    } else {
	    return false;
    }
}



?>