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
	if(!$link):
		die("データベースに接続できません".mysqli_connect_error());
	endif;

	mysqli_select_db($link,"kaiin2");
	mysqli_set_charset($link,"utf8");

	if($_SERVER["REQUEST_METHOD"]==="POST"):
		$sql=mysqli_prepare($link,"SELECT `pass` FROM `kaiin2` WHERE `mail`=?");
		mysqli_stmt_bind_param($sql,'s',$_SESSION['mail']);
		mysqli_stmt_execute($sql);
		mysqli_stmt_store_result($sql);
		if(mysqli_stmt_num_rows($sql)!=0):
			mysqli_stmt_bind_result($sql,$pass);
			mysqli_stmt_fetch($sql);
			if($_POST["pass"]===$pass):
				mysqli_stmt_close($sql);
				$sql = mysqli_prepare($link,'DELETE FROM `kaiin2` WHERE `mail`=?');
				mysqli_stmt_bind_param($sql,'s',$_SESSION['mail']);
				mysqli_stmt_execute($sql);
?>
	<p>退会処理完了しました</p>
	<p><a href="index.html">トップページ</a></p>
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
		if(isset($errors)):
?>
	<p><?php echo $errors; ?></p>
	<p><a href='tourokusakuzyo.php'>前画面に戻る</a></p
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
