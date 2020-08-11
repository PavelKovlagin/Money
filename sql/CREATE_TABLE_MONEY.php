
<!DOCTYPE html>
<html>
<head>
	<title>Create table money</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<?php
	require_once 'conf.php';

	$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE) or die ("<h1 class='error'>Ошибка соединения</h1>");
	$query = "CREATE TABLE money 
			(
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				value INT NOT NULL,
				quanity INT NOT NULL,
				user_id INT,
				FOREIGN KEY (user_id) REFERENCES users (id)
			)";
	$result = mysqli_query($link, $query) or die("<h1 class='error'>Ошибка создания таблицы money</h1>");
	if ($result) {
		echo "<h1 class='success'>Создание таблицы tokens прошло успешно</h1S>";
	}

	mysqli_close($link);
?>
</body>
</html>