<?php
echo "<h1>Пользователи</h1>";	
 require_once 'conf.php';
 $link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die("<p>Что то пошло не так</p>");
 $query = "SELECT * FROM users";
 $result = mysqli_query($link, $query) or die ("<p>Ошибка запроса</p>");
 if ($result) {
 	$rows = mysqli_num_rows($result);
 	echo "<table border=2px>";
 	echo "<tr><td>Логин</td><td>Пароль</td></tr>";
 	for ($i = 0; $i < $rows; $i++) {
 		$row = mysqli_fetch_row($result);
 		echo "<tr>";
 		echo "<td>" . $row[1] . "</td>";
 		echo "<td>" . $row[2] . "</td>";
 		echo "</tr>";
 	} 
 	echo "</table>";
 } else {
 	echo "<p>Ошибка запроса</p>";
 }
 mysqli_close($link);
?>