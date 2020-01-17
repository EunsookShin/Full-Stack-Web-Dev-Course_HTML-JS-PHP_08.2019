<?php
session_start();
require 'config/config.php';
	
  // If user is logged in, don't let them see this page. Kick them out. Otherwise, continue with the validation/authentication stuff
  if( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true )  {
    // Redirect the user to the home page
    header("Location: ../final_project/home.php");
  }
  
  else {
	// Check that user has submitted the login form (as opposed to user just got to the form for the first time)
	if( isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
		if( empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["confirm"]) ) {
			$error = "Please fill out the required fields.";
		}
		else if($_POST["password"] != $_POST["confirm"]){
			$error = "Passwords do not match.";
		}
		else {
			// DB Connection.
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if ( $mysqli->connect_errno ) {
				echo $mysqli->connect_error;
				exit();
			}
			$sql_prepared = "INSERT INTO users (username, password) VALUES (?,?);";

			$statement = $mysqli->prepare($sql_prepared);
			// First parameter is data types, the rest are variables that will fill in the ? placeholders
			$statement->bind_param("ss", $_POST["username"], $_POST["password"]);

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

		    $_SESSION["logged_in"] = true;
		    $_SESSION["username"] = $_POST["username"];
		    // Redirect user to home page
		    header("Location: ../final_project/home.php");
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="A11.css">
<title>Register</title>
</head>
<body>
<div id="main">
	<div id="header"></div>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0F4C5C;">
  <a class="navbar-brand" href="#"><img id="mp-logo" src="meal_planner_logo.png" alt="text"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">LogIn</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="register.php">Register<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
    </ul>
  </div>
</nav>
<br><br><br><br>
	<form id="register" action="register.php" method="POST">
		<div class="logo">
			<img id="logo-img" src="logo.webp" alt="text"/>
		</div>
		<div class="form-group">
			<label for="username-id">Username</label>
			<input type="text" class="form-control" id="username-id" name="username" placeholder="Type in your username...">
		</div>
		<div class="form-group">
			<label for="password-id">Password</label>
			<input type="password" class="form-control" id="password-id" name="password" placeholder="Type in your password...">
		</div>
		<div class="form-group">
			<label for="confirm-id">Confirm Password</label>
			<input type="password" class="form-control" id="confirm-id" name="confirm" placeholder="Confirm your password...">
		</div> 
		<div class="font-italic text-danger">
	      <?php
	        if( isset($error) && !empty($error) ) {
	          echo $error;
	        }
	      ?>
	    </div><br>
		<div class="submit-button">
			<button type="submit" class="btn btn-primary">Register!</button>
		</div>
	</form>

</div>
<script>

</script>

</body>
</html>