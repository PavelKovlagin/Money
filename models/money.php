<?php	
	if (!include_once 'sql/conf.php') {
		include_once '../sql/conf.php';
	}	

	function selectUserMoney($user_id) {
		try {
			if (!$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) return array(success=>false, message=>"Ошибка соединения");
			$query = "SELECT value, quanity FROM money.users, money.money WHERE users.id = money.user_id AND money.user_id = '$user_id'";
			if (!$result = mysqli_query($link, $query)) return array(success=>false, message=>"Ошибка запроса");
			while ($row = mysqli_fetch_row($result)) {
				$rows[] = $row;
			}
			return array(success=>true, message=>"Удачно", data=>$rows);
		} finally {
			mysqli_close($link);
		}		
	}	

	function insertMoney($user_id, $value, $quanity) {
		$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE) or die ("<h1 class='error'>Ошибка соединения</h1>");
		$query = "INSERT INTO `money`.`money` (`user_id`, `value`, `quanity`) VALUES ('$user_id', '$value', '$quanity')";
		$result = mysqli_query($link, $query) or die ("<h1 class='error'>Ошибка записи</h1");
		mysqli_close($link);
		return $result;
	}
?>