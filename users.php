<?php
require_once 'layouts/header.php';
echo "<h1>Пользователи</h1>";	
require_once 'models/user.php';	

$users = selectUsers();
echo var_dump($users);
if ($users[success]){
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
	echo "<h1>" . $users[message] . "</h1>";
}
?>