<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>サンプルプログラム</title>
</head>
<body>

<?php
require "name1.php";
require "name2.php";
echo $a,"<br>";

echo eng\aisatsu(),"<br>";//engという名前空間のaisatsu()関数呼び出し
echo jpn\aisatsu(),"<br>";//jpnという名前空間のaisatsu()関数呼び出し

echo eng\A;
echo "<br>";
echo jpn\A;
echo "<br>";

$name1=new eng\name1;
echo $name1->a;
?>

</body>
</html>