<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Assignments</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="add.css">
<link rel="stylesheet" href="errormsg.css">

</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  include('connection.php');
  include('loginCheck.php');

  if (isLoggedIn()){
      $username = $_SESSION['valid_user'];

      echo "
      <nav>
        <ul>
          <li><a href=\"index.html\">Home</a></li>

          <li><a href=\"login.php\">$username</a></li>
          <li><a href=\"logout.php\">Logout</a></li>
        </ul>
      </nav>";

      $query = "SELECT classID, className from class WHERE username = '".$username."' ORDER BY className ASC";
      $class = mysqli_query($db, $query);

          //form start
          echo "<form method='post' action=''>";
          echo "<h2>Add an Assignment</h2>";
          echo "<label for='class'>Select Class</label>";
          echo "<select name='class' id='class'>";
          if(mysqli_query($db, $query)){
            while ($row = mysqli_fetch_array($class)) {
                        $id = $row['classID'];
                        $name = $row['classID']." - ".$row['className'];
                        echo '<option value="'.$id.'">'.$name.'</option>';
          }
          echo "</select>";
          echo "
          <label for='type'>Assignment Type</label>
          <select name='type' id='type'>
            <option value='Homework' name='homework'>Homework</option>
            <option value='Quiz' name='quiz'>Quiz</option>
            <option value='Project' name='project'>Project</option>
            <option value='Test' name='test'>Test</option>
          </select>
          <label for='name'>Assignment Name</label>
          <input type='text' name='name' id='name' required>
          <label for='due-date'>Due Date</label>
          <input type='date' name='due-date' id='due-date' required>
          <br>
          <button type='submit' name='submit'>Submit</button>
          ";
          echo "</form>";
          //form end
          echo "<div id='centered'>";
          echo "<a href='assignments.php'>Go Back</a></div>";

        }else {
          //echo "ERROR: Could not able to execute $addQuery. ".mysqli_error($db);
          echo "<div id='error'>";
          echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
          echo "</div>";
        }

    }
    else
    {
      notLoggedIn();
    }
  ?>

  <?php
  if(isset($_POST['submit'])){
    $class = $_POST['class'];
    $type = $_POST['type'];
    $name = $_POST['name'];
    $dueDate = $_POST['due-date'];

    $stmt = mysqli_prepare($db, "INSERT INTO assignment VALUES(DEFAULT, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt,"sssss", $username, $class, $type, $name, $dueDate);


    if($stmt->execute()){
      echo "Success!";
      echo "<script type='text/javascript'>alert('Assignment successfully added!');</script>";
      header( "refresh:.5;url=assignments.php" );
    }
    else {
      //echo "ERROR: Could not able to execute $stmt. ".mysqli_error($db);
      echo "<div id='error'>";
      echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
      echo "</div>";
    }

    mysqli_close($db);
  }
   ?>

</body>
</html>
