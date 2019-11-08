<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Account</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="account.css">
<link rel="stylesheet" href="errormsg.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  $db = mysqli_connect('localhost', 'root', '12345', 'ics311fa190304') or die('Error connecting to MySQL server.');

    // check session variable
    if (isset($_SESSION['valid_user']))
    {
      $username = $_SESSION['valid_user'];

      echo "
      <nav>
        <ul>
          <li><a href=\"index.html\">Home</a></li>
          <li><a href=\"about.html\">About</a></li>
          <li><a href=\"login.php\">$username</a></li>
          <li><a href=\"logout.php\">Logout</a></li>
        </ul>
      </nav>";

      $usersQuery = "SELECT firstname, lastname, DATE_FORMAT(birthday, '%b %e, %Y') birthday, college, major from user where username='".$username."'";

      $users = mysqli_query($db, $usersQuery);
      mysqli_query($db, $usersQuery) or die('Error querying database.');
      $row = mysqli_fetch_array($users);

      echo"<div id='container'>";
      echo "<h2>Your Account</h2>";
      echo "<div class='center'><img src='generic-user.png' width='150'></div>";
      echo "<h3>".$row['firstname']." ".$row['lastname']."</h3>";
      echo "<table>";
      echo "<tr><th>Birthday</th> <th>College</th> <th>Major</th> </tr>";
      echo "<td>".$row['birthday']."</td>";
      echo "<td>".$row['college']."</td>";
      echo "<td>".$row['major']."</td>";
      echo "</table>";
      echo "<div class='center'><a href='modifyacc.php'>Modify Information</a></div>";
      echo "</div>";

      mysqli_close($db);
    }
    else
    {
      echo
      "<nav>
        <ul>
          <li><a href=\"index.html\">Home</a></li>
          <li><a href=\"register.html\">Sign-up</a></li>
          <li><a href=\"login.php\">Login</a></li>
          <li><a href=\"about.html\">About</a></li>
          <li><a href=\"adminLogin.html\">Admin</a></li>
        </ul>
      </nav>";

      echo '<div id="error"><h1>You need to login to see this page.</h1>';
      echo "<a href='login.php'>Login</a>";
      echo "<a href='index.html'>Go to homepage</a></div>";
    }
  ?>
</body>
</html>
