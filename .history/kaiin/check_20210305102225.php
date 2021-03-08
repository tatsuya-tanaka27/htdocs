<?php 




function chackParam($name, $pass, $tel=null){

    var_dump($check_name);

    if(preg_match($check_name,$name) && preg_match($check_pass,$pass)){
	    return true;
    } else{
	    return false;
    }

}



?>