<?php

	// TODO: Establish DB connection, submit SQL query here. Remember to check for any MySQLi errors.
	$host = "303.itpwebdev.com";
	$user = "eunsooks_db_user";
	$pass = "uscItp2019";
	$db = "eunsooks_football_schedule_db";

	// connect to the DB
	$mysqli = new mysqli($host, $user, $pass, $db);
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// set the character set
	$mysqli->set_charset('utf-8');

	// write the SQL statement
	$sql = "SELECT date, day, home, away, venue
		FROM football_schedule;";
			
	$results = $mysqli->query($sql);
	if ( $results == false ) {
		echo $mysqli->error;
		exit();
	}
	// Close DB Connection.
	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Football Database Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">Football Schedule</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="index.php" role="button" class="btn btn-primary">Back to Home</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				<!-- TODO: Replace '1' with actual number of results -->
				Showing <?php echo $results->num_rows; ?> result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Date</th>
							<th>Day</th>
							<th>Home Team</th>
							<th>Away Team</th>
							<th>Venue</th>
						</tr>
					</thead>
					<tbody>

						<!-- TODO: Loop through DB results and output them here. Modify or remove hard-coded <tr> below. -->
						<?php while ( $row = $results->fetch_assoc() ) : ?>
						<tr>
							<td><?php echo $row['date']; ?></td>
							<td><?php echo $row['day']; ?></td>
							<td><?php echo $row['home']; ?></td>
							<td><?php echo $row['away']; ?></td>
							<td><?php echo $row['venue']; ?></td>
						</tr>
						<?php endwhile; ?>

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="index.php" role="button" class="btn btn-primary">Back to Home</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>