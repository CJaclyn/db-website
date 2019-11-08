<?php
  session_start();

  // store to test if they *were* logged in
  $old_user = $_SESSION['valid_user'];
  unset($_SESSION['valid_user']);
  session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Logout</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="logout.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
  <h1>Homework Tracker</h1>
  <nav>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="register.html">Register</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="adminlogin.html">Admin</a></li>
    </ul>
  </nav>
<?php
  if (!empty($old_user))
  {
    echo '<p>You are now logged out.</p>';
  }
  else
  {
    // if they weren't logged in but came to this page somehow
    echo '<p>You were not logged in, and so have not been logged out.</p>';
  }
?>
<p><a href="index.html">Back to Home Page</a></p>

</body>
</html>
