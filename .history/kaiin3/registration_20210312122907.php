<?php
session_start();

require "check.php";

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pmail = $_POST['mail'];
    $ppass = $_POST['pass'];
    $pname = $_POST['pname'];
    $psex = $_POST['sex'];
    $ppost = $_POST['post'];
    $ptel = $_POST['tel'];

    //ユーザー登録
    try {
            
        if(chackRegistrationParam($pmail, $ppass, $pname, $psex, $ppost, $ptel)){

            $pdo = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
            $stmt = $pdo->prepare('select * from kaiin3 where mail = :mail;');
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
                $stmt2 = $pdo->prepare('insert into kaiin3(mail, pass, name, sex, post, tel) 
                    VALUES(:mail, :pass, :name, :sex, :post, :tel)');
                $stmt2->bindValue(":mail", $pmail, PDO::PARAM_STR);
                $stmt2->bindValue(":pass", $ppass, PDO::PARAM_STR);
                $stmt2->bindValue(":name", $pname, PDO::PARAM_STR);
                $stmt2->bindValue(":sex", $psex, PDO::PARAM_INT);
                $stmt2->bindValue(":post", $ppost, PDO::PARAM_STR);
                $stmt2->bindValue(":tel", $ptel, PDO::PARAM_STR);
                $stmt2->execute();

                $stmt3 = $pdo->prepare('select * from kaiin3 where mail = :mail and pass = :pass;');
                $stmt3->bindValue(":mail", $pmail, PDO::PARAM_STR);
                $stmt3->bindValue(":pass", $ppass, PDO::PARAM_STR);
                $flg = $stmt3->execute();

                if($flg){
                    //レコード情報をセッションに保存
                    $_SESSION['user_data'] = $stmt3->fetch(PDO::FETCH_ASSOC);
                    // リダイレクトを実行
	                header( "Location: index.php" );
                } else {
                    exit("DB接続エラーが発生しました。");
                }
                
                
            }
            
        } else {
            echo "入力値が不正です。";
        }

    } catch (PDOException $e) {
        print('Error:' . $e->getMessage());
        exit("DB接続に失敗しました。");
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
            <span>名前：</span><input type="text" name="name"><br>
            <span>性別：</span><input type="text" name="sex"><br>
            <span>郵便番号：</span><input type="text" name="post"><br>
            <span>電話番号：</span><input type="text" name="tel"><br>
            <button><input type="submit" name="registration" value="登録"></button><br>
        </form>
    </body>
</html>