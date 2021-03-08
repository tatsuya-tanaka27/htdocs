<?php
session_start();

require "check.php";

//セッションにDB設定セット
$_SESSION['dsn'] = 'mysql:dbname=kaiin;host=localhost;port=3307;';
$_SESSION['duser'] = 'root';
$_SESSION['dpass'] = 'password';

$initmail = "";
$initpass = "";

if(!empty($_COOKIE["cmail"])){
    $initname = $_COOKIE["cmail"]; 
}

if(!empty($_COOKIE["cpass"])){
    $initpass = $_COOKIE["cpass"];
}

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login_mail = $_POST['mail'];
    $login_pass = $_POST['pass'];
    setcookie('cmail', $login_mail, time()+60*60*24*365);
    setcookie('cpass', $login_pass, time()+60*60*24*365);

    //必須入力チェック
    if(empty($login_mail) || empty($login_pass)){
        echo "必須項目を入力してください。";
    } else {

        if(chackParam($login_mail, $login_pass)){
            //ユーザーログイン
            try {
                $pdo = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
                $stmt = $pdo->prepare('select * from kaiin2 where name = :name and pass = :pass;');
                $stmt->bindValue(":mail", $login_mail, PDO::PARAM_STR);
                $stmt->bindValue(":pass", $login_pass, PDO::PARAM_STR);
                echo("test");
                $flg = $stmt->execute();

                if($result){
                    $_SESSION['mail'] = $_POST['mail'];
                    $result = $stmt->fetch();
                    var_dump($result);
                    // リダイレクトを実行
	                //header( "Location: index.php" ) ;
                }
            
            } catch (PDOException $e) {
                print('Error:' . $e->getMessage());
                exit("DB接続に失敗しました。");
            }
            
        } else {
            echo "入力値が不正です。";
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
            <span>ログインアドレス</span><input type="text" name="mail" value="<?php echo $initmail ?>"><br>
            <span>ログインパスワード</span><input type="text" name="pass" value="<?php echo $initpass ?>" ><br>
            <button><input type="submit" name="send" value="ログイン"></button><br>
            <a href="registration.php">新規登録会員はこちら</a>
        </form>
    </body>
</html>