<?php
session_start();

require "check.php";

// POSTなら更新処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $upass = $_POST['pass'];
    $usex = $_POST['sex'];
    $utel = $_POST['tel'];
    $ubirth = $_POST['birth'];

    //ユーザー更新
    try {
            
        if(chackUpdateParam($upass, $usex, $utel, $ubirth)){

            $pdo = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
            $stmt = $pdo->prepare('update kaiin2 set pass=:pass, sex=:sex, tel=:tel, birth=:birth 
                where id=:id');
            $stmt->bindValue(":id", $_SESSION['user_data']['id'], PDO::PARAM_INT);
            $stmt->bindValue(":pass", $upass, PDO::PARAM_STR);
            $stmt->bindValue(":sex", $usex, PDO::PARAM_INT);
            $stmt->bindValue(":tel", $utel, PDO::PARAM_STR);
            $stmt->bindValue(":birth", $ubirth, PDO::PARAM_INT);
            $stmt->execute();

            $stmt2 = $pdo->prepare('select * from kaiin2 where mail = :mail and pass = :pass;');
                $stmt2->bindValue(":mail", $login_mail, PDO::PARAM_STR);
                $stmt3->bindValue(":pass", $login_pass, PDO::PARAM_STR);
                $flg = $stmt3->execute();

                if($flg){
                    //レコード情報をセッションに保存
                    $_SESSION['user_data'] = $stmt3->fetch(PDO::FETCH_ASSOC);
                    // リダイレクトを実行
	                header( "Location: index.php" );
                } else {
                    exit("DB接続エラーが発生しました。");
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
        <title>更新</title>
    </head>
    <body>
        <form method="post" action="update.php">
            <span>ログインパスワード：</span><input type="text" name="pass" value="<?php echo $_SESSION['user_data']['pass'] ?>"><br>
            <span>性別：</span><input type="text" name="sex" value="<?php echo $_SESSION['user_data']['sex'] ?>"><br>
            <span>電話番号</span><input type="text" name="tel" value="<?php echo $_SESSION['user_data']['tel'] ?>"><br>
            <span>生まれ年（西暦）：</span><input type="text" name="birth" value="<?php echo $_SESSION['user_data']['birth'] ?>"><br>
            <button><input type="submit" name="update" value="更新"></button><br>
        </form>
    </body>
</html>