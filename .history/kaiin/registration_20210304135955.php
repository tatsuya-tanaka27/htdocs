<?php
session_start();

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $dbh = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);

        $sql = 'select * from kakeibo_user';
        foreach ($dbh->query($sql) as $row) {
            print($row['id'] . ',');
            print($row['name']);
            print('<br />');
        }
    } catch (PDOException $e) {
        print('Error:' . $e->getMessage());
        e();
    }

}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>新規登録</title>
    </head>
    <body>
        <form method="post" action="registration.php">
            <span>ログインネーム</span><input type="text" name="name"><br>
            <span>ログインパスワード</span><input type="text" name="pass"><br>
            <span>電話番号</span><input type="text" name="pass"><br>
            <button><input type="submit" name="send" value="ログイン"></button><br>
        </form>
    </body>
</html>