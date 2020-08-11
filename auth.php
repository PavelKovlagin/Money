<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Auth</title>
</head>
<body>
	<?php require_once 'layouts/header.php'; ?>
	<h1> Авторизация </h1>
	<form method="POST">
		<input type="text" name="login" placeholder="Введите логин">
		<input type="password" name="password" placeholder="Введите пароль">	
		<input type="submit" value="Авторизоваться">	
	</form>
	<?php		
		require_once "models/user.php";
		if ($_POST['login'] && $_POST['password']) {
			$result = authUser($_POST['login'], $_POST['password']);
			if ($result[success]) {
				header("Location: index.php");
			} else {
				echo "<h1 class='error'>".$result[message]."</h1>";
			}		
		} else {			
			echo "<p class='error'>Заполните поля</p>";
		}		
	?>
</body>
</html>