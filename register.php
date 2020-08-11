<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php require 'layouts/header.php'; ?>
	<form method="POST">
		<p>Логин: <input type="text" name="login" placeholder="Введите пароль"></p>
		<p>Пароль: <input type="password" name="password" placeholder="Введите пароль"></p>
		<p>Подтверждение пароля: <input type="password" name="c_password" placeholder="Подтвердите пароль"></p>
		<p><input type="submit" value="Зарегистрироваться"></p> 
	</form>
		<?php
		require_once 'models/user.php';
		echo "<h1>".$user."</h1>";
		if ($_POST['login'] && $_POST['password'] && $_POST['c_password'])
		{
			$result = registerUser(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['password']), htmlspecialchars($_POST['c_password']));
			if ($result[success]) {
				header("Location: auth.php");
			} else {
				echo "<h1 class='error'>" . $result[message] . "</h1>";
			}
		} else {
			echo "<p>Не все поля заполнены</p>";
		}
		?>
</body>
</html>