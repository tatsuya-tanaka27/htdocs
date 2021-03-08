<?php
session_start();

require "check.php";

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pmail = $_POST['mail'];
    $ppass = $_POST['pass'];
    $ptel = $_POST['tel'];

    //必須入力チェック
    if(empty($pmail) || empty($ppass) || empty($ptel)){
        echo "必須項目を入力してください。";
    } else {

        //ユーザー登録
        try {
            
            if(chackParam($pmail, $ppass, $ptel)){

                $pdo = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
                $stmt = $pdo->prepare('select * from kaiin where mail = :mail;');
                $stmt->bindValue(":mail", $pmail, PDO::PARAM_STR);
                $stmt->execute();

                $checkRow = null;

                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $checkRow = $result;
                    break;
                }

                if($checkRow != null){
                    echo "既に使用されているメールアドレスです。";
                } else {
                    $sql2 = "insert into kaiin(mail, pass, tel) VALUES('" . $pmail ."','" . $ppass . "','" . $ptel . "')";
                    $pdo->query($sql2);
                    $_SESSION['mail'] = $pmail;
                    // リダイレクトを実行
	                header( "Location: index.php" );
                }
            
            } else {
                echo "入力値が不正です。";
            }

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
        <title>新規登録</title>
    </head>
    <body>
        <form method="post" action="registration.php">
            <span>ログインアドレス</span><input type="text" name="mail"><br>
            <span>ログインパスワード</span><input type="text" name="pass"><br>
            <span>電話番号</span><input type="text" name="tel"><br>
            <button><input type="submit" name="registration" value="登録"></button><br>
        </form>
    </body>
</html>