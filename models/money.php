<?php	
	if (!include_once 'sql/conf.php') {
		include_once '../sql/conf.php';
	}	

	function selectUserMoney($user_id) {
		try {
			if (!$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) return array(success=>false, message=>"Connection failed");
			$query = "SELECT value, quanity FROM money.money WHERE user_id = '$user_id'";
			if (!$result = mysqli_query($link, $query)) return array(success=>false, message=>"Select failed");
			if (mysqli_num_rows($result) <= 0) return array(success=>false, message=>"Empty array");
			while ($row = mysqli_fetch_row($result)) {
				$rows[] = $row;
			}
			return array(success=>true, message=>"Success", data=>$rows);
		} finally {
			mysqli_close($link);
		}		
	}	

	function selectUserMoneyValue($user_id, $value) {
		try {
			if (!$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) return array(success=>false, message=>"Ошибка соединения");
			$query = "SELECT value, quanity FROM money.money WHERE user_id = '$user_id' AND value = '$value'";
			if (!$result = mysqli_query($link, $query)) return array(success=>false, message=>"Ошибка запроса");
			if (mysqli_num_rows($result) <= 0) return array(success=>false, message=>"Empty");
			return array(success=>true, message=>"Success", data=>mysqli_fetch_row($result));
		} finally {
			mysqli_close($link);
		}
	}

	function insertMoney($user_id, $value, $quanity) {
		try {
			if (!$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) return array(success=>false, message=>"Ошибка соединения");
			$query = "INSERT INTO `money`.`money` (`user_id`, `value`, `quanity`) VALUES ('$user_id', '$value', '$quanity')";
			if (!$result = mysqli_query($link, $query)) return array(success=>false, message=>"Ошибка записи");
			return array(success=>true, message=>"Insert success");
		} finally {
			mysqli_close($link);	
		}	
	}

	function updateMoney($user_id, $value, $quanity) {
		try {
			if (!$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) return array(success=>false, message=>"Connection failed");
			$query = "UPDATE `money`.`money` SET quanity = $quanity WHERE value = $value AND user_id = $user_id";
			if (!$result = mysqli_query($link, $query)) return array(success=>false, message=>"Update failed");
			return array(success=>true, message=>"Update success");	
		} finally {
			mysqli_close($link);
		}
	}
	function deleteMoney($user_id, $value) {
		try {
			if (!$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) return array(success=>false, message=>"Connection failed");
			$query = "DELETE FROM `money`.`money` WHERE user_id = $user_id AND value = $value";
			if (!$result = mysqli_query($link, $query)) return array(success=>false, message=>"Delete failed");
			return array(success=>true, message=>"Delete success");
		} finally {
			mysqli_close($link);
		}
	}
?>