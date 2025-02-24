<?php
  session_start();
  include('connection.php');
  include('loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Account</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="account.css">
<link href="https://fonts.googleapis.com/css?family=Cairo|Unica+One&display=swap" rel="stylesheet">

</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
    if (isLoggedIn()){
      $usersQuery = "SELECT firstname, lastname, DATE_FORMAT(birthday, '%b %e, %Y') birthday, college, major from user where username='".$username."'";

      $users = mysqli_query($db, $usersQuery);
      mysqli_query($db, $usersQuery) or die('Error querying database.');
      $row = mysqli_fetch_array($users);

      echo"<div id='container'>";
      echo "<h2>Your Account</h2>";
      echo "<div class='center'><img src='generic-user.png' width='150'></div>";
      echo "<h3>".$row['firstname']." ".$row['lastname']."</h3>";
      echo "<table>";
      echo "<tr><th>Birthday</th> <th>College</th> <th>Major</th> </tr>";
      echo "<td>".$row['birthday']."</td>";
      echo "<td>".$row['college']."</td>";
      echo "<td>".$row['major']."</td>";
      echo "</table>";
      echo "<div class='center'><a href='modifyacc.php'>Modify Information</a></div>";
      echo "</div>";

      mysqli_close($db);
    }
    else
    {
      notLoggedIn();
    }
  ?>
</body>
</html>
