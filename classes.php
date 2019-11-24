<?php
  session_start();
  include('connection.php');
  include('loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Classes</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="classes.css">
<link rel="stylesheet" href="dberror.css">
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">


</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  if (isLoggedIn()){

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
        echo "<div class='errormsg'>";
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
