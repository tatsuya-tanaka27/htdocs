<?php
	session_start();
	session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員ページ</title>
</head>
<?php
	if(isset($_SESSION['mail'])):
?>
	<h1><?php echo $_SESSION['mail']; ?>様マイページ</h1>
	<p><a href='tourokuhenko.php'>電話番号変更</a></p>
	<p><a href='tourokusakuzyo.php'>退会</a></p>
	<p><a href='logout.php'>ログアウト</a></p>
<?php
	else:
?>
	<p>ログインしなおしてください</p>
	<p><a href='login.html'>ログインページ</a></p>
<?php endif; ?>
</body>
</html>

<body>