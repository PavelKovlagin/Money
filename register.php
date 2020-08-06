<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
</head>
<body>
	<form method="POST">
		<p>Логин: <input type="text" name="login" placeholder="Введите пароль"></p>
		<p>Пароль: <input type="password" name="password" placeholder="Введите пароль"></p>
		<p>Подтверждение пароля: <input type="password" name="c_password" placeholder="Подтвердите пароль"></p>
		<p><input type="submit" value="Зарегистрироваться"></p> 
	</form>
		<?php
		require_once 'sql/conf.php';
		echo "<h1>".$user."</h1>";
		if ($_POST['login'] && $_POST['password'] && $_POST['c_password'])
		{
			$login = $_POST['login'];
			$password = $_POST['password'];
			$c_password = $_POST['c_password'];
			if ($password == $c_password) {
				$password = hash("sha256", $password);
				$c_password = hash("sha256", $c_password);
				$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE) or die ("<h1 class='error'>Ошибка соединения</h1>");
				$query = "INSERT INTO `money`.`users` (`login`, `password`) VALUES ('$login', '$password')";
				$result = mysqli_query($link, $query);
				mysqli_close($link);
				if ($result) {
					echo "<h1>Пользователь зарегистрирован</h1>";
				} else {
					echo "<h1>Ошибка регистрации</h1>";
				}
			} else {
				echo "<p>Пароли не совпадают</p>";
			}
		} else {
			echo "<p>Не все поля заполнены</p>";
		}
		?>
</body>
</html>