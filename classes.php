<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Classes</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="classes.css">
<link rel="stylesheet" href="errormsg.css">

</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  //$db = mysqli_connect('localhost', 'ics311fa190304', '8736', 'ics311fa190304') or die('Error connecting to MySQL server.');
  $db = mysqli_connect('localhost', 'root', '12345', 'ics311fa190304') or die('Error connecting to MySQL server.');

  include('loginCheck.php');
  if (isLoggedIn()){
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

      $query = "SELECT * FROM class WHERE username='".$username."' ORDER BY className ASC";

      $classes = mysqli_query($db, $query);

      echo "<div id='centered'>";
      echo "<h2 id='header'>Your Classes</h2>";
      echo "<table>";
      echo "<tr><th>Class ID</th> <th>Class Name</th> <th>Teacher</th> <th>Email</th></tr>";
      if(mysqli_query($db, $query)){
        while ($row = mysqli_fetch_array($classes)) {
          echo "<tr>";
          echo "<td>".$row['classID']."</td>";
          echo "<td>".$row['className']."</td>";
          echo "<td>".$row['teacher']."</td>";
          echo "<td>".$row['email']."</td>";
          echo "<td><a href='deleteClass.php?id=".$row['classID']."'>Delete</a></td>";
          echo "</tr>";
        }
      echo "</table>";
      echo "<div id='addclass'><a href='addClasses.php'>Add Classes</a></div>";
      echo "</div>";
      }else {
        //echo "ERROR: Could not able to execute $query. ".mysqli_error($db);
        echo "<div id='error'>";
        echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
        echo "</div>";
      }

      mysqli_close($db);
    }
    else
    {
      notLoggedIn();
    }
  ?>
</body>
</html>
