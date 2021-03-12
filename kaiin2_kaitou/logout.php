<?php
	session_start();
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-1000);
	}
	session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログアウト</title>
</head>
<body>
	<p>ログアウトしました</p>
	<p><a href="index.html">トップページ</a></p>
</body>
</html>
