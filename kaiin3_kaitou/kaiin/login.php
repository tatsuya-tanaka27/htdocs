<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員ページ</title>
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

		$stmt=$pdo->prepare("SELECT `pass`,`name` FROM `kaiin3` WHERE `mail`=:mail");
		$stmt->bindParam(":mail",$_POST["mail"]);
		$stmt->execute();
		$result=$stmt->fetch();
		if($result):
			if($_POST["pass"]===$result["pass"]):
				session_start();
				session_regenerate_id(true);
				$_SESSION['mail']=$_POST["mail"];
				$_SESSION['name']=$result["name"];
?>
	<h1>会員専用ページ</h1>
	<p><?php echo $_SESSION['name'] ?>様</p>
	<ul>
		<li><a href="henko.php">郵便番号変更</a></li>
		<li><a href="sakuzyo.php">会員退会</a></li>
		<li><a href="logout.php">ログアウト</a></li>
	</ul>
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
	<p><a href='index.html'>ログイン画面に戻る</a></p>
<?php
		endif;
	$pdo=null;	
	else:
		die("直接アクセス禁止");
	endif;
?>
</body>
</html>
