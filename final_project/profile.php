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
$sql = "SELECT calendarID, username, menu, dayID, times.time
    FROM calendar
    LEFT JOIN times
      ON calendar.timeID = times.timeID
    WHERE username="."'".$_SESSION["username"]."'";
$sql_monday = $sql . "AND dayID=1;";
$results_monday = $mysqli->query($sql_monday);
if(!$results_monday) {
  echo $mysqli->error;
  exit();
}
$sql_tuesday = $sql . "AND dayID=2;";
$results_tuesday = $mysqli->query($sql_tuesday);
if(!$results_tuesday) {
  echo $mysqli->error;
  exit();
}
$sql_wednesday = $sql . "AND dayID=3;";
$results_wednesday = $mysqli->query($sql_wednesday);
if(!$results_wednesday) {
  echo $mysqli->error;
  exit();
}
$sql_thursday = $sql . "AND dayID=4;";
$results_thursday = $mysqli->query($sql_thursday);
if(!$results_thursday) {
  echo $mysqli->error;
  exit();
}
$sql_friday = $sql . "AND dayID=5;";
$results_friday = $mysqli->query($sql_friday);
if(!$results_friday) {
  echo $mysqli->error;
  exit();
}
$sql_saturday = $sql . "AND dayID=6;";
$results_saturday = $mysqli->query($sql_saturday);
if(!$results_saturday) {
  echo $mysqli->error;
  exit();
}
$sql_sunday = $sql . "AND dayID=7;";
$results_sunday = $mysqli->query($sql_sunday);
if(!$results_sunday) {
  echo $mysqli->error;
  exit();
}

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
<title>Profile</title>
<style>
</style>
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
      <li class="nav-item active">
        <a class="nav-link" href="profile.php">Profile<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signout.php">Sign Out</a>
      </li>
    </ul>
    <div id="welcome-msg">Welcome <?php echo $_SESSION["username"]?>!</div>
  </div>
</nav>
<br><h1>Menus of the Week!
  <?php if( $_SESSION["admin"] ):?>
    <form action="deleteAll.php" method="POST">
      <button id="deleteAll-btn"type="submit" class="btn" style="background-color: #5F0F40; color: white;">DELETE ALL!</button>
    </form>
  <?php endif; ?></h1><br>
