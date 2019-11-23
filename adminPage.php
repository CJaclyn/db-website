<?php
session_start();
include('connection.php');
include('loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="adminPage.css">
</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  if(isLoggedInAdmin()){
    $usersQuery = "SELECT username, email, create_time from user";

    $users = mysqli_query($db, $usersQuery);
    mysqli_query($db, $usersQuery) or die('Error querying database.');

    echo "<form method=\"get\" action=\"userInfo.php\">";
    echo "<table>";
    echo "<tr> <th>Username</th> <th>Email</th> <th>Timestamp Created</th> </tr>";
    while ($row = mysqli_fetch_array($users)) {
      echo "<tr>";
      echo "<td>".$row['username']."</td>";
      echo "<td>".$row['email']."</td>";
      echo "<td>".$row['create_time']."</td>";
      echo "<td><button type=\"submit\" name='".$row['username']."'>"."View More</button></td>";
      echo "</tr>";
    }
      echo "</table>";
      echo "</form>";
    mysqli_close($db);
  }else {
    isNotLoggedInAdmin();
  }

   ?>
</body>
</html>
