<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>変更</title>
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
		$telmatch="/^[0-9]{10,11}$/";
		$stmt=$pdo->prepare("SELECT `pass` FROM `kaiin2` WHERE `mail`=:mail");
		$stmt->bindParam(':mail',$_POST["mail"]);
		$stmt->execute();
		$result=$stmt->fetch();
			if($result){
				if($_POST["pass"]===$result["pass"]){
					if(!isset($_POST["tel"]) || !strlen($_POST["tel"])){
						$errors="TELを入力してください";
					}else if(!preg_match($telmatch,$_POST["tel"])){
						$errors="電話番号の形式に誤りがあります";
					}else{
						$stmt=null;
						$sql = 'UPDATE `kaiin2` SET `tel` = :tel WHERE `mail` = :mail';
						$stmt = $pdo -> prepare($sql);
						$stmt->bindParam(':tel',$_POST['tel']);
						$stmt->bindParam(':mail',$_POST['mail']);
						$stmt->execute();
						echo "<p>電話番号を変更しました</p>";
					}
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
	<p><a href='henko.html'>前画面に戻る</a></p>
<?php
		endif;
	}
	$pdo=null;
?>
</body>
</html>
