<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログイン</title>
</head>
<body>
<?php
	$link=mysqli_connect("localhost","root","");
	if(!$link):
		die("データベースに接続できません".mysqli_connect_error());
	endif;

	mysqli_select_db($link,"kaiin2");
	mysqli_set_charset($link,"utf8");

	if($_SERVER["REQUEST_METHOD"]==="POST"):
		$sql=mysqli_prepare($link,"SELECT `pass` FROM `kaiin2` WHERE `mail`=?");
		mysqli_stmt_bind_param($sql,'s',$_POST['mail']);
		mysqli_stmt_execute($sql);
		mysqli_stmt_store_result($sql);
		if(mysqli_stmt_num_rows($sql)!=0):
			mysqli_stmt_bind_result($sql,$pass);
			mysqli_stmt_fetch($sql);
				if($_POST["pass"]===$pass):
					session_start();
					session_regenerate_id(true);
					$_SESSION['mail']=$_POST["mail"];
					$_SESSION['pass']=$_POST["pass"];
					header("Location: http://".$_SERVER['HTTP_HOST']."/kaiin2/kaiin.php");
				else:
					$errors="パスワードが違います";
				endif;
		else:
			$errors="ユーザーが存在しません";
		endif;
		mysqli_stmt_close($sql);
		if(isset($errors)):
?>
	<p><?php echo $errors; ?></p>
	<p><a href='login.html'>ログイン画面に戻る</a></p>
<?php
		endif;
	endif;
	mysqli_close($link);
?>
</body>
</html>
