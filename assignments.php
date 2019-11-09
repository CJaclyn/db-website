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
<link rel="stylesheet" href="assignments.css">
<link rel="stylesheet" href="errormsg.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
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

      echo "<h1 id='header'>Assignments</h1>";
      echo "<div id='centered'><a href='addAssignments.php'>Add Assignments</a></div>";

      $query = "SELECT class.className, class.email, assignmentType, assignmentName, DATE_FORMAT(dueDate, '%a %b %e, %Y') dueDate
      FROM assignment
      INNER JOIN class on class.classID = assignment.classID
      AND class.username = assignment.username
      WHERE class.username='".$username."'
      ORDER BY dueDate ASC";

      $assignments = mysqli_query($db, $query);
      echo "<div id='container'>";
      if(mysqli_query($db, $query)){
        while ($row = mysqli_fetch_array($assignments)) {
          echo "<div class='row-container'>";
          echo "<div class=\"row\">";
          echo "<div class=\"column left\">";
          echo "<h4>Type</h4>";
          echo "<h2>".$row['assignmentType']."</h2>";
          echo "</div>";

          echo "<div class=\"column mid\">";
          echo "<h4>Name</h4>";
          echo "<h2>".$row['assignmentName']."</h2>";
          echo "</div>";

          echo "<div class=\"column right\">";
          echo "<h4>Class</h4>";
          echo "<h2>".$row['className']."</h2>";
          echo "</div>";
          echo "</div>";

          echo "<div class=\"row\">";
          echo "<div class=\"column l\">";
          echo "<h4>Due Date</h4>";
          echo "<h2>".$row['dueDate']."</h2>";
          echo "</div>";
          echo "<div class=\"column r\">";
          $email = $row['email'];
          echo "<h4>Email Teacher</h4>";
          echo "<a href=\"mailto:$email?Subject=Homework%20Help\" target='_top'>Help</a>";
          echo "</div>";
          echo "</div>";
          echo"</div>";
        }
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
