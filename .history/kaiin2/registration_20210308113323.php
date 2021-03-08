<?php
session_start();

require "check.php";

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pmail = $_POST['mail'];
    $ppass = $_POST['pass'];
    $psex = $_POST['sex'];
    $ptel = $_POST['tel'];
    $pbirth = $_POST['birth'];

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
                    $pdo = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
                    $stmt2 = $pdo->prepare('insert into kaiin(mail, pass, sex, tel, birth) 
                        VALUES(:mail, :pass, :sex, :tel, :birth');
                    $stmt2->bindValue(":mail", $pmail, PDO::PARAM_STR);
                    $stmt2->bindValue(":pass", $ppass, PDO::PARAM_STR);
                    $stmt2->bindValue(":sex", $psex, PDO::PARAM_STR);
                    $stmt2->bindValue(":tel", $tel, PDO::PARAM_STR);
                    $stmt2->bindValue(":birth", $pbirth, PDO::PARAM_STR);
                    var_dump($stmt2);
                    $stmt2->execute();
                    $_SESSION['mail'] = $pmail;
                    $_SESSION['pass'] = $ppass;
                    $_SESSION['sex'] = $psex;
                    $_SESSION['tel'] = $ptel;
                    $_SESSION['birth'] = $pbirth;
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
            <span>ログインアドレス：</span><input type="text" name="mail"><br>
            <span>ログインパスワード：</span><input type="text" name="pass"><br>
            <span>性別：</span><input type="text" name="sex"><br>
            <span>電話番号</span><input type="text" name="tel"><br>
            <span>生まれ年（西暦）：</span><input type="text" name="birth"><br>
            <button><input type="submit" name="registration" value="登録"></button><br>
        </form>
    </body>
</html>