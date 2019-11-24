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
<link href="https://fonts.googleapis.com/css?family=Cairo|Unica+One&display=swap" rel="stylesheet">
</head>
<body>
  <h1>Homework Tracker</h1>
  <?php isLoggedIn() ?>
  <div class='row'>
    <header>
      <div class='column l'>
        <img src='/db-website/header-home.jpeg' alt='picture of notebook, pen, and phone, on a table'>
      </div>
      <div class='column r'>
        <h2>Never forget to do your homework again.</h2>
      </div>
    </header>
  </div>
    <div class='row'>
    <div class='column l'>
      <p>
        Are you tired of accidentally forgetting to turn in your homework?
        There is just too many assignments and due dates to keep track of
        in college. Homework Tracker will help you keep track of your homework,
        quizzes, projects, and tests. It will keep your assignments & classes
        organized in one place. It is easy and helpful to use.
        <div id = 'centered'><a href='register.php'>Sign up</a> for an account today!</div>
      </p>
    </div>
    <div class='column r'>
      <img src='/db-website/pic2.jpeg' alt='picture with books, glasses, plants'>
    </div>
  </div>
  <div class='row'>
    <div class='column l'>
      <img src='/db-website/aboutpic.jpeg' alt='picture of a forest with mountain in the background'>
    </div>
    <div class='column r'>
      <h2>About the Creator</h2>
      <p>My name is Jaclyn. I was born and raise in Minnesota and have lived here
        my whole life. I have a dog named Toto who is 12 years old. I enjoy playing
        video games, gardening, traveling, and nature. I also like to create websites!
        I came up with this idea for my database project because I have trouble
        remembering to do things if I don't put them down somewhere such as
        my phone and computer. I chose the color scheme I did for the website because
        earthy tones are chill which can help the user be less stressed when using
        the website.
      </p>
    </div>
  </div>

</body>
</html>
