<?php
session_start();
require "db.php";
require "check.php";

if (!empty($_POST['id']) && !empty($_POST['password'])) {
    $_SESSION["id"] = $_POST["id"];
    $_SESSION["password"] = $_POST["password"];
    $data = userSelect($_POST["id"]);
    if (checkData($data)) {
        $_SESSION["id"] = $data["id"];
        $_SESSION["name"] = $data["name"];
        header("Location: index.php");
    } else {
        echo "存在しないIDです";
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>

<body>
    <h1>ようこそ、ログインしてください。</h1>
    <form action="login.php" method="post">
        <label for="id">ID</label>
        <input type="text" name="id">
        <label for="password">password</label>
        <input type="password" name="password">
        <button type="submit">Sign In!</button>
    </form>
</body>

</html>