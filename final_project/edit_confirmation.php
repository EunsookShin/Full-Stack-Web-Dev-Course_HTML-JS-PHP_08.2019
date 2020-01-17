<?php
	session_start();
	require "config/config.php";
	$isUpdated = false;

	// Make sure required fields are set
	if ( !isset($_POST['menu']) || empty($_POST['menu']) ) {
		$_SESSION['$edit_error'] = "Please fill out the menu.";
		header("Location: ../final_project/edit.php?calendarID=".$_POST["calendarID"]);
	}
	else {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}
		// Using prepared statements instead (to prevent SQL injections)
		$sql_prepared = "UPDATE calendar SET menu = ? WHERE calendarID = ?;";

		$statement = $mysqli->prepare($sql_prepared);

		// First parameter is data types, the rest are variables that will fill in the ? placeholders
		$statement->bind_param("si", $_POST["menu"], $_POST["calendarID"]);
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
		$_SESSION['$edit_error'] = "";
		header("Location: ../final_project/profile.php");
	}
?>