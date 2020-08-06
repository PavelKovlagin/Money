<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
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

		function authUser($login, $password) {
			$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE) or die ("<h1 class='error'>Ошибка соединения</h1>");
			$password = hash('sha256', $password);
			$query = "SELECT * FROM money.users WHERE login = '$login' AND password = '$password'";
			$resultAuth = mysqli_query($link, $query) or die("<h1 class='error'>Неправильный логин или пароль</h2>");
			mysqli_close($link);
			return $resultAuth;
		}

		function insertToken($user_id, $username) {
			$token = hash("sha256", $username . time());
			$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE) or die ("<h1 class='error'>Ошибка соединения</h1>");
			$query_insert = "INSERT INTO `money`.`tokens` (`token`, `user_id`) VALUES ('$token', '$user_id')";
			$result_insert = mysqli_query($link, $query_insert) or die("<h1 class='error'>Ошибка записи</h2>");
			mysqli_close($link);
			if ($result_insert) {
				setcookie("token", $token);
				//echo "<h1 class='success'>Успешная авторизация </h1>"; Раскомментировать в особом случае (особый случай = если вдруг припрет)	
				header("Location: index.php");
				exit;					
			} else {
				echo "<h1 class='error'>Что то пошло не так";
			}
		}
		
		if ($_POST['login'] && $_POST['password']) {
			$result = authUser($_POST['login'], $_POST['password']);			
			if ($result) {
				$rows = mysqli_num_rows($result);
				if ($rows > 0) {
					$row = mysqli_fetch_row($result);
					insertToken($row[0], $row[1]); //row[0] is user_id; row[1] is username		
				} else {
					echo "<h1 class='error'>Неправильный логин или пароль</h1>";
				}
			} else {
				echo "<h1 class='error'>Ошибка запроса</h1>";
			}
		} else {			
			echo "<p class='error'>Заполните поля</p>";
		}		
	?>
</body>
</html>