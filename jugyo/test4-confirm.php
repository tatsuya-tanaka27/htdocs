<?php 

    // 保存先フォルダ
    $storeDir = '../images/';

    if(empty($_POST['name']) || empty($_POST['title'])){
        exit('名前とタイトルを入力してください。');
    }

    // ファイルアップロードのエラーチェック
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        exit('画像アップロードが失敗しました');
    } else {
        // 保存先にファイルが存在するかをチェック
        if (file_exists($storeDir.$_FILES['image']['name'])) {
            // ファイルが存在したら、ファイル名を付けて存在していると表示
            exit($_FILES['image']['name'] . 'は既に存在します。');
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
        <p><?php echo $_POST['name'];?></p>
        <figure>
            <img src="<?php echo $storeDir.$_FILES['image']['name'];?>" alt="<?php echo $_POST['title'];?>">
            <figcaption><?php echo $_POST['title'];?></figcaption >
        </figure>
        <form method="post" enctype="multipart/form-data" action="test4-end.php">
            <input type="hidden" name="name" value="<?php echo $_POST['name'];?>"><br>
            <input type="hidden" name="title" value="<?php echo $_POST['title'];?>"><br>
            <input type="hidden" name="image" value="<?php echo $storeDir.$_FILES['image']['name'];?>"><br>
            <button><input type="submit" name="end" value="送信"></button>
            <button><input type="submit" name="back" value="戻る"></button>
        </form>
    </body>
</html>