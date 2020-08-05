<?php
require_once 'conf.php';

$link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die ("<p>Ошибка соединения</p>");
$query = "CREATE TABLE users 
		(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			login VARCHAR(200) NOT NULL UNIQUE,
			password VARCHAR(200) NOT NULL
		)";
$result = mysqli_query($link, $query) or die("<p>Ошибка создания таблицы</p>");
if ($result) {
	echo "<p>Создание таблицы прошло успешно</p>";
}
mysqli_close($link);
?>