<?php
	require_once '../models/money.php';
	session_start();
	if (($user_id = $_POST['user_id']) && ($value = $_POST['value']) && ($quanity = $_POST['quanity'])) {
		//echo $user_id . " " . $value . " " . $quanity;;
		if (selectUserMoneyValue($user_id, $value)[success]) {
			$result = updateMoney($user_id, $value, $quanity);
			//echo "UPDATE " . $user_id . " " . $value; 
		} else {
			//echo "INSERT "  . $user_id . " " . $value;
			$result = insertMoney($user_id, $value, $quanity);
		}
		$_SESSION["message"] = array(success=>true, message=>$result[message]);
		//echo var_dump($result);
		header("Location: ../money.php");
	} else {
		$_SESSION["message"] = array(success=>false, message=>"Fill in the fields");
		header("Location: ../money.php");
	}
?>