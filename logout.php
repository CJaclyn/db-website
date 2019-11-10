<?php
  session_start();
  if(isset($_SESSION['valid_user'])){
      $old_user = $_SESSION['valid_user'];
  }
  include('loginCheck.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Logout</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="logout.css">

</head>
<body>
  <h1>Homework Tracker</h1>
  <nav>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="register.html">Sign-up</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="adminLogin.html">Admin</a></li>
    </ul>
  </nav>
<?php

  header( "refresh:1;url=index.html" );
  if (!empty($old_user))
  {
    logOut();
    echo '<h2>You are now logged out.</h2>';
    echo '<p>Returning to homepage. . .</p>';
  }
  else
  {
    echo '<h2>You were not logged in, and so have not been logged out.</h2>';
    echo '<p>Returning to homepage. . .</p>';
  }
?>

</body>
</html>
