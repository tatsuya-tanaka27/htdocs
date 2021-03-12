<?php 
    try {
	$pdo = new PDO('mysql:host=localhost;dbname=traning;port=3307;charset=utf8','root','password',
	array(PDO::ATTR_EMULATE_PREPARES => false));
	}
	catch (PDOException $e) {
	 die('データベース接続失敗。'.$e->getMessage());
	}
    $stmt = $pdo->prepare("SELECT * FROM student WHERE student_id=:student_id");
    $stmt = $pdo->prepare('select * from kaiin2 where mail = :mail and pass = :pass;');
	$stmt->bindParam(":student_id","shioda");
    $stmt->bindValue(":mail", $login_mail, PDO::PARAM_STR);
	$stmt->execute();
	$result=$stmt->fetch();
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>php</title>
    </head>
    <body>
        <?php var_dump($result); ?>
        <form method="post" action="traning5.php">
            <input type="text" name="val">
            <button><input type="
            " name="send" value="送信"></button>
        </form>
        <p></p>
    </body>
</html>