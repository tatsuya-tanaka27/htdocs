<?php
session_start();

//セッションにDB設定セット
$_SESSION['dsn'] = 'mysql:dbname=kaiin;host=localhost;port=3307;';
$_SESSION['duser'] = 'root';
$_SESSION['dpass'] = 'password';

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login_name = $_POST['name'];
    $login_pass = $_POST['pass'];

    //必須入力チェック
    if(empty($login_name) || empty($ppass) || empty($ptel)){
        echo "必須項目を入力してください。";
    } else {

        //ユーザー登録
        try {
            $dbh = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
            $sql = "insert into kaiin(name, pass, tel) VALUES('" . $pname ."','" . $ppass . "','" . $ptel . "')";
            $dbh->query($sql);
            $_SESSION['name'];
        } catch (PDOException $e) {
            print('Error:' . $e->getMessage());
            exit("DB接続に失敗しました。");
        }
    }

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