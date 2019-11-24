<?php
  session_start();
  include('connection.php');
  include('loginfunctions.php');
  global $name_err;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Assignments</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="add.css">
<link rel="stylesheet" href="inputerror.css">
<link rel="stylesheet" href="dberror.css">
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  if(isset($_POST['submit'])){
    $class = htmlspecialchars($_POST['class']);
    $type = htmlspecialchars($_POST['type']);
    $name = htmlspecialchars($_POST['name']);
    $dueDate = $_POST['due-date'];
    $username = $_SESSION['reg_user'];

    global $name_err;
    $name_err = "";

    if(regexCheck($name)){
          //insert query
          $insertQ = $db->prepare("INSERT INTO assignment(username, classID, assignmentType, assignmentName, dueDate)
          VALUES(?, ?, ?, ?, ?)");
          $insertQ->bind_param("sssss", $username, $class, $type, $name, $dueDate);

          if($insertQ->execute()){
            echo "<script type='text/javascript'>alert('Assignment successfully added!');</script>";
            header( "refresh:.5;url=assignments.php" );

          }else {
            echo "<div class='errormsg'>";
            echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
            echo "</div>";
            //echo mysqli_error($db);

          }
          $insertQ->close();
    }if(!regexCheck($name)){
      $name_err = "Assignment name can only have letters, numbers, periods, hyphens, single quotes, and spaces.";

    }
  }
   ?>

  <?php
  if (isLoggedIn()){
      $currDate = date("Y-m-d");
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
          <input type='text' name='name' id='name' required>";
          echo "<div class='error'>".$name_err."</div>";
          echo"<label for='due-date'>Due Date</label>
          <input type='date' name='due-date' id='due-date' required min='".$currDate."'></input>";
          echo"<br><button type='submit' name='submit'>Submit</button>";
          echo "</form>";
          //form end
          echo "<div id='centered'>";
          echo "<a href='assignments.php'>Go Back</a></div>";

        }else {
          //echo "ERROR: Could not able to execute $addQuery. ".mysqli_error($db);
          echo "<div class='errormsg'>";
          echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
          echo "</div>";
        }

    }
    else
    {
      notLoggedIn();
    }
        mysqli_close($db);
  ?>

</body>
</html>
