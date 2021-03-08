<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログイン</title>
</head>
<body>
<?php
	$link=mysqli_connect("localhost","root","");
	if(!$link){
		die("データベースに接続できません".mysqli_connect_error());
	}

	mysqli_select_db($link,"kaiin");
	mysqli_set_charset($link,"utf8");

	$flag=false;

	if($_SERVER["REQUEST_METHOD"]==="POST"){
		$sql="SELECT `name`,`pass` FROM `kaiin`";
		$result=mysqli_query($link,$sql);
		while($post=mysqli_fetch_assoc($result)){
			if($_POST["name"]===$post["name"]){
				if($_POST["pass"]===$post["pass"]){
					echo "<p>ログインに成功しました</p>";
					$flag=!$flag;
					break;
				}
				else{
					echo "<p>パスワードが違います</p><br>";
					echo "<p><a href='login.html'>ログイン画面に戻る</a></p>";
					$flag=!$flag;
					break;
				}
			}
		}
		if(!$flag){
			echo "<p>ユーザーが存在しません</p><br>";
			echo "<p><a href='login.html'>ログイン画面に戻る</a></p>";
		}
		mysqli_free_result($result);
	}
	else{
		mysqli_close($link);
		die("直接アクセス禁止です");
	}
	mysqli_close($link);
?>
</body>
</html>
