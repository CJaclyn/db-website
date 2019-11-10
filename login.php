<?php
session_start();
include('loginCheck.php');
login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="login.css">

</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  if (isLoggedIn()){

      $username = $_SESSION['valid_user'];

      echo "<nav>
        <ul>
          <li><a href=\"index.html\">Home</a></li>
          <li><a href=\"about.html\">About</a></li>
          <li><a href=\"login.php\">$username</a></li>
          <li><a href=\"logout.php\">Logout</a></li>
        </ul>
      </nav>";

      echo '<div id="centered"><p>Welcome '.$_SESSION['valid_user'].'!</p>';
      echo '<a href="account.php">Your account</a>';
      echo '<a href="assignments.php">View assignments</a>';
      echo '<a href="classes.php">View classes</a></div>';
    }
    else{
    echo "<nav>
      <ul>
        <li><a href=\"index.html\">Home</a></li>
        <li><a href=\"register.html\">Sign-up</a></li>
        <li><a href=\"login.php\">Login</a></li>
        <li><a href=\"about.html\">About</a></li>
        <li><a href=\"adminLogin.html\">Admin</a></li>
      </ul>
    </nav>";
    {
      if (isset($username))
      {
        echo "<script type='text/javascript'>alert('Your username or password is wrong.');</script>";
      }

      echo '<h2>User Login</h2>';
      //login form
      echo '<form action="login.php" method="post">';
      echo '<p><label for="username">Username:</label>';
      echo '<input type="text" name="username" id="username" required></p>';
      echo '<p><label for="password">Password:</label>';
      echo '<input type="password" name="password" id="password" required></p>';
      echo '<button type="submit" name="login">Login</button>';
      echo '</form>';

    }
  }
  ?>
</body>
</html>
