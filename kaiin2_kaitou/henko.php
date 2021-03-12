<?php
	session_start();
	session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>変更</title>
</head>
<body>

<?php
if(isset($_SESSION['mail'])):
	$link=mysqli_connect("localhost","root","");
	if(!$link){
		die("データベースに接続できません".mysqli_connect_error());
	}

	mysqli_select_db($link,"kaiin2");
	mysqli_set_charset($link,"utf8");

	if($_SERVER["REQUEST_METHOD"]==="POST"):

		$telmatch="/^[0-9]{10,11}$/";
		if(!isset($_POST["tel"]) || !strlen($_POST["tel"])):
			$errors="TELを入力してください";
		else:
			if(!preg_match($telmatch,$_POST["tel"])):
				$errors="TELの形式が違います";
			else:
				$sql=mysqli_prepare($link,"SELECT `pass` FROM `kaiin2` WHERE `mail`=?");
				mysqli_stmt_bind_param($sql,'s',$_SESSION['mail']);
				mysqli_stmt_execute($sql);
				mysqli_stmt_store_result($sql);
				if(mysqli_stmt_num_rows($sql)!=0):
					mysqli_stmt_bind_result($sql,$pass);
					mysqli_stmt_fetch($sql);
					if($_POST["pass"]===$pass):
						mysqli_stmt_close($sql);
						$sql = mysqli_prepare($link,'UPDATE `kaiin2` SET `tel`=? WHERE `mail`=?');
						mysqli_stmt_bind_param($sql,'ss',$_POST['tel'],$_SESSION['mail']);
						mysqli_stmt_execute($sql);
?>
	<p>変更完了しました</p>
	<p><a href="kaiin.php">会員マイページ</a></p>
<?php
					else:
						$errors="パスワードが違います";
					endif;
				else:
?>
	<p>ログインしなおしてください</p>
	<p><a href='login.html'>ログインページ</a></p>
<?php
				endif;
				mysqli_stmt_close($sql);
			endif;
		endif;
		if(isset($errors)):
?>
	<p><?php echo $errors; ?></p>
	<p><a href='tourokuhenko.php'>前画面に戻る</a></p>
<?php
		endif;
	endif;
	mysqli_close($link);
else:
?>
	<p>ログインしなおしてください</p>
	<p><a href='login.html'>ログインページ</a></p>
<?php endif; ?>
</body>
</html>
