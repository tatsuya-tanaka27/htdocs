<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログイン</title>
</head>
<body>
<?php
	try {
	$pdo = new PDO('mysql:host=localhost;dbname=kaiin4;charset=utf8','root','',
	array(PDO::ATTR_EMULATE_PREPARES => false));
	}
	catch (PDOException $e) {
	 die('データベース接続失敗。'.$e->getMessage());
	}

	if($_SERVER["REQUEST_METHOD"]==="POST"):
		$stmt=$pdo->prepare("SELECT `pass` FROM `kaiin4` WHERE `name`=:name");
		$stmt->bindParam(":name",$_POST["name"]);
		$stmt->execute();
		$result=$stmt->fetch();
		if($result):
			if(password_verify($_POST["pass"],$result["pass"])):
?>
	<p>ログインに成功しました</p>
<?php
			else:
				$errors="パスワードが違います";
			endif;
		else:
			$errors="ユーザーが存在しません";
		endif;
		$stmt=null;
		if(isset($errors)):
?>
	<p><?php echo $errors; ?></p>
	<p><a href='login.html'>ログイン画面に戻る</a></p>
<?php
		endif;
	else:
		die("直接アクセス禁止");
	endif;
	$pdo=null;
?>
</body>
</html>
