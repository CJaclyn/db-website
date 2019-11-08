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
      <li><a href="register.html">Sign-up</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="adminLogin.html">Admin</a></li>
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

    //$db = mysqli_connect('localhost', 'ics311fa190304', '8736', 'ics311fa190304') or die('Error connecting to MySQL server.');
    $db = mysqli_connect('localhost','root','12345','ics311fa190304') or die('Error connecting to MySQL server.');
    $formQuery = "INSERT INTO user (username, password, email, firstname, lastname, birthday, college, major)
    VALUES ('$username', '$password', '$email', '$firstName', '$lastName', '$birthday', '$college', '$major')";
    if(mysqli_query($db, $formQuery)){
        echo "<div id='successful'>";
        echo "<h1>Successfully registered!</h1>";
        echo "<a href='index.html'>Return to Homepage</a>";
        echo "</div>";
    } else{
        echo "<div id='error'>";
        echo "<h1>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Registration%20Error' target='_top'>Jaclyn Cao.</a></h1>";
        //echo "ERROR: Could not able to execute $formQuery. ".mysqli_error($db);
        echo "</div>";
    }
    mysqli_close($db);
   ?>
</body>
</html>
