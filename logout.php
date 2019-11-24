<?php
  session_start();
  include('loginfunctions.php');
  logout();
  header( "refresh:1;url=index.php" );
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Logout</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="logout.css">
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

</head>
<body>
  <h1>Homework Tracker</h1>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="register.php">Sign-up</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="adminlogin.php">Admin</a></li>
    </ul>
  </nav>

  <h2 style='color:white;'>Logging out. . .</h2>

</body>
</html>
