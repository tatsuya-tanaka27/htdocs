<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TOP</title>
    </head>
    <body>
        <p></p>
        <?php echo $_SESSION['name']; ?>
    </body>
</html>