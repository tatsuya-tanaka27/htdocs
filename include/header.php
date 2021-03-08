<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
<?php
	foreach($css as $value):
?>
	<link rel="stylesheet" href="<?php echo $value ?>">
<?php
	endforeach;
?>
</head>
<body>
	<header>ヘッダー</header>
	<nav>ナビゲーション</nav>
