<?php
try {
	$pdo = new PDO('mysql:host=localhost;dbname=kaiin4;charset=utf8','root','',
	array(PDO::ATTR_EMULATE_PREPARES => false));
}
catch (PDOException $e) {
	die('データベース接続失敗。'.$e->getMessage());
}

$errors=array();

if($_SERVER["REQUEST_METHOD"]==="POST"):
	$name=null;
	$namematch="/^[a-zA-Z0-9]{1,20}$/";
	if(!preg_match($namematch,$_POST["name"])):
		$errors["name"]="ユーザーネームの形式が誤っています";
	else:
		$stmt=$pdo->prepare("SELECT `pass` FROM `kaiin4` WHERE `name`=:name");
		$stmt->bindParam(':name',$_POST["name"]);
		$stmt->execute();
		$result=$stmt->fetch();
		if($result):
			$errors["name"]="このユーザーネームは登録済です";
		else:
			$name=$_POST["name"];
		endif;
		$stmt=null;
	endif;

	$pass=null;
	$passmatch="/^[a-zA-Z0-9]{6,12}$/";
	if(!preg_match($passmatch,$_POST["pass"])):
		$errors["pass"]="パスワードの形式が違います";
	else:
		$pass=password_hash($_POST['pass'], PASSWORD_DEFAULT);
	endif;
	
	if(count($errors)===0):
		$stmt = $pdo -> prepare("INSERT INTO `kaiin4` (`name`,`pass`) VALUES (:name,:pass)");
		$stmt->bindParam(':name',$name);
		$stmt->bindParam(':pass',$pass);
		$stmt->execute();
		$stmt=null;
	endif;
else:
	die("直接アクセス禁止");
endif;
$pdo=null;
?>
<DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>登録</title>
</head>
<body>
<?php if (count($errors)): ?>
		<ul class="error_list">
<?php foreach($errors as $error): ?>
			<li>
				<?php echo htmlspecialchars($error,ENT_QUOTES,"UTF-8") ?>
			</li>
<?php endforeach; ?>
			<li><a href="kaiinntouroku.html">登録画面に戻る</a></li>
		</ul>
<?php else: ?>
		<p>登録完了しました</p>
<?php endif; ?>
</body>
</html>
