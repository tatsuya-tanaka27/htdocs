<?php
session_start();

$array = array("ユーザーID","メールアドレス","名前","パスワード","性別","郵便番号","電話番号");
$num = 0;

// POSTなら更新処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //ユーザー更新
        try {
                $pdo = new PDO($_SESSION['dsn'], $_SESSION['duser'], $_SESSION['dpass']);
                $stmt = $pdo->prepare('delete from kaiin3 where id=:id');
                $stmt->bindValue(":id", $_SESSION['user_data']['id'], PDO::PARAM_INT);
                $stmt->execute();
                session_destroy();
                // リダイレクトを実行
	            header( "Location: login.php" );

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
        <form method="post" action="delete.php">
            <button><input type="submit" name="delete" value="削除"></button><br>
        </form>
    </body>
</html>