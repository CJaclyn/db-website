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
    // if they are in the database register the user id
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
      echo '<p><a href="assignments.php">View your assignments</a></p>';
      echo '<p><a href="classes.php">View your classes</a></p>';
    }
    else{
    echo "<nav>
      <ul>
        <li><a href=\"index.html\">Home</a></li>
        <li><a href=\"register.html\">Register</a></li>
        <li><a href=\"login.php\">Login</a></li>
        <li><a href=\"about.html\">About</a></li>
        <li><a href=\"adminlogin.html\">Admin</a></li>
      </ul>
    </nav>";
    {
      if (isset($username))
      {
        // if they've tried and failed to log in
        echo '<p>Invalid credentials.</p>';
      }

      // provide form to log in
      echo '<form action="login.php" method="post">';
      echo '<fieldset>';
      echo '<legend>Login</legend>';
      echo '<p><label for="username">Username:</label>';
      echo '<input type="text" name="username" id="username" required></p>';
      echo '<p><label for="password">Password:</label>';
      echo '<input type="password" name="password" id="password" required></p>';
      echo '</fieldset>';
      echo '<button type="submit" name="login">Login</button>';
      echo '</form>';

    }
  }
  ?>
</body>
</html>
