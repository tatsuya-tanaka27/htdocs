<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>MariaDBへの接続テスト</title>
</head>

<body>

    <?php

    function userSelect($id)
    {

        $dsn = 'mysql:dbname=test;host=localhost;port=3307;';
        $user = 'root';
        $password = 'password';

        try {
            $dbh = new PDO($dsn, $user, $password);
            $sql = 'select * from user where id = ' . '"' . $id . '"';
            foreach ($dbh->query($sql) as $row) {
                return $row;
            }
            return null;
        } catch (PDOException $e) {
            print('Error:' . $e->getMessage());
            die();
        }

        $dbh = null;
    }
    ?>

</body>

</html>