<?php
session_start();
require 'config/config.php';
// DB Connection.
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}
$mysqli->set_charset('utf8');
// Days:
$sql_days = "SELECT * FROM days;";
$results_days = $mysqli->query($sql_days);
if ( $results_days == false ) {
	echo $mysqli->error;
	exit();
}
// Times:
$sql_times = "SELECT * FROM times;";
$results_times = $mysqli->query($sql_times);
if ( $results_times == false ) {
	echo $mysqli->error;
	exit();
}
// Close DB Connection
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="A11.css">
<title>Home</title>
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
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">LogIn</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signout.php">Sign Out</a>
      </li>
    </ul>
    <div id="welcome-msg">Welcome <?php echo $_SESSION["username"]?>!</div>
  </div>
</nav>
<div class="jumbotron jumbotron-fluid"></div>
<br><br>
	<div class="container">
		<p><strong>Select Your Meal</strong></p>
		<form action="add_confirmation.php" method="POST">
			<div class="form-group row">
				<label for="menu-id" class="col-sm-3 col-form-label text-sm-right">Menu: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="menu-id" name="menu" placeholder="Which menu do you want to add?">
				</div>
			</div>
			<div class="form-group row">
				<label for="day-id" class="col-sm-3 col-form-label text-sm-right">Day: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<select name="day_id" id="day-id" class="form-control">
						<option value="" selected disabled>Select Day ...</option>
						<?php while( $row = $results_days->fetch_assoc() ): ?>

							<option value="<?php echo $row['dayID']; ?>">
								<?php echo $row['day']; ?>
							</option>

						<?php endwhile; ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="time-id" class="col-sm-3 col-form-label text-sm-right">Time: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<select name="time_id" id="time-id" class="form-control">
						<option value="" selected disabled>Select Time ...</option>
						<?php while( $row = $results_times->fetch_assoc() ): ?>

							<option value="<?php echo $row['timeID']; ?>">
								<?php echo $row['time'].":00"; ?>
							</option>

						<?php endwhile; ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<div class="font-italic text-danger">
				      <?php
				        if( isset($_SESSION["error"]) && !empty($_SESSION["error"]) ) {
				          echo $_SESSION["error"];
				        }
				      ?>
				    </div><br>
					<button id="submit-btn" type="submit" class="btn" style="background-color: #5F0F40; color: white;">Add to Calendar</button>
				</div>
			</div>

		</form>
	</div>

</div>
<script>
document.querySelector("#submit-btn").onclick = function(){
	<?php if($_SESSION["logged_in"]==false):?> 
		alert("You must log in/register!!");
		return false;
	<?php endif; ?>
}
</script>

</body>
</html>