<?php
	session_start();
	session_regenerate_id(true);
?>
<DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員抹消</title>
</head.
<body>
<?php
	if(isset($_SESSION['mail'])):
?>
	<form action="sakuzyo.php" method="post">
		メールアドレス<?php echo $_SESSION['mail']; ?><br>
		パスワード<input type="password" name="pass" size="12"><br>
		<input type="submit" value="抹消">
	</form>
<?php
	else:
?>
	<p>ログインしなおしてください</p>
	<p><a href='login.html'>ログインページ</a></p>
<?php endif; ?>

</body>
</html>
