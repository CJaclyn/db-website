<?php
  session_start();
  include('connection.php');
  include('loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Assignments</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="assignments.css">
<link rel="stylesheet" href="dberror.css">
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">


</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
    if (isLoggedIn()){
      echo "<h1 id='header'>Assignments</h1>";
      echo "<div id='centered'><a href='addAssignments.php'>Add Assignments</a></div>";

      $query = "SELECT class.className, class.email, assignmentType, assignmentName, DATE_FORMAT(dueDate, '%b %e %Y') dueDate
      FROM assignment
      INNER JOIN class on class.classID = assignment.classID
      AND class.username = assignment.username
      WHERE class.username='".$username."'
      ORDER BY dueDate ASC";

      //DATE_FORMAT(dueDate, '%a %b %e %Y') dueDate

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
          $assignmentName = $row['assignmentName'];
          echo "<a href='deleteAssignment.php?id=".$assignmentName."'>Delete</a>";
          echo "</div>";

          echo "<div class=\"column r\">";
          echo "<h4>Email Teacher</h4>";
          $email = $row['email'];
          echo "<a href=\"mailto:$email?Subject=Homework%20Help\" target='_top'>Help</a>";
          echo "</div>";

          echo "</div>";
          echo"</div>";
        }
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
