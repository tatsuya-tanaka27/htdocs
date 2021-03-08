<?php
session_start();

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pname = $_POST['name'];
    $ppass = $_POST['pass'];
    $ptel = $_POST['tel'];

    //必須入力チェック
    if(empty($pname) || empty($ppass) || empty($ptel)){
        echo "必須項目を入力してください。";
    } else {

        //ユーザー登録
        try {
            
            $pdo = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
            $stmt = $pdo->prepare('select * from kaiin where name = :name and pass = :pass;');
            $stmt->bindValue(":name", $pname, PDO::PARAM_STR);
            $stmt->bindValue(":pass", $ppass, PDO::PARAM_STR);
            $result = $stmt->execute();

            if($result){
                echo ""
            } else {
                $sql2 = "insert into kaiin(name, pass, tel) VALUES('" . $pname ."','" . $ppass . "','" . $ptel . "')";
                $pdo->query($sql2);
                $_SESSION['name'] = $_POST['name'];
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
            <span>電話番号</span><input type="text" name="tel"><br>
            <button><input type="submit" name="registration" value="登録"></button><br>
        </form>
    </body>
</html>