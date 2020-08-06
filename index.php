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
			function selectUser($token) {
				$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE) or die ("<h1 class='error'>Ошибка соединения</h1>");
				$query = "SELECT * FROM money.users, money.tokens WHERE users.id = user_id AND token = '$token'";
				$result = mysqli_query($link, $query) or die ("<h1>Ошибка запроса</h1");
				mysqli_close($link);
				return $result;
			}	
			$result = selectUser($_COOKIE['token']);		
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