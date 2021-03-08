<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TOP</title>
    </head>
    <body>
        <p>下記のユーザーでログイン中</p>
        <?php echo $_SESSION['name']; ?>
        <p>ユーザー情報</p>
        <table>
            <?php
            <tr></tr>
        </table>
        $_SESSION['mail'] = $result['mail'];
                    $_SESSION['pass'] = $result['pass'];
                    $_SESSION['sex'] = $result['sex'];
                    $_SESSION['tel'] = $result['tel'];
                    $_SESSION['birth'] = $result['birth'];
    </body>
</html>