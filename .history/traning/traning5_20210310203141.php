<?php 
    try {
	$pdo = new PDO('mysql:host=localhost;dbname=traning;charset=utf8','root','password',
	array(PDO::ATTR_EMULATE_PREPARES => false));
	}
	catch (PDOException $e) {
	 die('データベース接続失敗。'.$e->getMessage());
	}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>php</title>
    </head>
    <body>
        <form method="post" action="traning5.php">
            <input type="text" name="val">
            <button><input type="
            " name="send" value="送信"></button>
        </form>
        <p></p>
    </body>
</html>