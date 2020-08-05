<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Money</title>
</head>
<body>
	<h1>Your money is here</h1>
	<a href="auth.php">Auth</a>
	<a href="register.php">Register</a>
	<a href="sql/selectUsers.php">Users</a>
	<?php
		require_once 'sql/conf.php';
		if ($_COOKIE["token"]){
			$token = $_COOKIE["token"];
			$link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die ("<p>Ошибка соединения</p>");
			$query = "SELECT * FROM money.users, money.tokens WHERE users.id = user_id AND token = '$token'";
			$result = mysqli_query($link, $query);
			if ($result) {
				$rows = mysqli_num_rows($result);
				if ($rows > 0) {
					$row = mysqli_fetch_row($result);
					echo "<h1>Добро пожаловать " . $row[1] . " </h1>"; 
				} else {
					echo "<h1>Ничего нет</h2>";
				}
			} else {
				echo "<h1>Ошибка запроса</h1>";
			}
		} else {
			echo "<h1>Надо бы авторизоваться</h2>";
		}		
	?>
</body>
</html>