<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password']))
{
  // if the user has just tried to log in
  $username = $_POST['username'];
  $password = $_POST['password'];

  //$db = mysqli_connect('localhost', 'ics311fa190304', '8736', 'ics311fa190304') or die('Error connecting to MySQL server.');
  $db = mysqli_connect('localhost', 'root', '12345', 'ics311fa190304') or die('Error connecting to MySQL server.');

  $query = "SELECT * FROM user WHERE
  username='".$username."' AND
  password='".$password."'";

  $result = $db->query($query);
  if ($result->num_rows)
  {
    $_SESSION['valid_user'] = $username;
  }
  $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="login.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
    if (isset($_SESSION['valid_user'])){

      $username = $_SESSION['valid_user'];

      echo "<nav>
        <ul>
          <li><a href=\"index.html\">Home</a></li>
          <li><a href=\"about.html\">About</a></li>
          <li><a href=\"login.php\">$username</a></li>
          <li><a href=\"logout.php\">Logout</a></li>
        </ul>
      </nav>";

      echo '<p>Welcome '.$_SESSION['valid_user'].'!<br />';
      echo '<p><a href="account.php">Your account</a></p>';
      echo '<p><a href="assignments.php">View assignments</a></p>';
      echo '<p><a href="classes.php">View classes</a></p>';
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
        echo '<p>Invalid credentials.</p>';
      }

      echo '<h2>User Login</h2>';
      //login form
      echo '<div id="form">';
      echo '<form action="login.php" method="post">';
      echo '<p><label for="username">Username:</label>';
      echo '<input type="text" name="username" id="username" required></p>';
      echo '<p><label for="password">Password:</label>';
      echo '<input type="password" name="password" id="password" required></p>';
      echo '<button type="submit" name="login">Login</button>';
      echo '</form>';
      echo '</div>';

    }
  }
  ?>
</body>
</html>
