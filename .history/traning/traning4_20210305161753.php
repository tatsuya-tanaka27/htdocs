<php 
    if(isset($_GET[‘comment’])){
        $comment = $_GET[‘comment’];
echo $comment;
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>php</title>
    </head>
    <body>
        <form method="post" action="traning2.php">
            <input type="text" name="val">
            <button><input type="submit" name="send" value="送信"></button>
        </form>
        <p></p>
    </body>
</html>