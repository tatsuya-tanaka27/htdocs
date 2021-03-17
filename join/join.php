<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>結合</title>
</head>
<body>
<?php
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=join;charset=utf8','root','',
		array(PDO::ATTR_EMULATE_PREPARES => false));
	}
	catch (PDOException $e) {
	 die('データベース接続失敗。'.$e->getMessage());
	}

	$sql="SELECT * FROM `name` JOIN `kanri`";
	$result=$pdo->query($sql);
?>
	<table>
		<tr><td>商品ID</td><td>商品名</td><td>単価</td><td>数量</td></tr>
<?php
	foreach($result as $value):
?>
		<tr>
			<td><?php echo $value["id"]; ?></td>
			<td><?php echo $value["name"]; ?></td>
			<td><?php echo $value["tanka"]; ?></td>
			<td><?php echo $value["suuryou"]; ?></td>
		</tr>
<?php endforeach; ?>
	</table>
</body>
</html>