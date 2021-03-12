<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>登録</title>
</head>
<body>
<?php
	try {
	$pdo = new PDO('mysql:host=localhost;dbname=kaiin2;charset=utf8','root','',
	array(PDO::ATTR_EMULATE_PREPARES => false));
	}
	catch (PDOException $e) {
	 die('データベース接続失敗。'.$e->getMessage());
	}

	if($_SERVER["REQUEST_METHOD"]==="POST"){
		$stmt=$pdo->prepare("SELECT `pass` FROM `kaiin2` WHERE `mail`=:mail");
		$stmt->bindParam(":mail",$_POST["mail"]);
		$stmt->execute();
		$result=$stmt->fetch();
		if($result){
			if($_POST["pass"]===$result["pass"]){
				echo "<p>ログインに成功しました</p>";
			}
			else{
				$errors="パスワードが違います";
			}
		}
		else{
			$errors="ユーザーが存在しません";
		}
		$stmt=null;
		if(isset($errors)):
?>
	<p><?php echo $errors; ?></p>
	<p><a href='login.html'>ログイン画面に戻る</a></p>
<?php
		endif;
	}
	$pdo=null;
?>
</body>
</html>
