<?php
session_start();

$array
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TOP</title>
        <style>
            table td{
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <p>下記のユーザーでログイン中</p>
        <?php echo $_SESSION['name']; ?>
        <p>ユーザー情報</p>
        <table>
            <?php foreach ($_SESSION['user_data'] as $value) {?>
                <tr>
                    <td><?php echo $value ?></td>
                </tr>
            <?php } ?>
        </table>
        <a href="update.php">変更</a>
        <a href="delete.php">退会</a>
        <a href="login.php">ログアウト</a>
    </body>
</html>