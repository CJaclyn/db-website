<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Modify Account</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="modifyaccount.css">
<link rel="stylesheet" href="errormsg.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  //$db = mysqli_connect('localhost', 'ics311fa190304', '8736', 'ics311fa190304') or die('Error connecting to MySQL server.');
  $db = mysqli_connect('localhost', 'root', '12345', 'ics311fa190304') or die('Error connecting to MySQL server.');

    // check session variable
    if (isset($_SESSION['valid_user']))
    {
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

      echo "<h2>Modify Account Information</h2>";

      echo "
        <form method='POST' action=''>
          <label for='choice'>Select What to Modify</label>
          <select name='choice' id='choice'>
            <option value='college'>College</option>
            <option value='major'>Major</option>
            </select>
          <label for='new-info'>Enter New Information</label>
          <input type='text' name='new-info' id='new-info'></input>
          <button type='submit'>Modify</button>
        </form>";

        echo "<div id='centered'><a href='account.php'>Go Back</a></div>";
    }

    else
    {
      echo
      "<nav>
        <ul>
          <li><a href=\"index.html\">Home</a></li>
          <li><a href=\"register.html\">Sign-up</a></li>
          <li><a href=\"login.php\">Login</a></li>
          <li><a href=\"about.html\">About</a></li>
          <li><a href=\"adminLogin.html\">Admin</a></li>
        </ul>
      </nav>";

      echo '<div id="error"><h1>You need to login to see this page.</h1>';
      echo "<a href='login.php'>Login</a>";
      echo "<a href='index.html'>Go to homepage</a></div>";
    }
  ?>

  <?php

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $choice = $_POST['choice'];
    $input = $_POST['new-info'];

    if($choice == 'college'){
      $updateCollegeQuery = "UPDATE user SET college = '$input' WHERE username='".$username."'";

      if(mysqli_query($db, $updateCollegeQuery)){
          echo "<h3>Success!</h3>";
      } else{
          echo "ERROR: Could not able to execute $updateMajorQuery. " . mysqli_error($db);
      }
    }
    if($choice == 'major'){
      $updateMajorQuery = "UPDATE user SET major = '$input' WHERE username='".$username."'";

      if(mysqli_query($db, $updateMajorQuery)){
          echo "Success!";
      } else{
          echo "ERROR: Could not able to execute $updateMajorQuery. " . mysqli_error($db);
      }
    }
  }
   ?>
</body>
</html>
