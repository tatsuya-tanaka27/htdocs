<?php
session_start();

require "check.php";

// POSTなら更新処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $upass = $_POST['pass'];
    $usex = $_POST['sex'];
    $uname = $_POST['name'];
    $upost = $_POST['post'];
    $utel = $_POST['tel'];

    //ユーザー更新
    try {
            
        if(chackUpdateParam($upass, $usex, $uname, $upost, $utel)){

            $pdo = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
            $stmt = $pdo->prepare('update kaiin3 set pass=:pass, sex=:sex, name=:name, post=:post, tel=:tel 
                where id=:id');
            $stmt->bindValue(":id", $_SESSION['user_data']['id'], PDO::PARAM_INT);
            $stmt->bindValue(":pass", $upass, PDO::PARAM_STR);
            $stmt->bindValue(":name", $uname, PDO::PARAM_STR);
            $stmt->bindValue(":sex", $usex, PDO::PARAM_INT);
            $stmt->bindValue(":post", $upost, PDO::PARAM_STR);
            $stmt->bindValue(":tel", $utel, PDO::PARAM_STR);      
            $stmt->execute();

            $stmt2 = $pdo->prepare('select * from kaiin3 where mail = :mail and pass = :pass;');
            $stmt2->bindValue(":mail", $_SESSION['user_data']['mail'], PDO::PARAM_STR);
            $stmt2->bindValue(":pass", $upass, PDO::PARAM_STR);
            $flg = $stmt2->execute();

            if($flg){
                //レコード情報をセッションに保存
                $_SESSION['user_data'] = $stmt2->fetch(PDO::FETCH_ASSOC);
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
            <span>名前：</span><input type="text" name="name" value="<?php echo $_SESSION['user_data']['name'] ?>"><br>
            <span>性別：</span><input type="text" name="sex" value="<?php echo $_SESSION['user_data']['sex'] ?>"><br>
            <span>郵便番号：</span><input type="text" name="post" value="<?php echo $_SESSION['user_data']['post'] ?>"><br>
            <span>電話番号：</span><input type="text" name="tel" value="<?php echo $_SESSION['user_data']['tel'] ?>"><br>          
            <button><input type="submit" name="update" value="更新"></button><br>
        </form>
    </body>
</html>