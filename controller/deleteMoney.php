<?php
	require_once '../models/money.php';
	session_start();
	echo var_dump($_POST);
	if ($_POST && ($user_id = $_POST['user_id']) && ($value = $_POST['value'])) {
		$result = deleteMoney($user_id, $value);
		$_SESSION["message"] = array(success=>true, message=>$result[message]);
		header("Location: ../money.php");
	} else {
		$_SESSION["message"] = array(success=>false, message=>"Что то пошло не так");
		header("Location: ../money.php");
	}
?>