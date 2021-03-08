<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>変更</title>
</head>
<body>

<?php
	$link=mysqli_connect("localhost","root","");
	if(!$link){
		die("データベースに接続できません".mysqli_connect_error());
	}

	mysqli_select_db($link,"kaiin");
	mysqli_set_charset($link,"utf8");

	if($_SERVER["REQUEST_METHOD"]==="POST"){

		if(!isset($_POST["tel"]) || !strlen($_POST["tel"])){
			echo "<p>TELを入力してください</p>";
		}
		else if(!(strlen($_POST["tel"])==10 || strlen($_POST["tel"])==11)){
			echo "<p>TELは10または11文字で入力してください</p>";
		}
		else{
			$sql=mysqli_prepare($link,"SELECT `name`,`pass` FROM `kaiin` WHERE `name`=?");
			mysqli_stmt_bind_param($sql,'s',$_POST['name']);
			mysqli_stmt_execute($sql);
			mysqli_stmt_store_result($sql);
			if(mysqli_stmt_num_rows($sql)!=0){
				mysqli_stmt_bind_result($sql,$name,$pass);
				mysqli_stmt_fetch($sql);
				if($_POST["pass"]===$pass){
					mysqli_stmt_close($sql);
					$sql = mysqli_prepare($link,'UPDATE `kaiin` SET `tel`=? WHERE `name`=?');
					mysqli_stmt_bind_param($sql,'ss',$_POST['tel'],$_POST['name']);
					mysqli_stmt_execute($sql);
					echo "<p>変更完了しました</p><br>";
				}
				else{
					echo "<p>パスワードが違います</p><br>";
					echo "<p><a href='henko.html'>前画面に戻る</a></p>";
				}
			}
			else{
				echo "<p>ユーザーが存在しません</p><br>";
				echo "<p><a href='henko.html'>ログイン画面に戻る</a></p>";
			}
			mysqli_stmt_close($sql);
		}
	}
	mysqli_close($link);
?>
</body>
</html>
