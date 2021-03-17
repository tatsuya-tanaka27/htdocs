<?php
	session_start();
	if(isset($_SESSION["name"])):
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>退会</title>
</head>
<body>
<?php
		if($_SERVER["REQUEST_METHOD"]==="POST"):
			try {
				$pdo = new PDO('mysql:host=localhost;dbname=kaiin3;charset=utf8','root','',
				array(PDO::ATTR_EMULATE_PREPARES => false));
			}
			catch (PDOException $e) {
				die('データベース接続失敗。'.$e->getMessage());
			}
			$stmt=$pdo->prepare("SELECT `pass` FROM `kaiin3` WHERE `mail`=:mail");
			$stmt->bindParam(':mail',$_SESSION["mail"]);
			$stmt->execute();
			$result=$stmt->fetch();
			if($result):
				if($_POST["pass"]===$result["pass"]):
					$stmt=null;
					$stmt = $pdo -> prepare("DELETE FROM `kaiin3` WHERE `mail`=:mail");
					$stmt -> bindParam(':mail',$_SESSION['mail']);
					$stmt -> execute();
?>
	<p>抹消完了しました</p>
<?php
				else:
					$errors="パスワードが違います";
				endif;
			else:
				die("セッションエラー");
			endif;
			$stmt=null;
			if(isset($errors)):
?>
	<p><?php echo $errors; ?></p>
	<p><a href='sakuzyo.php'>前画面に戻る</a></p
<?php
			endif;
			$pdo=null;
		else:
			die("送信エラー");
		endif;
?>
</body>
</html>
<?php
	else:
		die("直接アクセス禁止");
	endif;
?>