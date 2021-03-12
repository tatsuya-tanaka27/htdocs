<?php
//DB接続情報
$dbname = 'mysql:dbname=kaiin;host=localhost;port=3307;';
$id = 'root';
$pw = 'password';

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	try {
		//DB取得処理
		$pdo = new PDO($dbname, $id, $pw,array(PDO::ATTR_ERRMODE => false));
		$sql = "SELECT * FROM `kaiin3` ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		//CSV文字列生成
		$csvstr = "メールアドレス,パスワード,名前,性別,電話番号\r\n";
		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$csvstr .= $result['mail'] . ",";
			$csvstr .= $result['pass'] . ",";
			$csvstr .= $result['name'] . ",";
			$csvstr .= $result['sex'] . ",";
			$csvstr .= $result['post'] . ",";
			$csvstr .= $result['tel'] . "\r\n";//\r\nは改行
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
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>CSVダウンロード</title>
  </head>
  <body>
    <form action="cvs.php" method="post">
		<input type="radio" name="sex" value=0> 男
		<input type="radio" name="sex" value=1> いいえ
		<input type="radio" name="sex" value=2> いいえ
    	<input type="submit" name="dlbtn" value="CVSダウンロード">
    </form>
  </body>
</html>

