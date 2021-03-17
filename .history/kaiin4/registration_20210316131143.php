<?php
session_start();

require "check.php";

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pname = $_POST['name'];
    $ppass = $_POST['pass'];

    //必須入力チェック
    if(empty($pname) || empty($ppass)){
        echo "必須項目を入力してください。";
    } else {

        //ユーザー登録
        try {
            
            if(chackParam($pname, $ppass)){

                $pdo = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
                $stmt = $pdo->prepare('select * from kaiin where name = :name;');
                $stmt->bindValue(":name", $pname, PDO::PARAM_STR);
                $stmt->execute();

                $checkRow = null;

                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $checkRow = $result;
                    break;
                }

                if($checkRow != null){
                    echo "既に使用されているIDです。";
                } else {
                    $passhash=password_hash($ppass,PASSWORD_BCRYPT);
                    $sql2 = "insert into kaiin(name, pass, tel) VALUES('" . $pname ."','" . $passhash . "','" . "')";
                    $pdo->query($sql2);
                    $_SESSION['name'] = $pname;
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
            <span>ログインネーム</span><input type="text" name="name"><br>
            <span>ログインパスワード</span><input type="text" name="pass"><br>
            <button><input type="submit" name="registration" value="登録"></button><br>
        </form>
    </body>
</html>