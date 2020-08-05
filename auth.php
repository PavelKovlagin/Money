<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Auth</title>
</head>
<body>
	<form method="POST">
		<input type="text" name="login" placeholder="Введите логин">
		<input type="password" name="password" placeholder="Введите пароль">	
		<input type="submit" value="Авторизоваться">	
	</form>
	<?php
		require_once "sql/conf.php";
		if ($_POST['login'] && $_POST['password']) {
			$login = $_POST['login'];
			$password = hash("sha256", $_POST['password']);
			$link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die ("<p>Ошибка соединения</p>");
			$query = "SELECT * FROM money.users WHERE login = '$login' AND password = '$password'";
			$result = mysqli_query($link, $query);
			if ($result) {
				$rows = mysqli_num_rows($result);
				if ($rows > 0) {
					$row = mysqli_fetch_row($result);
					$user_id = $row[0];
					$username = $row[1];
					$token = hash("sha256", $username . time());
					$query_insert = "INSERT INTO `money`.`tokens` (`token`, `user_id`) VALUES ('$token', '$user_id')";
					$result_insert = mysqli_query($link, $query_insert);
					if ($result_insert) {
						echo "<p>" . $user_id . " " . $username . "</p>";
						setcookie("token", $token);
						echo "<h1>Успешная авторизация </h1>";						
						echo "<h2> Token: " . $token . "</h2>";
					} else {
						echo "Что то пошло не так";
					}	
					
				} else {
					echo "<h1>Неправильный логин или пароль</h1>";
				}
			} else {
				echo "<h1>Ошибка запроса</h1>";
			}
		} else {
			
			echo "<p>Заполните поля</p>";
		}		
	?>
</body>
</html>