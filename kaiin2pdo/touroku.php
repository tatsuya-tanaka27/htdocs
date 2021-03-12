<?php
try {
	$pdo = new PDO('mysql:host=localhost;dbname=kaiin2;charset=utf8','root','',
	array(PDO::ATTR_EMULATE_PREPARES => false));
}
catch (PDOException $e) {
	die('データベース接続失敗。'.$e->getMessage());
}

$errors=array();

if($_SERVER["REQUEST_METHOD"]==="POST"){
	$mail=null;
	$mailmatch="/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+.[a-zA-Z0-9\._-]+$/";
	if(!isset($_POST["mail"]) || !strlen($_POST["mail"])){
		$errors["mail"]="メールアドレスを入力してください";
	}else if(strlen($_POST["mail"])>50){
		$errors["mail"]="メールアドレスが長すぎます";
	}else if(!preg_match($mailmatch,$_POST["mail"])){
		$errors["mail"]="メールアドレスの形式が誤っています";
	}else{
		$stmt=$pdo->prepare("SELECT `pass` FROM `kaiin2` WHERE `mail`=:mail");
		$stmt->bindParam(':mail',$_POST["mail"]);
		$stmt->execute();
		$result=$stmt->fetch();
		if($result){
			$errors["mail"]="このメールアドレスは登録済です";
		}
		else{
			$mail=$_POST["mail"];
		}
		$stmt=null;
	}

	$pass=null;
	$passmatch="/^[a-zA-Z0-9]{6,12}$/";
	if(!isset($_POST["pass"]) || !strlen($_POST["pass"])){
		$errors["pass"]="パスワードを入力してください";
	}else if(!preg_match($passmatch,$_POST["pass"])){
		$errors["pass"]="パスワードの形式が違います";
	}else{
		$pass=$_POST["pass"];
	}
	
	$sex=null;
	if(!isset($_POST["sex"]) || !strlen($_POST["sex"])){
		$errors["sex"]="性別を選んでください";
	}else{
		$sex=$_POST["sex"];
	}

	$tel=null;
	$telmatch="/^[0-9]{10,11}$/";
	if(!isset($_POST["tel"]) || !strlen($_POST["tel"])){
		$errors["tel"]="TELを入力してください";
	}else if(!preg_match($telmatch,$_POST["tel"])){
		$errors["tel"]="TELの形式が違います";
	}else{
		$tel=$_POST["tel"];
	}
	
	$birth=null;
	$birthmatch="/^[0-9]{4}$/";
	if(!isset($_POST["birth"]) || !strlen($_POST["birth"])){
		$errors["birth"]="生まれ年を入力してください";
	}else if(!preg_match($birthmatch,$_POST["birth"])){
		$errors["birth"]="生まれ年の形式が違います";
	}else{
		$birth=$_POST["birth"];
	}

	if(count($errors)===0){
		$stmt = $pdo -> prepare("INSERT INTO `kaiin2` (`mail`,`pass`,`sex`,`tel`,`birth`) VALUES (:mail,:pass,:sex,:tel,:birth)");
		$stmt->bindParam(':mail',$mail);
		$stmt->bindParam(':pass',$pass);
		$stmt->bindParam(':sex',$sex);
		$stmt->bindParam(':tel',$tel);
		$stmt->bindParam(':birth',$birth);
		$stmt->execute();
		$stmt=null;
	}
}
$pdo=null;
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
			<li><a href="kaiinntouroku.html">登録画面に戻る</a></li>
		</ul>
		<?php else: ?>
		<p>登録完了しました</p>
		<?php endif; ?>
</body>
</html>
