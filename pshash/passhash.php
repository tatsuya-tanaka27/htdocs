<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>パスワードハッシュ</title>
</head>
<body>
<?php
	$pass="ab1234";
//パスワードを毎回違う値のハッシュ化
//PASSWORD_BCRYPTを第2引数に指定し、60文字のハッシュを得る
	$passhash=password_hash($pass,PASSWORD_BCRYPT);
	var_dump($passhash);
	echo "<br>";
//パスワードを毎回違う値のハッシュ化
//PASSWORD_DEFAULTを第2引数に指定し、60文字以上になる可能性のあるハッシュを得る
//こちらが推奨されている
	$passhash2=password_hash($pass,PASSWORD_DEFAULT);
	var_dump($passhash2);
	echo "<br>";
//ハッシュ化した値をＤＢに格納
/*パスワードチェック
password_verify()を使用
第1引数にハッシュ前のパスワード
第2引数にハッシュ化したパスワード
*/
	if(password_verify($pass,$passhash)):
?>
	<p>パスワード認証完了</p>
<?php
	else:
?>
	<p>パスワード認証失敗</p>
<?php
	endif;
		if(password_verify($pass,$passhash2)):
?>
	<p>パスワード認証完了</p>
<?php
	else:
?>
	<p>パスワード認証失敗</p>
<?php
	endif;
?>
</body>
</html>