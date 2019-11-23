<?php
  session_start();
  include('connection.php');
  include('loginfunctions.php');
  global $class_err, $name_err, $teacher_err, $exists_err;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Classes</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="add.css">
<link rel="stylesheet" href="inputerror.css">
<link rel="stylesheet" href="dberror.css">

</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  if(isset($_POST['submit'])){
    $class = htmlspecialchars($_POST['classID']);
    $teacher = htmlspecialchars($_POST['teacher']);
    $name = htmlspecialchars($_POST['name']);
    $email = $_POST['email'];
    $username = $_SESSION['reg_user'];
    global $class_err, $name_err, $teacher_err, $exists_err;
    $class_err = $name_err = $teacher_err = $exists_err = "";

    if(regexAz09($class) && regexCheck($name) && nameRegex($teacher)){
      //select query
      $selectQ = $db->prepare("SELECT COUNT(1) FROM class WHERE classID = ? AND username = ?");
      $selectQ->bind_param("ss", $class, $username);

      if($selectQ->execute()){
        $selectQ->bind_result($count);
        $selectQ->fetch();

        if ($count == 0){
          $selectQ->close();

          //insert query
          $insertQ = $db->prepare("INSERT INTO class(classID, username, className, teacher, email)
          VALUES(?, ?, ?, ?, ?)");
          $insertQ->bind_param("sssss", $class, $username, $name, $teacher, $email);

          if($insertQ->execute()){
            echo "<script type='text/javascript'>alert('Class successfully added!');</script>";
            header( "refresh:.5;url=classes.php" );

          }else {
            echo "<div class='errormsg'>";
            echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
            echo "</div>";
            echo mysqli_error($db);

          }
        }else {
          $selectQ->close();
          $exists_err = "You already have this class added.";

        }
      }else{
        echo "<div class='errormsg'>";
        echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
        echo "</div>";
        echo mysqli_error($db);

      }
    }if(!regexAz09($class)){
      $class_err = "Class ID can only have letters and numbers.";

    }if(!regexCheck($name)){
      $name_err = "Class name can only have letters, numbers, periods, hyphens, single quotes, and spaces.";

    }if(!nameRegex($teacher)){
      $teacher_err = "Teacher can only have letters, periods, hyphens, and spaces.";

    }
    mysqli_close($db);
  }
   ?>

  <?php
  if (isLoggedIn()){
          //form start
          echo "<form method='post' action=''>";
          echo "<h2>Add a Class</h2>";
          echo "
          <label for='classID'>Class ID *</label>
          <input type='text' name='classID' id='classID' required maxlength='10'>";
          echo "<div class='error'>".$class_err."</div>";
          echo "<div class='error'>".$exists_err."</div>";
          echo"<label for='name'>Class Name *</label>
          <input type='text' name='name' id='Name' required maxlength='30'>";
          echo "<div class='error'>".$name_err."</div>";
          echo"<label for='teacher'>Teacher *</label>
          <input type='text' name='teacher' id='teacher' required maxlength='15'>";
          echo "<div class='error'>".$teacher_err."</div>";
          echo"<label for='email'>Email</label>
          <input type='email' name='email' id='email'>
          <br>
          <button type='submit' name='submit'>Submit</button>
          ";
          echo "</form>";
          //form end
          echo "<div id='centered'>";
          echo "<a href='classes.php'>Go Back</a></div>";
      }else
    {
      notLoggedIn();
    }
  ?>

</body>
</html>
