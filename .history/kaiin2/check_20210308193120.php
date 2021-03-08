<?php 

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