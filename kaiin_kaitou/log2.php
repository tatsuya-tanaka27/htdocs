<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>登録</title>
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
		$sql=mysqli_prepare($link,"SELECT `name`,`pass` FROM `kaiin` WHERE `name`=?");
		mysqli_stmt_bind_param($sql,'s',$_POST['name']);
		mysqli_stmt_execute($sql);
		mysqli_stmt_store_result($sql);
		if(mysqli_stmt_num_rows($sql)!=0){
			mysqli_stmt_bind_result($sql,$name,$pass);
			mysqli_stmt_fetch($sql);//複数件取得の場合はwhileで行う
			//while(mysqli_stmt_fetch($sql)){
				if($_POST["pass"]===$pass){
					echo "<p>ログインに成功しました</p>";
					$flag=!$flag;
				}
				else{
					echo "<p>パスワードが違います</p><br>";
					echo "<p><a href='login2.html'>ログイン画面に戻る</a></p>";
					$flag=!$flag;
				}
			//}
		}
		else{
			echo "<p>ユーザーが存在しません</p><br>";
			echo "<p><a href='login.html'>ログイン画面に戻る</a></p>";
		}
		mysqli_stmt_close($sql);
	}
	else{
		mysqli_close($link);
		die("直接アクセス禁止です");
	}
	mysqli_close($link);
?>
</body>
</html>
