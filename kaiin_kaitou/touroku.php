<?php

$link=mysqli_connect("localhost","root","");
if(!$link){
	die("データベースに接続できません".mysqli_connect_error());
}

mysqli_select_db($link,"kaiin");
mysqli_set_charset($link,"utf8");

$errors=array();

if($_SERVER["REQUEST_METHOD"]==="POST"){
	$name=null;
	if(!isset($_POST["name"]) || !strlen($_POST["name"])){
		$errors["name"]="名前を入力してください";
	}else if(strlen($_POST["name"])>20){
		$errors["name"]="名前は２０文字以内で入力してください";
	}else{
		$sql="SELECT `name` FROM kaiin";
		$result=mysqli_query($link,$sql);
		while($post=mysqli_fetch_assoc($result)){
			if($_POST["name"]===$post["name"]){
				$errors["name"]="同じ名前が既に存在します";
				break;
			}
		}
		$name=$_POST["name"];
		mysqli_free_result($result);
	}

	$pass=null;
	if(!isset($_POST["pass"]) || !strlen($_POST["pass"])){
		$errors["pass"]="パスワードを入力してください";
	}else if(strlen($_POST["pass"])<6 || strlen($_POST["pass"])>12){
		$errors["pass"]="パスワードは６文字以上１２文字以下で入力してください";
	}else{
		$pass=$_POST["pass"];
	}

	$tel=null;
	if(!isset($_POST["tel"]) || !strlen($_POST["tel"])){
		$errors["tel"]="TELを入力してください";
	}else if(!(strlen($_POST["tel"])==10 || strlen($_POST["tel"])==11)){
		$errors["tel"]="TELは10または11文字で入力してください";
	}else{
		$tel=$_POST["tel"];
	}

	if(count($errors)===0){
		$sql = mysqli_prepare($link,'INSERT INTO `kaiin` (`name`,`pass`,`tel`) VALUES (?,?,?)');
		mysqli_stmt_bind_param($sql,'sss',$name,$pass,$tel);
		mysqli_stmt_execute($sql);
		mysqli_stmt_close($sql);
	}
}
else{
	mysqli_close($link);
	die("直接アクセス禁止です");
}
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>登録</title>
</head>
<body>
<?php if (count($errors)): ?>
		<ul class="error_list">
<?php foreach($errors as $error): ?>
			<li>
<?php echo htmlspecialchars($error,ENT_QUOTES,"UTF-8") ?>
			</li>
<?php endforeach; ?>
			<li><a href="kaiinntouroku.html">登録画面に戻る</a></li>
		</ul>
<?php else: ?>
		<p>登録完了しました</p>
<?php endif; ?>
</body>
</html>
