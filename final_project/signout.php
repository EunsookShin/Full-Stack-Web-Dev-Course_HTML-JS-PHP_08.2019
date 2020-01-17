<?php
  session_start();
  // If user is logged in, don't let them see this page. Kick them out. Otherwise, continue with the validation/authentication stuff
  if( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true )  {
    // Redirect the user to the home page
    $_SESSION["logged_in"] = false;
    $_SESSION["admin"] = false;
    $_SESSION["username"] = "";
    header("Location: ../final_project/home.php");
  }
  
  else {
    // Check that user has submitted the login form (as opposed to user just got to the form for the first time)
        // Redirect user to home page
        header("Location: ../final_project/home.php");
  }
?>