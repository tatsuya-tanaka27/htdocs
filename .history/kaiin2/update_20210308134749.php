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
                $stmt = $pdo->prepare('select * from kaiin2 where mail = :mail;');
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
                    $stmt2 = $pdo->prepare('insert into kaiin2(mail, pass, sex, tel, birth) 
                        VALUES(:mail, :pass, :sex, :tel, :birth)');
                    $stmt2->bindValue(":mail", $pmail, PDO::PARAM_STR);
                    $stmt2->bindValue(":pass", $ppass, PDO::PARAM_STR);
                    $stmt2->bindValue(":sex", $psex, PDO::PARAM_STR);
                    $stmt2->bindValue(":tel", $ptel, PDO::PARAM_STR);
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