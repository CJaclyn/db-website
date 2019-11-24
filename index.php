<?php
session_start();
include('loginfunctions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="homepage.css">
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
</head>
<body>
  <h1>Homework Tracker</h1>
  <?php isLoggedIn() ?>
  <header>
  <div class='row'>
    <div class='column l'>
      <img src='/db-website/header-home.jpeg'>
    </div>
    <div class='column r'>
      <h2>Never forget to do your homework again.</h2>
      <p>

      </p>
    </div>
  </div>
  </header>

</body>
</html>
