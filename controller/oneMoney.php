<?php
	if ($_POST && ($value = $_POST["value"]) && ($quanity = $_POST["quanity"])) {
		echo  $quanity  . " " . $value;
	} else {
		echo "NOPE";
	}
?>