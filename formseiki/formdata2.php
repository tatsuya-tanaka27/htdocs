<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>php</title>
</head>
<body>
<?php
	$sexarr=array("男","女","選択しない");
	$mailmatch="/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+.[a-zA-Z0-9\._-]+$/";
	if(preg_match($mailmatch,$_POST["email"])):
		$email=$_POST["email"];
	else:
?>
	<p>メールアドレスの入力に誤りがあります。</p>
	<p><input type="button" value="入力に戻る" onClick="history.go(-1)"></p>
<?php
		exit();
	endif;
	
	if(preg_match("/^[a-zA-Z0-9]{8,12}$/",$_POST["pass"]) && preg_match("/[a-z]+/",$_POST["pass"]) && preg_match("/[A-Z]+/",$_POST["pass"]) && preg_match("/[0-9]+/",$_POST["pass"])):
		$pass=$_POST["pass"];
	else:
?>
	<p>パスワードの入力に誤りがあります。</p>
	<p><input type="button" value="入力に戻る" onClick="history.go(-1)"></p>
<?php
		exit();
	endif;
	
	if(preg_match("/^[0-9]{4}$/",$_POST["birth"]) && $_POST["birth"]>(date("Y")-120) && $_POST["birth"]<=date("Y")):
		$birth=$_POST["birth"];
	else:
?>
	<p>生年の入力に誤りがあります。</p>
	<p><input type="button" value="入力に戻る" onClick="history.go(-1)"></p>
<?php
		exit();
	endif;

	$sex=$sexarr[$_POST["sex"]];
	$purpose=$_POST["purpose"];
	$opi=htmlspecialchars($_POST["opi"],ENT_QUOTES,"UTF-8");
?>
	<p>メールアドレスは、<?php echo $email; ?></p>
	<p>パスワードは、<?php echo $pass; ?></p>
	<p>生年は、<?php echo $birth; ?>年</p>
	<p>性別は、<?php echo $sex; ?></p>
	<p>旅行目的は、<?php
		foreach($purpose as $value):
			echo $value,"&nbsp;";
		endforeach; ?></p>
	<p>ご意見は、<?php echo $opi; ?></p>
	<p>でよろしいですか？</p>
</body>
</html>