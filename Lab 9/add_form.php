<?php

$host = "303.itpwebdev.com";
	$user = "eunsooks_db_user";
	$pass = "uscItp2019";
	$db = "eunsooks_football_schedule_db";

// DB Connection.
$mysqli = new mysqli($host, $user, $pass, $db);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');
// days:
$sql_days = "SELECT * FROM days;";
$results_days = $mysqli->query($sql_days);
if ( $results_days == false ) {
	echo $mysqli->error;
	exit();
}
// home:
$sql_home = "SELECT * FROM teams AS home_team;";
$results_home = $mysqli->query($sql_home);
if ( $results_home == false ) {
	echo $mysqli->error;
	exit();
}

// away:
$sql_away = "SELECT * FROM teams AS away_team;";
$results_away = $mysqli->query($sql_away);
if ( $results_away == false ) {
	echo $mysqli->error;
	exit();
}

// venues:
$sql_venues = "SELECT * FROM venues;";
$results_venues = $mysqli->query($sql_venues);
if ( $results_venues == false ) {
	echo $mysqli->error;
	exit();
}

// Close DB Connection
$mysqli->close();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Form | Footaball Schedule</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item active">Add</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Add a Football Game</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="add_confirmation.php" method="POST">

			<div class="form-group row">
				<label for="home_team" class="col-sm-3 col-form-label text-sm-right">
					Home Team: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<select name="home_team" id="home_team" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- TODO: Display teams  -->
						<?php while ( $row = $results_home->fetch_assoc() ) : ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['team']; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="away_team" class="col-sm-3 col-form-label text-sm-right">
					Away Team: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<select name="away_team" id="away_team" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- TODO: Display teams  -->
						<?php while ( $row = $results_away->fetch_assoc() ) : ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['team']; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="venue" class="col-sm-3 col-form-label text-sm-right">
					Venue: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<select name="venue" id="venue" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- TODO: Display venues -->
						<?php while ( $row = $results_venues->fetch_assoc() ) : ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['venue']; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="day" class="col-sm-3 col-form-label text-sm-right">
					Day: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<select name="day" id="day" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- TODO: Display days -->
						<?php while ( $row = $results_days->fetch_assoc() ) : ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['day']; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="date" class="col-sm-3 col-form-label text-sm-right">
					Date: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<input type="date" class="form-control" id="date" name="date">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Add</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>