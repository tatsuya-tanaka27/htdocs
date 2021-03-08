<?php 

$check_name = '/^[a-z]{1,}$/';
$check_pass = '/^[a-z]{6,}$/';
$check_tel = '/^[a-z]{10,11}$/';


function chackParam($name, $pass, $tel){

    if(preg_match($check_name,$word)){
	echo "<p>文字はマッチした</p>";
}
else{
	echo "<p>文字はマッチしなかった</p>";
}

}



?>