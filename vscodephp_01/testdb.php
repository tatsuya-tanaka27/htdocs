<html>

<head>
    <title>PHP TEST</title>
</head>

<body>

    <?php

    $dsn = 'mysql:dbname=kakeibodb;host=localhost;port=3307;';
    $user = 'root';
    $password = 'password';

    try {
        $dbh = new PDO($dsn, $user, $password);

        print('<br>');

        if ($dbh == null) {
            print('接続に失敗しました。<br>');
        } else {
            print('接続に成功しました。<br>');
        }
    } catch (PDOException $e) {
        print('Error:' . $e->getMessage());
        die();
    }

    $dbh = null;

    ?>

</body>

</html>