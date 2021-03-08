<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>サンプルプログラム</title>
</head>
<body>
<?php
class robotken{
	const SHURUI="inu";
	private $age=1;
	public $name;
	public function getAge(){
		return $this->age;
	}
	public function setAge($age2){
		$this->age=$age2;
	}
}

echo robotken::SHURUI,"<br>";

$a = new robotken;//インスタンス作成 「new クラス名」で作成
$b = new robotken;

echo $a->getAge(),"<br>";
$a->setAge(3);
echo $a->getAge(),"<br>";
echo $b->getAge(),"<br>";

$a->name = 'タロ';
//インスタンスの変数は「$インスタンス名->変数名」
$b->name = 'ジロ';
echo $a->name,"<br>";
echo $b->name,"<br>";

$c = new robotken;
echo $c->name,"<br>";
echo $c->getAge(),"<br>";

echo $a->SHURUI,"<br>";
echo robotken::SHURUI,"<br>";
?>
</body>
</html>
