<!DOCTYPE html>
<html lang="en">
<head>
<title>Register Result</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="registerResult.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
  <h2>Homework Tracker</h2>
  <nav>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="assignments.html">Assignments</a>
      </li>
      <li><a href="register.html">Sign-up</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="admin.php">Admin</a></li>
    </ul>
  </nav>

  <?php
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $college = $_POST['college'];
    $major = $_POST['major'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

  $db = mysqli_connect('localhost','root','12345','ics311fa190304') or die('Error connecting to MySQL server.');

   if(!empty($firstName) && !empty($lastName) && !empty($birthday) && !empty($email) && !empty($username)
   && !empty($password) && !empty($college) && !empty($major)){
      $formQuery = "INSERT INTO user (username, password, email, firstname, lastname, birthday, college, major)
      VALUES ('$username', '$password', '$email', '$firstName', '$lastName', '$birthday', '$college', '$major')";
      if(mysqli_query($db, $formQuery)){
          echo "<h1>Successfully registered!</h1>";
      } else{
          echo "ERROR: Could not able to execute $formQuery. " . mysqli_error($db);
      }
      mysqli_close($db);
   }
   elseif(empty($firstName) || empty($lastName) || empty($birthday) || empty($email) || empty($username) || empty($password) || empty($college) || empty($major)){
     echo "Missing information!";
   }
   ?>
</body>
</html>
