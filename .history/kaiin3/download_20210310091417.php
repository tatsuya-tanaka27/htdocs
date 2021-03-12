<?php
//DB接続情報
$dbname = 'mysql:host=localhost;dbname=kaiin2';
$id = 'root';
$pw = '';

	try {
//DB取得処理
		$pdo = new PDO($dbname, $id, $pw,array(PDO::ATTR_ERRMODE => false));
		$sql = "SELECT * FROM `kaiin2` ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

//CSV文字列生成
		$csvstr = "メールアドレス,暗証番号,性別,電話番号,生まれ年\r\n";
		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$csvstr .= $result['mail'] . ",";
			$csvstr .= $result['pass'] . ",";
			$csvstr .= $result['sex'] . ",";
			$csvstr .= $result['tel'] . ",";
			$csvstr .= $result['birth'] . "\r\n";//\r\nは改行
		}

//CSV出力
		//ダウンロードファイル名作成
		$fileName = "data.csv";
		//ダウンロードファイル形式指定
		header('Content-Type: text/csv');
		//ダウンロードファイル名指定
		header('Content-Disposition: attachment; filename='.$fileName);
		//ダウンロードデータ出力
	//	echo $csvstr; //UTF8出力の場合こちらを使用
		echo mb_convert_encoding($csvstr, "SJIS", "UTF-8");// Shift-JISに変換したい場合のみ
		exit();
	}catch(PDOException $e){
		die('データベース接続失敗。'.$e->getMessage());
	}
?>


