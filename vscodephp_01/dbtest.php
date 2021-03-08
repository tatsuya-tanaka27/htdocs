<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>MariaDBへの接続テスト</title>
</head>

<body>

    <?php

    $dsn = 'mysql:dbname=kakeibodb;host=localhost;port=3307;';
    $user = 'root';
    $password = 'password';

    try {
        $dbh = new PDO($dsn, $user, $password);

        $sql = 'select * from kakeibo_user';
        foreach ($dbh->query($sql) as $row) {
            print($row['id'] . ',');
            print($row['name']);
            print('<br />');
        }
    } catch (PDOException $e) {
        print('Error:' . $e->getMessage());
        die();
    }

    $dbh = null;

    ?>

</body>

</html>