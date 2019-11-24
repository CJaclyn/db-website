<?php
session_start();
include('loginfunctions.php');
login();

global $user_err, $pass_err;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="inputerror.css">
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  if (isLoggedIn()){
      echo '<div id="centered"><p>Welcome '.$_SESSION['reg_user'].'!</p>';
      echo '<a href="account.php">Your account</a>';
      echo '<a href="assignments.php">View assignments</a>';
      echo '<a href="classes.php">View classes</a></div>';
    }
    else{
      echo '<h2>User Login</h2>';
      //login form
      echo '<form action="login.php" method="post">';
      echo '<p><label for="username">Username:</label>';
      echo '<input type="text" name="username" id="username" required></p>';
      echo '<div class="error">'.$user_err.'</div>';
      echo '<p><label for="password">Password:</label>';
      echo '<input type="password" name="password" id="password" required></p>';
      echo '<div class="error">'.$pass_err.'</div>';
      echo '<button type="submit" name="login">Login</button>';
      echo '</form>';

    }
  ?>
</body>
</html>
