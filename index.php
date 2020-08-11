<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Money</title>
</head>
<body>
	<?php require_once 'layouts/header.php'; ?>
	<h1>Your money is here</h1>
	<?php
		require_once 'models/user.php';
		if ($_COOKIE["token"]){
			$user = selectUser($_COOKIE['token']);	
			if (count($user) > 0) {
				echo "<h1 class='success'>Добро пожаловать " . $user[data][1] . " </h1>"; 
			} else {
				echo "<h1 class='error'>Ничего нет</h2>";
			}	
		} else {
			echo "<h1 class='error'>Чтобы использовать приложение необходимо авторизоваться</h2>";
		}		
	?>
</body>
</html>