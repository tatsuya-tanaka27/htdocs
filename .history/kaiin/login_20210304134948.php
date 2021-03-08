<?php
session_start();

$dsn = 
$user = 'root';
$password = 'password';

$_SESSION['dsn'] = 'mysql:dbname=kakeibodb;host=localhost;port=3307;';
$_SESSION['dsn'] 
$_SESSION['dsn'] 

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログイン</title>
    </head>
    <body>
        <form method="post" action="login.php">
            <span>ログインネーム</span><input type="text" name="name"><br>
            <span>ログインパスワード</span><input type="text" name="pass"><br>
            <button><input type="submit" name="send" value="ログイン"></button><br>
            <a href="registration.php">新規登録会員はこちら</a>
        </form>
    </body>
</html>