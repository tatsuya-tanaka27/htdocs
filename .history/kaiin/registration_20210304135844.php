<?php
session_start();

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    

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
            <span>電話番号</span><input type="text" name="pass"><br>
            <button><input type="submit" name="send" value="ログイン"></button><br>
        </form>
    </body>
</html>