<?php
session_start();
require 'config/config.php';
$isUpdated = false;
if ( !isset($_POST['menu']) || empty($_POST['menu']) || !isset($_POST['day_id']) || empty($_POST['day_id']) || !isset($_POST['time_id']) || empty($_POST['time_id'])) {
	// Missing required fields.
	$_SESSION["error"] = "Please fill out all required fields.";
	header("Location: ../final_project/home.php");
} else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}
	
	$sql_prepared = "INSERT INTO calendar (username, menu, dayID, timeID) VALUES (?,?,?,?);";

	$statement = $mysqli->prepare($sql_prepared);
	// First parameter is data types, the rest are variables that will fill in the ? placeholders
	$statement->bind_param("ssii", $_SESSION["username"], $_POST['menu'], $_POST['day_id'], $_POST['time_id']);

	$executed = $statement->execute();
	// execute() will return false if there's an error
	if(!$executed) {
		echo $mysqli->error;
	}
	// affected_rows returns how many records were affected (updated/deleted/inserted)
	if( $statement->affected_rows == 1 ) {
		$isUpdated = true;
	}
	$statement->close();

	$mysqli->close();
	header("Location: ../final_project/profile.php");
}
?>