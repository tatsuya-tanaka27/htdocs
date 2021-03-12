<?php
	session_start();
	session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員情報変更</title>
</head>
<body>
<?php
	if(isset($_SESSION['mail'])):
?>
	<form action="henko.php" method="post">
		メールアドレス<?php echo $_SESSION['mail']; ?><br>
		パスワード<input type="password" name="pass" size="12"><br>
		tel<input type="text" name="tel" size="11"><br>
		<input type="submit" value="変更">
	</form>
<?php
	else:
?>
	<p>ログインしなおしてください</p>
	<p><a href='login.html'>ログインページ</a></p>
<?php endif; ?>
</body>
</html>
