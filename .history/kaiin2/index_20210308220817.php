<?php
session_start();

$array = array("ユーザーID","メールアドレス","パスワード","性別","電話番号","生まれた年");
$num = 0;

var

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TOP</title>
        <style>
            th {
                border: 1px solid black;
            }
            td {
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
                    <th><?php echo $array[$num] ?></td>
                    <td><?php echo $value ?></td>
                </tr>
            <?php 
                $num++;    
            } 
            ?>
        </table>
        <a href="update.php">変更</a>
        <a href="delete.php">退会</a>
        <a href="login.php">ログアウト</a>
    </body>
</html>