<?php
session_start();
include('connection.php');
include('loginfunctions.php');
loginadmin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="login.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
  <h1>Homework Tracker</h1>
  <?php
  /*Logged in regular users can't access this admin login page.
  Return user back to homepage if they are logged in as a regular user.*/
    if(isLoggedIn()){
      header('location:index.php');
    }elseif(isLoggedInAdmin()){
      header('location:adminPage.php');
    }
  ?>

  <h2>Admin Login</h2>
  <div id="form">
    <form action="adminPage.php" method="post" name="adminForm">
      <label for="username">Admin Username</label>
      <input type="text" id="username" name="username" required><span id="validate-adminU"></span><br>
      <label for="password">Admin Password</label>
      <input type="password" id="password" name="password" required><span id="validate-adminP"></span><br>
      <button type="submit">Login</button>
    </form>
  </div>

</body>
</html>
