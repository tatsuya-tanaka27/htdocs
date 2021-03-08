<?php
session_start();

//セッションにDB設定セット
$_SESSION['dsn'] = 'mysql:dbname=kaiin;host=localhost;port=3307;';
$_SESSION['duser'] = 'root';
$_SESSION['dpass'] = 'password';

$initname = "";
$initpass = "";

echo $_COOKIE["cname"];
if(!empty($_COOKIE["cname"])){
    $initname = $_COOKIE["cname"];
}

if(!empty($_COOKIE["cpass"])){
    $initpass = $_COOKIE["cpass"];
}

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login_name = $_POST['name'];
    $login_pass = $_POST['pass'];
    setcookie('cname', $login_name, time()+60*60*24*365);
    setcookie('cpass', $login_pass, time()+60*60*24*365);

    //必須入力チェック
    if(empty($login_name) || empty($login_pass)){
        echo "必須項目を入力してください。";
    } else {

        //ユーザーログイン
        try {
            $dbh = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
            $stmt = $dbh->prepare('select * from kaiin WHERE name = :name and pass = :pass;');
            $stmt->bindValue(":name", $login_name, PDO::PARAM_STR);
            $stmt->bindValue(":pass", $login_pass, PDO::PARAM_STR);
            var_dump($stmt);
            $row = $dbh->query($sql);
            var_dump($row);
            //$_SESSION['name'] = ;
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
            <span>ログインネーム</span><input type="text" name="name" value="<?php $initname ?>"><br>
            <span>ログインパスワード</span><input type="text" name="pass" value="<?php $initpass?>" ><br>
            <button><input type="submit" name="send" value="ログイン"></button><br>
            <a href="registration.php">新規登録会員はこちら</a>
        </form>
    </body>
</html>