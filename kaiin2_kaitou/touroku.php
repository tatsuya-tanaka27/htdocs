<?php

$link=mysqli_connect("localhost","root","");
if(!$link):
	die("データベースに接続できません".mysqli_connect_error());
endif;

mysqli_select_db($link,"kaiin2");
mysqli_set_charset($link,"utf8");

$errors=array();

if($_SERVER["REQUEST_METHOD"]==="POST"):
	$mail=null;
	$mailmatch="/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+.[a-zA-Z0-9\._-]+$/";
	if(!isset($_POST["mail"]) || !strlen($_POST["mail"])):
		$errors["mail"]="メールアドレスを入力してください";
	else:
		if(strlen($_POST["mail"])>50):
			$errors["mail"]="メールアドレスが長すぎます";
		else:
			if(!preg_match($mailmatch,$_POST["mail"])):
				$errors["mail"]="メールアドレスの形式が誤っています";
			else:
				$sql=mysqli_prepare($link,"SELECT `id` FROM `kaiin2` WHERE `mail`=?");
				mysqli_stmt_bind_param($sql,'s',$_POST['mail']);
				mysqli_stmt_execute($sql);
				mysqli_stmt_store_result($sql);
				if(mysqli_stmt_num_rows($sql)!=0):
					$errors["mail"]="このメールアドレスは登録済です";
				else:
					$mail=$_POST["mail"];
				endif;
				mysqli_stmt_close($sql);
			endif;
		endif;
	endif;

	$pass=null;
	$passmatch="/^[a-zA-Z0-9]{6,12}$/";
	if(!isset($_POST["pass"]) || !strlen($_POST["pass"])):
		$errors["pass"]="パスワードを入力してください";
	else:
		if(!preg_match($passmatch,$_POST["pass"])):
			$errors["pass"]="パスワードの形式が違います";
		else:
			$pass=$_POST["pass"];
		endif;
	endif;
	
	$sex=null;
	if(!isset($_POST["sex"]) || !strlen($_POST["sex"])):
		$errors["sex"]="性別を選んでください";
	else:
		$sex=$_POST["sex"];
	endif;

	$tel=null;
	$telmatch="/^0[0-9]{9,10}$/";
	if(!isset($_POST["tel"]) || !strlen($_POST["tel"])):
		$errors["tel"]="TELを入力してください";
	else:
		if(!preg_match($telmatch,$_POST["tel"])):
			$errors["tel"]="TELの形式が違います";
		else:
			$tel=$_POST["tel"];
		endif;
	endif;
	
	$birth=null;
	$birthmatch="/^[0-9]{4}$/";
	if(!isset($_POST["birth"]) || !strlen($_POST["birth"])):
		$errors["birth"]="生まれ年を入力してください";
	else:
		if(!(preg_match($birthmatch,$_POST["birth"]) && $_POST["birth"]>(date("Y")-120) && $_POST["birth"]<=date("Y"))):
			$errors["birth"]="生まれ年の形式が違います";
		else:
			$birth=$_POST["birth"];
		endif;
	endif;

	if(count($errors)===0):
		$sql = mysqli_prepare($link,'INSERT INTO `kaiin2` (`mail`,`pass`,`sex`,`tel`,`birth`) VALUES (?,?,?,?,?)');
		mysqli_stmt_bind_param($sql,'ssisi',$mail,$pass,$sex,$tel,$birth);
		mysqli_stmt_execute($sql);
		mysqli_stmt_close($sql);
	endif;
endif;
mysqli_close($link);
?>
<DOCTYPE html>
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
			<li><a href="kaiintouroku.html">登録画面に戻る</a></li>
		</ul>
<?php else: ?>
		<p>登録完了しました</p>
		<p><a href="login.html">ログインへ</a></p>
<?php endif; ?>
</body>
</html>
