<?php
  session_start();
  include('connection.php');
  include('loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Delete Assignment</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="classes.css">


</head>
<body>
  <h1>Homework Tracker</h1>

  <?php

  if (isLoggedIn()){
      $name = $_GET['id'];

      $selectQuery = "select assignmentID from assignment inner join user where assignment.username = user.username and assignmentName='".$name."'";
      $getAssignmentID = mysqli_query($db, $selectQuery);
      $row = mysqli_fetch_array($getAssignmentID);
      $assignmentID = $row['assignmentID'];

      if(mysqli_query($db, $selectQuery)){
        $deleteQuery = "DELETE FROM assignment WHERE assignmentID = '".$assignmentID."'";

        if(mysqli_query($db, $deleteQuery)){
          echo "<script type='text/javascript'>alert('Assignment successfully deleted!');</script>";
          header( "refresh:.5;url=assignments.php" );
        } else{
            //echo "ERROR: Could not able to execute $deleteQuery. " . mysqli_error($db);
            echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
        }
      } else{
          //echo "ERROR: Could not able to execute $selectQuery. " . mysqli_error($db);
          echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
      }

      mysqli_close($db);

    }else
    {
      notLoggedIn();
    }
  ?>
</body>
</html>
