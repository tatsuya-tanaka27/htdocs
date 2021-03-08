<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>php</title>
    </head>
    <body>
        <p><?php echo $_POST['name'];?></p>
        <figure>
            <img src="<?php echo $_POST['image'];?>" alt="<?php echo $_POST['title'];?>">
            <figcaption><?php echo $_POST['title'];?></figcaption >
        </figure>
    </body>
</html>