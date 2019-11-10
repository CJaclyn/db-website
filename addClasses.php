<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Classes</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="add.css">
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
          //form start
          echo "<form method='post' action=''>";
          echo "<h2>Add a Class</h2>";
          echo "
          <label for='classID'>Class ID *</label>
          <input type='text' name='classID' id='classID' required maxlength='10'>
          <label for='name'>Class Name *</label>
          <input type='text' name='name' id='name' required maxlength='30'>
          <label for='teacher'>Teacher *</label>
          <input type='text' name='teacher' id='teacher' required maxlength='15'>
          <label for='email'>Email</label>
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

  <?php
  if(isset($_POST['submit'])){
    $class = $_POST['classID'];
    $teacher = $_POST['teacher'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = mysqli_prepare($db, "INSERT INTO class VALUES(?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt,"sssss", $class, $username, $name, $teacher, $email);


    if($stmt->execute()){
      echo "Success!";
      echo "<script type='text/javascript'>alert('Class successfully added!');</script>";
      header( "refresh:.5;url=classes.php" );
    }
    else {
      //echo "ERROR: Could not able to execute $addQuery. ".mysqli_error($db);
      echo "<div id='error'>";
      echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
      echo "</div>";
    }

    mysqli_close($db);
  }
   ?>

</body>
</html>
