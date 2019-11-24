<?php
session_start();
include('loginfunctions.php');
include("connection.php");
global $pass_err;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Delete User</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="deleteUser.css">
<link rel="stylesheet" href="inputerror.css">
<link href="https://fonts.googleapis.com/css?family=Cairo|Unica+One&display=swap" rel="stylesheet">

</head>
<body>
  <h1>Homework Tracker</h1>
  <?php
  if(isLoggedInAdmin()){
  $url = $_SERVER['REQUEST_URI'];
  $parseURL = strval(parse_url($url, PHP_URL_QUERY));
  $user = strval(explode('=', $parseURL)[0]);

  echo "<div id='container'>";
  echo "<h2>Are you sure you want to delete user <span id='black'>".$user."</span>?</h2>";
  echo "<a href='adminPage.php'>Return to Admin Page</a>";
  echo '
  <div id="form">
    <form action="" method="post">
      <label for="password">Enter admin password to confirm user deletion.</label>
      <input name="password" type="password" id="password" required>';
  echo '<div class="error">'.$pass_err.'</div>';
  echo '<button type="submit">Delete</button>
    </form>
  </div>
  </div>
  ';
}else {
  isNotLoggedInAdmin();
}
   ?>

   <?php
   if(isset($_POST['password'])){
     $username = $_SESSION['valid_admin'];
     $password = SHA1($_POST['password']);

     global $pass_err;
     $pass_err = "";

     $selectUserPassQ = $db->prepare("SELECT COUNT(1) FROM user WHERE username = ? AND password = ?");
     $selectUserPassQ->bind_param("ss", $username, $password);

     if($selectUserPassQ->execute()){
       $selectUserPassQ->bind_result($count);
       $selectUserPassQ->fetch();
       $selectUserPassQ->close();

       if($count == 1){

         if($deleteQuery = $db->query("DELETE FROM user WHERE username='$user'")){
           echo "<script type='text/javascript'>alert('User successfully deleted!');</script>";
           header( "refresh:1;url=adminPage.php" );
         }else {
           echo "<div id='error'>";
           echo "<h1>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Deletion%20Error' target='_top'>Jaclyn Cao.</a></h1>";
           //echo $db->error();
           echo "</div>";
         }
       }else {
         $pass_err = "Password is wrong.";
       }
     }else {
       echo "<div id='error'>";
       echo "<h1>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Deletion%20Error' target='_top'>Jaclyn Cao.</a></h1>";
       //echo $db->error();
       echo "</div>";
     }
    }
    ?>
</body>
</html>
