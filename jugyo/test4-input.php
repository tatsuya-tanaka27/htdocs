<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>php</title>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data" action="test4-confirm.php">
            <span>名前：</span><input type="text" name="name"><br>
            <span>タイトル：</span><input type="text" name="title"><br>
            <span>アップロード画像：</span><input type="file" name="image"><br>
            <button><input type="submit" name="confirm" value="確認"></button>
        </form>
    </body>
</html>