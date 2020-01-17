<?php
// Check that all required fields have been passed to this page
if ( !isset($_POST['date']) || 
	empty($_POST['date']) || 
	!isset($_POST['day']) || 
	empty($_POST['day']) || 
	!isset($_POST['home_team']) || 
	empty($_POST['home_team']) || 
	!isset($_POST['away_team']) || 
	empty($_POST['away_team']) || 
	!isset($_POST['venue']) || 
	empty($_POST['venue']) ) {
	$error = "Please fill out all required fields.";
}
else {
	// Connect to the db
	$host = "303.itpwebdev.com";
	$user = "eunsooks_db_user";
	$pass = "uscItp2019";
	$db = "eunsooks_football_schedule_db";
	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}
	if( isset($_POST["day"]) && !empty($_POST["day"]) ) {
		// user entered a composer
		$day = $_POST["day"];
	}
	else {
		// user did not enter a composer, so set it to null
		$day = "null";
	}
	if( isset($_POST["home"]) && !empty($_POST["home"]) ) {
		// user entered bytes 
		$home = $_POST["home"];
	}
	else {
		// user did not enter bytes, so set it to null
		$home = "null";
	}
	if( isset($_POST["away"]) && !empty($_POST["away"]) ) {
		// user entered bytes 
		$away = $_POST["away"];
	}
	else {
		// user did not enter bytes, so set it to null
		$away = "null";
	}
	if( isset($_POST["venue"]) && !empty($_POST["venue"]) ) {
		// user entered bytes 
		$venue = $_POST["venue"];
	}
	else {
		// user did not enter bytes, so set it to null
		$venue = "null";
	}
	// SQL statement to INSERT new record into the DB.
	$sql = "INSERT INTO schedule (date, day_id, venue_id, away_team_id, home_team_id)
		VALUES (" . "'" . $_POST["date"] . "',"
		. $day
		. ", "
		. $_POST["venue"]
		. ", "
		. $_POST["away_team"]
		. ", "
		. $_POST["home_team"]
		.");";

	$results = $mysqli->query($sql);
	if( !$results) {
		echo $mysqli->error;
		exit();
	}
	// If record has been inserted, mysqli->affected_rows will return 1.
	$isInserted = "";
	if( $mysqli->affected_rows == 1 ) {
		$isInserted = true;
	}
	$mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Footaball Schedule</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a Football Game</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if(isset($error) && !empty($error)) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>


				<?php if(!(isset($error) && !empty($error))) : ?>
					<div class="text-success">
						Game was successfully added.
					</div>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>