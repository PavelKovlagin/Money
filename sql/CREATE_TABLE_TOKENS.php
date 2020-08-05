<?php
require_once 'conf.php';

$link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die ("<p>Ошибка соединения</p>");
$query = "CREATE TABLE tokens 
		(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			token VARCHAR(200) NOT NULL UNIQUE,
			user_id INT,
			FOREIGN KEY (user_id) REFERENCES users (id)
		)";
$result = mysqli_query($link, $query) or die("<p>Ошибка создания таблицы tokens</p>");
if ($result) {
	echo "<p>Создание таблицы tokens прошло успешно</p>";
}
mysqli_close($link);
?>