<!DOCTYPE html>
<html lang="en">
<head>
<title>Register</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="register.css">
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

  <div class="form">
  <h1>Create an Account</h1>
  <form action="registerResult.php" method="post">
    <fieldset>
      <legend>Personal Information</legend>
      <label for="firstname">First Name *</label>
      <input name="firstname" type="text" id="firstname" maxlength="15" >
      <label for="lastname">Last Name *</label>
      <input name="lastname" type="text" id="lastname" maxlength="20" >
      <label for="birthday">Birthday *</label><br>
      <input name="birthday" type="date" id="birthday"
    </fieldset>
    <fieldset>
      <legend>School Information</legend>
      <label for="college">College *</label>
      <input name="college" type="text" id="college" maxlength="40">
      <label for="major">Major *</label>
      <input name="major" type="text" id="major" maxlength="30">
    </fieldset>
    <fieldset>
      <legend>Account Information</legend>
      <label for="email">Email *</label>
      <input name="email" type="email" id="email" maxlength="45" > <br>
      <label for="username">Username *</label>
      <input name="username" type="text" id="username" minlength="3" maxlength="20" >
      <label for="password">Password *</label><br>
      <input name="password" type="password" id="password" minlength="5" maxlength="20" >
    </fieldset>
    <p>* Required</p>
    <button type="submit">Sign-up</button>
  </form>
  </div>
</body>
</html>
