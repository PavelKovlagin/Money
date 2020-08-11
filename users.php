<?php
require_once 'layouts/header.php';
echo "<h1>Пользователи</h1>";	
require_once 'models/user.php';	

$users = selectUsers();
if (count($users[data] > 0)){
	echo "<table border=2px>";
	echo "<tr><td>Логин</td><td>Пароль</td></tr>";
	foreach ($users[data] as $key => $user) {
		echo "<tr>";
		echo "<td>" . htmlspecialchars($user[1]) . "</td>";
		echo "<td>" . htmlspecialchars($user[2]) . "</td>";
		echo "</tr>";
	}
	echo "</table>";	
} else {
	echo "<h1>Пользователей нет</h1>";
}
?>