<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>サンプルプログラム</title>
</head>
<body>

<?php
class robotken{
	public static $name;//static指定するとインスタンスなしにアクセス可能
	public $kenshu;

}

robotken::$name = "シロ";
echo robotken::$name,"<br>";

$a = new robotken;
$a->name = 'タロ';
//static指定ではインスタンス使用はNoticeエラーになる
$a->kenshu="エスキモー犬";
$a::$name="タロ";
echo $a::$name,"<br>";
echo $a->kenshu,"<br>";
$b = new robotken;
echo $b::$name,"<br>";
//インスタンスからの変更でもstaticは
echo $b->kenshu,"<br>";
?>

</body>
</html>
