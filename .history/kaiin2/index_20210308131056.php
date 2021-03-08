<?php
session_start();
var_dump($_SESSION['user_data']);
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TOP</title>
        <style>
            table {
                border 1px solid black;
            }
        </style>
    </head>
    <body>
        <p>下記のユーザーでログイン中</p>
        <?php echo $_SESSION['name']; ?>
        <p>ユーザー情報</p>
        <table>
                <tr>
                    <td><?php echo $value ?></td>
            </tr>
        </table>
    </body>
</html>