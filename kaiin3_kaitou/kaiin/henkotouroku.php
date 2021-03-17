<?php
	session_start();
	if(isset($_SESSION["name"])):
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>変更</title>
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
					$postmatch="/^[0-9]{7}$/";
					if(!preg_match($postmatch,$_POST["post"])):
						$errors="郵便番号を正しく入力してください";
					else:
						$stmt=null;
						$sql = 'UPDATE `kaiin3` SET `post` = :post WHERE `name` = :name';
						$stmt = $pdo -> prepare($sql);
						$stmt->bindParam(':post',$_POST['post']);
						$stmt->bindParam(':name',$_SESSION['name']);
						$stmt->execute();
?>
		<p>電話番号を変更しました</p>
<?php
					endif;
				else:
					$errors="パスワードが違います";
				endif;
			else:
				die("セッション切れ");
			endif;
			$stmt=null;
		else:
			die("送信エラー");
		endif;
		$pdo=null;
		if(isset($errors)):
?>
	<p><?php echo $errors; ?></p>
	<p><a href='henko.php'>前画面に戻る</a></p>
<?php
		endif;
?>
</body>
</html>
<?php
	else:
		die("直接アクセス禁止");
	endif;
?>
