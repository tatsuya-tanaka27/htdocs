<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>サンプルプログラム</title>
</head>
<body>

<?php

class Employee{
	private static $company="技評技術社";
	public static function getCompany(){
		return self::$company;
	}
	public static function setCompany($value){
		self::$company=$value;
	}
}
echo Employee::getCompany(),"<br>",PHP_EOL;
Employee::setCompany("技術評論社");
echo Employee::getCompany(),"<br>",PHP_EOL;
?>

</body>
</html>
