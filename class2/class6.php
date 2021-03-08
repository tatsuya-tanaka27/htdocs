<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>サンプルプログラム</title>
</head>
<body>

<?php

class RefClass{
	public $name;
	public function __construct($inst){
		echo $inst."が生成されました<br>";
	}
//コンストラクトはインスタンス生成時に実行される関数
	public function __destruct(){
		echo "破棄されました<br>";
	}
//デストラクトはインスタンス破棄時に実行される関数
}
echo 'プログラム開始<br>';
echo '$a=new RefClass()<br>';
$a=new RefClass("a");
echo '$b=new RefClass()<br>';
$b=new RefClass("b");
echo 'unset $a<br>';
unset($a);
echo 'プログラム終了<br>';
?>
<p>テスト</p>
<?php
	echo "再開<br>";
?>
</body>
</html>
//EOFでインスタンスは自動破棄されデストラクト実行
