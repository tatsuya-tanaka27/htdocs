<?php



?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログイン</title>
    </head>
    <body>
        <form method="post" action="login.php">
            <span>ログインネーム</span><input type="text" name="name"><br>
            <span>ログインパスワード</span><input type="text" name="pass"><br>
            <button><input type="submit" name="send" value="ログイン"></button><br>
            <a href="registration.php">新規登録会員はこちら</a>
        </form>
    </body>
</html>