<?php
session_start();

$array = array("ユーザーID","メールアドレス","パスワード","性別","生まれた年""電話番号");
$num = 0;

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