<!DOCTYPE html>
<html>
<head>
	<title>Money</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
	require_once 'layouts/header.php';
	require_once 'models/money.php';
	require_once 'models/user.php';
	session_start();
	if ($message = $_SESSION["message"]) {
		if ($message[success]) {
			echo "<h1 class='success'>" . $message[message] . "</h1>";
		} else {
			echo "<h1 class='error'>" . $message[message] . "</h1>";
		}
		$_SESSION["message"] = "";
	}
	$authUser = selectUser($_COOKIE['token']);
	if ($authUser[success]) {
		echo "<h1>Hello " . $authUser[data][1] . ". Your money is here!!!</h1>";
?>
	<form action="controller/insertMoney.php" method="POST">
		<input type="hidden" name="user_id" value="<?php echo $authUser[data][0] ?>">
		<input type="number" name="value">
		<input type="number" name="quanity">
		<input type="submit">
	</form>	
<?php  
		$money = selectUserMoney($authUser[data][0]);
		if (!$money[success]) {
			echo "<h1>".$money[message]."</h1>";
		} else {
			$sum = 0;
			echo "<table border=2px>";
			echo "<tr><td>Номинал</td><td>Количество</td></tr>";
			foreach ($money[data] as $key => $value) {
				$row = mysqli_fetch_row($money);
				echo "<form action='controller/deleteMoney.php' method='POST'>";
				echo "<input type='hidden' name='value' value=" . $value[0]. ">";
				echo "<input type='hidden' name='user_id' value=" . $authUser[data][0] . ">";
				echo "<tr><td>" . $value[0] . "</td><td>" . $value[1] . "</input></td><td><input type='submit' value='Удалить'></td></tr>";
				echo "</form>";
				$sum += $value[0] * $value[1];
			}
			echo "</table>";
			echo "<h1>Всего: " . $sum . "</h1>";
		}
	} else {
		echo "<h1 class='error'>" . $authUser[message] . "</h1>";
	}
?>
</body>
</html>