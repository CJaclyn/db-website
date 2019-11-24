<?php
session_start();
include('loginfunctions.php');
loginAdmin();
global $user_err, $pass_err;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login</title>
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
    if(isLoggedInAdmin()){
      echo "<h2>Redirecting to Admin Page. . .</h2>";
      header("refresh:1;url=adminPage.php");

    }elseif(isset($_SESSION['reg_user'])){
      header("location:index.php");

    }else {
      echo "
      <nav>
        <ul>
          <li><a href=\"index.php\">Home</a></li>
          <li><a href=\"register.php\">Register</a></li>
          <li><a href=\"login.php\">Login</a></li>
          <li><a href=\"adminlogin.php\">Admin</a></li>
        </ul>
      </nav>";
      
      echo '
      <h2>Admin Login</h2>
      <div id="form">
        <form action="adminlogin.php" method="post" name="adminForm">
          <label for="username">Admin Username</label>
          <input type="text" id="username" name="username" required><br>';
      echo '<div class=\'error\'>'.$user_err.'</div>';
      echo '<label for="password">Admin Password</label>
          <input type="password" id="password" name="password" required><br>';
      echo '<div class=\'error\'>'.$pass_err.'</div>';
      echo'
          <button type="submit">Login</button>
        </form>
      </div>
      ';
    }
  ?>

</body>
</html>
