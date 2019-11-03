<!DOCTYPE html>
<html lang="en">
<head>
<title>User Information</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="adminPage.css">
</head>
<body>
  <h2>Homework Tracker</h2>
  <nav>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="assignments.html">Assignments</a>
      </li>
      <li><a href="register.html">Register</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="admin.php">Admin</a></li>
    </ul>
  </nav>

  <?php
  $url = $_SERVER['REQUEST_URI'];
  $parseURL = strval(parse_url($url, PHP_URL_QUERY));
  $remove = strval(explode('%3E', $parseURL)[1]);
  $user = strval(explode('=', $remove)[0]);
  echo "<h1>"."User Information - ".$user."</h1>";

  //$db = mysqli_connect('localhost', 'ics311fa190304', '8736', 'ics311fa190304') or die('Error connecting to MySQL server.');
  $db = mysqli_connect('localhost', 'root', '12345', 'ics311fa190304') or die('Error connecting to MySQL server.');
  $usersQuery = "SELECT email, birthday, college, major from user where username='$user'";

  $users = mysqli_query($db, $usersQuery);
  mysqli_query($db, $usersQuery) or die('Error querying database.');

  echo "<table>";
  echo "<tr> <th>Email</th> <th>Birthday</th> <th>College</th> <th>Major</th> </tr>";
  while ($row = mysqli_fetch_array($users)) {
    echo "<tr>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['birthday']."</td>";
    echo "<td>".$row['college']."</td>";
    echo "<td>".$row['major']."</td>";
    echo "</tr>";
  }
  echo "</table>";
  mysqli_close($db);
   ?>
</body>
</html>
