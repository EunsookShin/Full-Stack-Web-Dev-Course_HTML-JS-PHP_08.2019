<?php
// Include the config.php with constants here
session_start();
require "config/config.php"; 
// Check that the track_id has been passed to this page
if( !isset($_GET["calendarID"]) || empty($_GET["calendarID"]) ) {
  echo "Invalid item";
  exit();
}
// DB Connection.
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
  echo $mysqli->connect_error;
  exit();
}
$mysqli->set_charset('utf8');
// Genres:
$sql_menus = "SELECT * FROM calendar WHERE calendarID=".$_GET["calendarID"].";";
$results_menus = $mysqli->query($sql_menus);
if ( $results_menus == false ) {
  echo $mysqli->error;
  exit();
}
// We'll get ONE track back 
$row = $results_menus->fetch_assoc();
// Close DB Connection
$mysqli->close();
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
<title>Edit</title>
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
<br><br><br><br>
	<form id="edit" action="edit_confirmation.php" method="POST">
		<div class="logo">
			<img id="logo-img" src="logo.webp" alt="text"/>
		</div>
		<div class="form-group">
			<label for="username-id">New Menu</label>
			<input type="text" class="form-control" id="username-id" name="menu" value="<?php echo $row['menu']?>">
      <input type="hidden" class="form-control" name="calendarID" value="<?php echo $_GET["calendarID"]?>">
		</div>
    <div class="font-italic text-danger">
      <?php
        if( isset($_SESSION['$edit_error']) && !empty($_SESSION['$edit_error']) ) {
          echo $_SESSION['$edit_error'];
        }
      ?>
    </div><br>
		<div class="submit-button">
			<button type="submit" class="btn btn-primary">Submit!</button>
		</div>
	</form>

</div>
<script>

</script>

</body>
</html>