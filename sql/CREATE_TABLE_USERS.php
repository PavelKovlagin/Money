<!DOCTYPE html>
<html>
<head>
	<title>Create table users</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<?php
	require_once 'conf.php';

	$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE) or die ("<h1 class='error'>Ошибка соединения users</h1>");
	$query = "CREATE TABLE users 
			(
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				login VARCHAR(200) NOT NULL UNIQUE,
				password VARCHAR(200) NOT NULL
			)";
	$result = mysqli_query($link, $query) or die("<h1 class='error'>Ошибка создания таблицы money</h1>");
	if ($result) {
		echo "<h1 class='success'>Создание таблицы users прошло успешно</h1>";
	}
	mysqli_close($link);	
?>
</body>
</html>
