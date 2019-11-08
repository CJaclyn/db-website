<!DOCTYPE html>
<html lang="en">
<head>
<title>Delete User</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="deleteUser.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
  <h1>Homework Tracker</h1>
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
  $url = $_SERVER['REQUEST_URI'];
  $parseURL = strval(parse_url($url, PHP_URL_QUERY));
  $user = strval(explode('=', $parseURL)[0]);
  echo "<div id='container'>";
  echo "<h2>Are you sure you want to delete user <span id='black'>".$user."</span>?</h2>";
  echo "<a href='adminPage.php'>Return to Admin Page</a>";
   ?>

  <div id="form">
    <form action="" method="post" name="deleteForm" onsubmit="return validation();">
      <label for="password">Enter admin password to confirm user deletion.</label>
      <input name="password" type="password" id="password" required><span id="validate-adminP"></span><br>
      <button type="submit">Delete</button>
    </form>
  </div>
</div>

  <?php
  if(isset($_POST['password'])){
    $password = $_POST['password'];
    //$db = mysqli_connect('localhost', 'ics311fa190304', '8736', 'ics311fa190304') or die('Error connecting to MySQL server.');
    $db = mysqli_connect('localhost','root','12345','ics311fa190304') or die('Error connecting to MySQL server.');
    $deleteQuery = "DELETE FROM user WHERE username='$user'";

    if($password == "admin"){
      if(mysqli_query($db, $deleteQuery)){
          echo "<a href='index.html'>Return to Admin Page</a>";
          echo "</div>";
      } else{
          echo "<div id='error'>";
          echo "<h1>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Deletion%20Error' target='_top'>Jaclyn Cao.</a></h1>";
          //echo "ERROR: Could not able to execute $deleteQuery. ".mysqli_error($db);
          echo "</div>";
      }
      mysqli_close($db);
    }
  }
   ?>

   <script>
   function validation(){
     var password;
     password = document.getElementById("password").value;

     if(password !== "admin"){
       document.getElementById("validate-adminP").innerHTML = "Admin password invalid.";
       return false;
     }else {
       alert("User succesfully deleted.");
       document.getElementById("validate-adminP").innerHTML = "";
       return true;
     }
     }
   </script>

</body>
</html>
