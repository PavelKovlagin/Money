<?php
	require_once "sql/conf.php";
	 function selectUser($token) {
		try {
			if (!$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) return  array(success=>false, message=>"Ошибка соединения");
			$query = "SELECT * FROM money.users, money.tokens WHERE users.id = user_id AND token = '$token'";
			if (!$result = mysqli_query($link, $query)) return array(success=>false, "Ошибка запроса");
			if (mysqli_num_rows($result) <= 0) return array(success=>false, message=>"Пользователь не найден");
			return array(success=>true, data=>mysqli_fetch_row($result));	
		} finally {
			mysqli_close($link);
		}	
	}	

	function selectUsers() {
		try {
			if (!$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) return array(success=>false, message=>"Ошибка соединения");
		 	$query = "SELECT * FROM money.users";
		 	if (!$result = mysqli_query($link, $query)) return array(success=>false, message=>"Ошибка запроса");	
		 	if (mysqli_num_rows($result) <= 0) return array(success=>false, message=>"Not users");
		 	while ($row = mysqli_fetch_row($result)) {
		 		$rows[] = $row;
		 	}
			return array(success=>true, message=>"Удачно", data=>$rows);
		} finally {
			mysqli_close($link);
		}
	}

	function authUser($login, $password) {
		try {
			if (!$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) return array(success=>false, message=>"Ошиька соединения");
			$password = hash('sha256', $password);
			$query_select = "SELECT id, login, password FROM money.users WHERE login = '$login' AND password = '$password'";
			if (!$result_select = mysqli_query($link, $query_select)) return array(success=>false, message=>"Ошибка запроса");
			if (mysqli_num_rows($result_select) <= 0) return array (success=>false, message=>"Неверный логин или пароль");
			$user_id = mysqli_fetch_row($result_select)[0];
			$token = hash("sha256", $username . time());
			$query_insert = "INSERT INTO `money`.`tokens` (`token`, `user_id`) VALUES ('$token', '$user_id')";
			if (!$result_insert = mysqli_query($link, $query_insert)) return array(success=>false, message=>"Ошибка записи токена");	
			setcookie("token", $token);
			return array(success=>true, message=>"Пользователь авторизован");
		} finally {
			mysqli_close($link);
		}		
		return $resultAuth;
	}

	function registerUser($login, $password, $c_password) {
		try {
			if ($password !== $c_password) return array(success=>false, message=>"Пароли не совпадают"); 		
			if (!$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) return array(success=>false, message=>"Ошибка соединения");
			$password = hash("sha256", $password);
			$query = "INSERT INTO `money`.`users` (`login`, `password`) VALUES ('$login', '$password')";
			if (!$result = mysqli_query($link, $query)) return array(success=>false, message=>"Пользователь уже существует");
			return array(success=>true, message=>"Пользователь зарегистрирован");
		} finally {
			mysqli_close($link);
		}
	
	}
?>