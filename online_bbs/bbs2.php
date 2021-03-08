<?php

// データベースに接続
$mysqli  = new mysqli('localhost', 'root', 'password', 'test');
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    die('データベースに接続できません：');
}

$mysqli->set_charset('utf8mb4');
$errors = array();

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 名前が正しく入力されているかをチェック
    $name = null;
    if (!isset($_POST['name']) || !strlen($_POST['name'])) {
        $errors['name'] = '名前を入力してください';
    } else if (strlen($_POST['name']) > 40) {
        $errors['name'] = '名前は40文字以内で入力してください';
    } else {
        $name = $_POST['name'];
    }

    // ひとことが正しく入力されているかチェック
    $comment = null;
    if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
        $errors['comment'] = 'ひとことを入力してください';
    } else if (strlen($_POST['comment']) > 40) {
        $errors['comment'] = 'ひとことは200文字以内で入力してください';
    } else {
        $comment = $_POST['comment'];
    }

    $dbName = 'post';
    $esName = $mysqli->real_escape_string($name);
    $esCome = $mysqli->real_escape_string(nl2br($comment));
    $sqlDate = date('Y-m-d H:i;s');

    // エラーがなければ保存
    if (count($errors) === 0) {
        // 保存するためのSQL文を作成
        $sql = "INSERT INTO post (name, comment, created_at) VALUES(?, ?, ?);";
        $stmt = mysqli_prepare($mysqli , $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $esName, $esCome, $sqlDate);
        // 保存する
        mysqli_stmt_execute($stmt);
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <title>ひとこと掲示板</title>
</head>

<body>
    <h1>ひとこと掲示板</h1>

    <form action="bbs2.php" method="post">
        名前：<input type="text" name="name" /><br /><br />
        ひとこと：<textarea name="comment" style="height:100px"></textarea><br />
        <input type="submit" name="submit" value="送信" />
    </form>

    <?php
    // 投稿された内容を取得するSQLを作成して結果を取得
    $sql = "SELECT * FROM post ORDER BY created_at DESC";

    // データベースに接続
    $result = $mysqli->query($sql);
    ?>

    <?php if ($result !== false && mysqli_num_rows($result)) : ?>
        <ul>
            <?php while ($post = mysqli_fetch_assoc($result)) : ?>
                <li>
                    <?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); ?>
                    <?php echo $post['comment']; ?>
                    - <?php echo htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8'); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>

    <?php
    // 取得結果を開放して接続を閉じる
    mysqli_free_result($result);
    $mysqli->close();
    ?>

</body>

</html>