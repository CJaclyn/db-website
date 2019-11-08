<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Assignments</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="classes.css">
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

      echo "<h1 id='header'>Classes</h1>";

      $query = "SELECT * FROM class WHERE username='".$username."' ORDER BY className ASC";

      $classes = mysqli_query($db, $query);

      echo "<form method=\"get\" action=\"classes.php\">";
      echo "<table>";
      echo "<tr> <th>Class ID</th> <th>Class Name</th> <th>Teacher</th> <th>Email</th></tr>";
      if(mysqli_query($db, $query)){
        while ($row = mysqli_fetch_array($classes)) {
          echo "<tr>";
          echo "<td>".$row['classID']."</td>";
          echo "<td>".$row['className']."</td>";
          echo "<td>".$row['teacher']."</td>";
          echo "<td>".$row['email']."</td>";
          echo "<td><button type=\"submit\" name='".$row['username']."'>"."Delete</button></td>";
        }
      echo "</table>";
      echo "</form>";

      }else {
        echo "ERROR: Could not able to execute $query. ".mysqli_error($db);
      }

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
