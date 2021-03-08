<?php 

    // 保存先フォルダ
    $storeDir = '../images/';

    // ファイルアップロードのエラーチェック
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        exit('アップロードが失敗しました');
    } else {
        // 保存先にファイルが存在するかをチェック
        if (file_exists($storeDir.$_FILES['image']['name'])) {
            // ファイルが存在したら、ファイル名を付けて存在していると表示
            echo $_FILES['image']['name'] . 'は既に存在します。';
        } else {
            // ファイルが存在していなかったら、保存する
            echo $_FILES['image']['name'] . 'を保存しました。';
            move_uploaded_file($_FILES['image']['tmp_name'], $storeDir.$_FILES['image']['name']);
        }            
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>php</title>
    </head>
    <body>
        <img src="<?php echo $storeDir.$_FILES['image']['name'];?>">
    </body>
</html>