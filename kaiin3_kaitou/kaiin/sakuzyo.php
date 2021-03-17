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
	<h1>退会</h1>
	<p><?php echo $_SESSION['name'] ?>様</p>
	<form action="sakuzyotouroku.php" method="post">
		パスワード<input type="password" name="pass" size="12"><br>
		<input type="submit" value="退会">
	</form>
</body>
</html>
<?php
	else:
		die("直接アクセス禁止");
	endif;
?>