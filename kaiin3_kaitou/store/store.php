<?php
	if($_SERVER["REQUEST_METHOD"]==="POST"):
		try {
			if(!isset($_POST["sex"])):
?>
	<p>性別を選択してください</p>
	<p><a href="store.html">選択画面へ戻る</a></p>
<?php
				die();
			endif;
			$pdo = new PDO('mysql:host=localhost;dbname=kaiin3;charset=utf8','root','',
				array(PDO::ATTR_EMULATE_PREPARES => false));
			if($_POST["sex"]!=2):
				$stmt=$pdo->prepare("SELECT * FROM `kaiin3` WHERE `sex`=:sex");
				$stmt->bindParam(":sex",$_POST["sex"]);
			else:
				$stmt = $pdo->prepare("SELECT * FROM `kaiin3`");
			endif;
			$stmt->execute();
			$csvstr = "メールアドレス,暗証番号,表示名,性別,郵便番号,電話番号,\r\n";
			while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$csvstr .= $result['mail'] . ",";
				$csvstr .= $result['pass'] . ",";
				$csvstr .= $result['name'] . ",";
				$csvstr .= $result['sex'] . ",";
				$csvstr .= $result['post'] . ",";
				$csvstr .= $result['tel'] . "\r\n";//\r\nは改行
			}
			$fileName = "data.csv";
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename='.$fileName);
			echo mb_convert_encoding($csvstr, "SJIS", "UTF-8");
		}catch(PDOException $e){
			die('データベース接続失敗。'.$e->getMessage());
		}
	else:
		die("直接アクセス禁止");
	endif;
?>
