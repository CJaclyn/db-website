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


</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  if (isLoggedIn()){
      $classID = $_GET['id'];

      $deleteAssignmentsQuery = "DELETE FROM assignment WHERE classID = '".$classID."'";

      if(mysqli_query($db, $deleteAssignmentsQuery)){
        $deleteClassQuery = "DELETE FROM class WHERE classID = '".$classID."'";
        if(mysqli_query($db, $deleteClassQuery)){
          echo "<script type='text/javascript'>alert('Class successfully deleted!');</script>";
          header( "refresh:.5;url=classes.php" );
        }else{
          echo "ERROR: Could not able to execute $deleteClassQuery. " . mysqli_error($db);
          echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
        }
      } else{
        echo "ERROR: Could not able to execute $deleteAssignmentsQuery. " . mysqli_error($db);
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
