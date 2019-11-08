<!DOCTYPE html>
<html lang="en">
<head>
<title>User Information</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="userInfo.css">
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
  echo "<h2>"."User Information - ".$user."</h2>";

  //$db = mysqli_connect('localhost', 'ics311fa190304', '8736', 'ics311fa190304') or die('Error connecting to MySQL server.');
  $db = mysqli_connect('localhost', 'root', '12345', 'ics311fa190304') or die('Error connecting to MySQL server.');
  $usersQuery = "SELECT firstname, lastname, DATE_FORMAT(birthday, '%b %e, %Y') birthday, college, major from user where username='$user'";

  $users = mysqli_query($db, $usersQuery);
  mysqli_query($db, $usersQuery) or die('Error querying database.');
  $row = mysqli_fetch_array($users);

  echo"<div id='container'>";
  echo "<div class='center'><img src='generic-user.png' width='150'></div>";
  echo "<h3>".$row['firstname']." ".$row['lastname']."</h3>";
  echo "<table>";
  echo "<tr><th>Birthday</th> <th>College</th> <th>Major</th> </tr>";
  echo "<td>".$row['birthday']."</td>";
  echo "<td>".$row['college']."</td>";
  echo "<td>".$row['major']."</td>";
  echo "</table>";
  echo "<form method=\"get\" action=\"deleteUser.php\">";
  echo "<div class='center'>";
  echo "<button type=\"submit\" name='".$user."'>"."Delete User</button>";
  echo "</div>";
  echo "</form>";
  echo "</div>";

  mysqli_close($db);
   ?>
</body>
</html>
