<?php
	session_start();
	if(isset($_SESSION["name"])):
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員情報変更</title>
</head>
<body>
	<h1>郵便番号変更</h1>
	<p><?php echo $_SESSION['name'] ?>様</p>
	<form action="henkotouroku.php" method="post">
		パスワード<input type="password" name="pass" size="12"><br>
		新郵便番号<input type="text" name="post" size="7"><br>
		<input type="submit" value="変更">
	</form>
</body>
</html>
<?php
	else:
		die("直接アクセス禁止");
	endif;
?>