<div id="table-div">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" style='border: 2px solid #4d2800;'></th>
      <th scope="col" style='border: 2px solid #4d2800;'>Mon</th>
      <th scope="col" style='border: 2px solid #4d2800;'>Tues</th>
      <th scope="col" style='border: 2px solid #4d2800;'>Wed</th>
      <th scope="col" style='border: 2px solid #4d2800;'>Thurs</th>
      <th scope="col" style='border: 2px solid #4d2800;'>Fri</th>
      <th scope="col" style='border: 2px solid #4d2800;'>Sat</th>
      <th scope="col" style='border: 2px solid #4d2800;'>Sun</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      $monday = $results_monday->fetch_assoc();
      $tuesday = $results_tuesday->fetch_assoc();
      $wednesday = $results_wednesday->fetch_assoc();
      $thursday = $results_thursday->fetch_assoc();
      $friday = $results_friday->fetch_assoc();
      $saturday = $results_saturday->fetch_assoc();
      $sunday = $results_sunday->fetch_assoc();
      for ($i=8; $i <= 22; $i++) { 
        echo "<tr><th>".$i.":00</th>";
        //monday
        if($monday['time'] == $i){
          echo "<td style='border: 2px solid #4d2800;'>".$monday['menu']." <a href='edit.php?calendarID=".$monday['calendarID']."'"."class='btn edit-btn'><i class='fas fa-pencil-alt'></i></a> <a href='delete.php?calendarID=".$monday['calendarID']."'"."class='btn delete-btn'><i class='fas fa-trash-alt'></i></a></td>";
          $monday = $results_monday->fetch_assoc();
        }
        else{
          echo "<td style='border: 2px solid #4d2800;'></td>";
        }

        //tuesday
        if($tuesday['time'] == $i){
          echo "<td style='border: 2px solid #4d2800;'>".$tuesday['menu']." <a href='edit.php?calendarID=".$tuesday['calendarID']."'"."class='btn edit-btn'><i class='fas fa-pencil-alt'></i></a> <a href='delete.php?calendarID=".$tuesday['calendarID']."'"."class='btn delete-btn'><i class='fas fa-trash-alt'></i></a></td>";
          $tuesday = $results_tuesday->fetch_assoc();
        }
        else{
          echo "<td style='border: 2px solid #4d2800;'></td>";
        }

        //wednesday
        if($wednesday['time'] == $i){
          echo "<td style='border: 2px solid #4d2800;'>".$wednesday['menu']." <a href='edit.php?calendarID=".$wednesday['calendarID']."'"."class='btn edit-btn'><i class='fas fa-pencil-alt'></i></a> <a href='delete.php?calendarID=".$wednesday['calendarID']."'"."class='btn delete-btn'><i class='fas fa-trash-alt'></i></a></td>";
          $wednesday = $results_wednesday->fetch_assoc();
        }
        else{
          echo "<td style='border: 2px solid #4d2800;'></td>";
        }

        //thursday
        if($thursday['time'] == $i){
          echo "<td style='border: 2px solid #4d2800;'>".$thursday['menu']." <a href='edit.php?calendarID=".$thursday['calendarID']."'"."class='btn edit-btn'><i class='fas fa-pencil-alt'></i></a> <a href='delete.php?calendarID=".$thursday['calendarID']."'"."class='btn delete-btn'><i class='fas fa-trash-alt'></i></a></td>";
          $thursday = $results_thursday->fetch_assoc();
        }
        else{
          echo "<td style='border: 2px solid #4d2800;'></td>";
        }

        //fiday
        if($friday['time'] == $i){
          echo "<td style='border: 2px solid #4d2800;'>".$friday['menu']." <a href='edit.php?calendarID=".$friday['calendarID']."'"."class='btn edit-btn'><i class='fas fa-pencil-alt'></i></a> <a href='delete.php?calendarID=".$friday['calendarID']."'"."class='btn delete-btn'><i class='fas fa-trash-alt'></i></a></td>";
          $friday = $results_friday->fetch_assoc();
        }
        else{
          echo "<td style='border: 2px solid #4d2800;'></td>";
        }

        //saturday
        if($saturday['time'] == $i){
          echo "<td style='border: 2px solid #4d2800;'>".$saturday['menu']." <a href='edit.php?calendarID=".$saturday['calendarID']."'"."class='btn edit-btn'><i class='fas fa-pencil-alt'></i></a> <a href='delete.php?calendarID=".$saturday['calendarID']."'"."class='btn delete-btn'><i class='fas fa-trash-alt'></i></a></td>";
          $saturday = $results_saturday->fetch_assoc();
        }
        else{
          echo "<td style='border: 2px solid #4d2800;'></td>";
        }

        //sunday
        if($sunday['time'] == $i){
          echo "<td style='border: 2px solid #4d2800;'>".$sunday['menu']." <a href='edit.php?calendarID=".$sunday['calendarID']."'"."class='btn edit-btn'><i class='fas fa-pencil-alt'></i></a> <a href='delete.php?calendarID=".$sunday['calendarID']."'"."class='btn delete-btn'><i class='fas fa-trash-alt'></i></a></td>";
          $sunday = $results_sunday->fetch_assoc();
        }
        else{
          echo "<td style='border: 2px solid #4d2800;'></td>";
        }
        echo "</tr>";
      }
      ?>
  </tbody>
</table>
</div>
</div>
<script>
// Some JS to pop up a message before user commits to deleting a track.
let deleteButtons = document.querySelectorAll(".delete-btn");

for( let i = 0; i < deleteButtons.length; i++ ) {
  deleteButtons[i].onclick = function() {
    return confirm("Are you sure you want to delete this item?");
  }
}
let deleteAllBtn = document.querySelector("#deleteAll-btn")
deleteAllBtn.onclick = function() {
  return confirm("Are you sure you want to delete calendar database of ALL users?");
}
</script>
<script src="https://kit.fontawesome.com/5826f004d7.js" crossorigin="anonymous"></script>
</body>
</html>