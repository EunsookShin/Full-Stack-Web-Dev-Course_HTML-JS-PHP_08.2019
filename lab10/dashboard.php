<?php
	session_start();
	if(!isset($_SESSION["firstName"])) {
		$_SESSION["firstName"] == "";
	}
	if(!isset($_SESSION["lastName"])) {
		$_SESSION["lastName"] == "";
	}
	if(!isset($_SESSION["username"])) {
		$_SESSION["username"] == "";
	}
	if(!isset($_SESSION["email"])) {
		$_SESSION["email"] == "";
	}
	if(!isset($_SESSION["address"])) {
		$_SESSION["address"] == "";
	}
	if(!isset($_SESSION["address2"])) {
		$_SESSION["address2"] == "";
	}
	if(!isset($_SESSION["state"])) {
		$_SESSION["state"] == "";
	}
	if(!isset($_SESSION["zip"])) {
		$_SESSION["zip"] == "";
	}
	$mysqli = new mysqli('304.itpwebdev.com', 'zune_db_user', 'uscItp2019', 'zune_lab_10');
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$results = $mysqli->query("SELECT * FROM states;");
	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$mysqli->close();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<title>Dashboard with Sessions</title>
</head>

<body class="bg-light">

	<div class="container">
		<div class="pt-5 pb-3 text-center">
			<h2>Dashboard</h2>
			<p class="lead"></p>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h4 class="mb-3">User Information</h4>
				<form action="save.php" method="POST">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="firstName">First name</label>
							<input type="text" class="form-control" id="firstName" name="firstName" value=<?php echo "'".$_SESSION["firstName"]."'"; ?> >
						</div>
						<div class="col-md-6 mb-3">
							<label for="lastName">Last name</label>
							<input type="text" class="form-control" id="lastName" name="lastName" value=<?php echo "'".$_SESSION["lastName"]."'"; ?> >
						</div>
					</div>

					<div class="mb-3">
						<label for="username">Username</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">@</span>
							</div>
							<input type="text" class="form-control" id="username" name="username" value=<?php echo "'".$_SESSION["username"]."'"; ?> >
						</div>
					</div>

					<div class="mb-3">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" value=<?php echo "'".$_SESSION["email"]."'"; ?> >
					</div>

					<div class="mb-3">
						<label for="address">Address</label>
						<input type="text" class="form-control" id="address" name="address" value=<?php echo "'".$_SESSION["address"]."'"; ?> >
					</div>

					<div class="mb-3">
						<label for="address2">Address 2</label>
						<input type="text" class="form-control" id="address2" name="address2" value=<?php echo "'".$_SESSION["address2"]."'"; ?> >
					</div>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="state">State</label>
							<select class="custom-select d-block w-100" id="state" name="state">
								<option disabled selected>Choose...</option>
								
								<?php while ( $row = $results->fetch_assoc() ) : ?>
									
									<option <?php if($row['name'] == $_SESSION["state"]) echo "selected"; ?>><?php echo $row['name']; ?></option>
								<?php endwhile; ?>

							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label for="zip">Zip</label>
							<input type="text" class="form-control" id="zip" name="zip" value=<?php echo "'".$_SESSION["zip"]."'"; ?> >
						</div>
					</div>
					<button class="btn btn-primary btn-lg btn-block mt-4" type="submit">Save Info</button>
					<a href="delete.php" class="btn btn-secondary btn-lg btn-block mt-4 text-white">Clear Info</a>
				</form>
			</div>
		</div>

		<footer class="my-5 text-muted text-center text-small">
			<p class="mb-1">&copy; 2019 ITP Web Dev</p>
		</footer>

	</div>
	
</body>
</html>