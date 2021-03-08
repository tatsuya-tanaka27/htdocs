<?php
session_start();

require "check.php";

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $upass = $_POST['pass'];
    $usex = $_POST['sex'];
    $utel = $_POST['tel'];
    $ubirth = $_POST['birth'];

    //必須入力チェック
    if(empty($umail) || empty($upass) || empty($utel) || empty($ubirth)){
        echo "全ての項目を入力してください。";
    } else {

        //ユーザー登録
        try {
            
           // if(chackParam($pmail, $ppass, $ptel)){

                $pdo = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
                $stmt = $pdo->prepare('update kaiin2 pass=:pass, sex=:sex, tel=:tel, birth=:birth) 
                    where id=:id');
                $stmt->bindValue(":id", $_SESSION['user_data']['id'], PDO::PARAM_INT);
                $stmt->bindValue(":pass", $upass, PDO::PARAM_STR);
                $stmt->bindValue(":sex", $usex, PDO::PARAM_INT);
                $stmt->bindValue(":tel", $utel, PDO::PARAM_STR);
                $stmt->bindValue(":birth", $ubirth, PDO::PARAM_INT);
                $stmt->execute();
                $_SESSION['pass'] = $upass;
                $_SESSION['sex'] = $usex;
                $_SESSION['tel'] = $utel;
                $_SESSION['birth'] = $ubirth;
                // リダイレクトを実行
	            header( "Location: index.php" );
            }
            
        //    } else {
       //         echo "入力値が不正です。";
        //    }

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