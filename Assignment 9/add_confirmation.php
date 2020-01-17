<?php
require 'config/config.php';
$isUpdated = false;
if ( !isset($_POST['title']) || empty($_POST['title']) ) {
	// Missing required fields.
	$error = "Please fill out all required fields.";
} else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}
	if ( isset($_POST['genre_id']) && !empty($_POST['genre_id']) ) {
		// User selected bytes value.
		$genre_id = $_POST['genre_id'];
	} else {
		// User did not select bytes value.
		$genre_id = null;
	}
	if ( isset($_POST['rating_id']) && !empty($_POST['rating_id']) ) {
		// User typed in composer field.
		$rating_id = $_POST['rating_id'];
	} else {
		// User did not type in composer field.
		$rating_id = null;
	}	
	if ( isset($_POST['label_id']) && !empty($_POST['label_id']) ) {
		// User typed in composer field.
		$label_id = $_POST['label_id'];
	} else {
		// User did not type in composer field.
		$label_id = null;
	}
	if ( isset($_POST['format_id']) && !empty($_POST['format_id']) ) {
		// User typed in composer field.
		$format_id = $_POST['format_id'];
	} else {
		// User did not type in composer field.
		$format_id = null;
	}
	if ( isset($_POST['sound_id']) && !empty($_POST['sound_id']) ) {
		// User typed in composer field.
		$sound_id = $_POST['sound_id'];
	} else {
		// User did not type in composer field.
		$sound_id = null;
	}
	if ( isset($_POST['award']) && !empty($_POST['award']) ) {
		// User typed in composer field.
		$award = $_POST['award'];
	} else {
		// User did not type in composer field.
		$award = null;
	}
	if ( isset($_POST['release_date']) && !empty($_POST['release_date']) ) {
		// User typed in composer field.
		$release_date = $_POST['release_date'];
	} else {
		// User did not type in composer field.
		$release_date = null;
	}
	$sql_prepared = "INSERT INTO dvd_titles (title, release_date, award, label_id, sound_id, genre_id, rating_id, format_id) VALUES (?,?,?,?,?,?,?,?);";

	$statement = $mysqli->prepare($sql_prepared);
	// First parameter is data types, the rest are variables that will fill in the ? placeholders
	$statement->bind_param("sssiiiii", $_POST["title"], $release_date, $award, $label_id, $sound_id, $genre_id, $rating_id, $format_id);

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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | DVD Database</title>
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
			<h1 class="col-12 mt-4">Add a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error) ) : ?>

					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>
				<?php if ($isUpdated) : ?>

					<div class="text-success">
						<span class="font-italic"><?php echo $_POST['title']; ?></span> was successfully added.
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