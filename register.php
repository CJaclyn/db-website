<?php
  session_start();
  include('loginfunctions.php');
  include('connection.php');
  global $fname_err, $lname_err, $college_err, $major_err, $user_err, $exists_err;
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $fName = htmlspecialchars($_POST['firstname']);
  $lName = htmlspecialchars($_POST['lastname']);
  $birthday = $_POST['birthday'];
  $college = htmlspecialchars($_POST['college']);
  $major = htmlspecialchars($_POST['major']);
  $email = $_POST['email'];
  $username = htmlspecialchars($_POST['username']);
  $password = SHA1($_POST['password']);

  global $fname_err, $lname_err, $college_err, $major_err, $user_err, $exists_err;
  $fname_err = $lname_err = $college_err = $major_err = $user_err = $exists_err = "";

  if(nameRegex($fName) && nameRegex($lName) && regexCheck($college) && regexCheck($major) && usernameRegex($username)){
    $selectQ = $db->prepare("SELECT COUNT(1) FROM user WHERE username = ?");
    $selectQ->bind_param("s", $username);

    if($selectQ->execute()){
      $selectQ->bind_result($count);
      $selectQ->fetch();
      $selectQ->close();

      if($count == 0){
        $formQ = $db->prepare("INSERT INTO user(username, password, email, firstname, lastname, birthday, college, major)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $formQ->bind_param("ssssssss", $username, $password, $email, $fName, $lName, $birthday, $college, $major);

        if($formQ->execute()){
          echo "<script type='text/javascript'>alert('Successfully registered!');</script>";
          header( "refresh:.5;url=login.php" );

        }else {
          echo "<div class='errormsg'>";
          echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
          echo "</div>";
          echo "poop";
          echo mysqli_error($db);
        }
      }else {
        $exists_err = "Username already exists.";
      }
    }else {
      echo "<div class='errormsg'>";
      echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
      echo "</div>";
      echo mysqli_error($db);
    }
    $db->close();

  }if(!nameRegex($fName)) {
    $fname_err = "First name can only have letters, hyphens, spaces, and or periods.";
  }if(!nameRegex($lName)) {
    $lname_err = "Last name can only have letters, hyphens, spaces, and or periods.";
  }if(!regexCheck($college)) {
    $college_err = "College can only have letters, numbers, periods, hyphens, single quotes, and spaces.";
  }if(!regexCheck($major)) {
    $major_err = "Major can only have letters, numbers, periods, hyphens, single quotes, and spaces.";
  }if(!usernameRegex($username)) {
    $user_err = "Username can only have letters, numbers, and or underscores.";
  }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Register</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="register.css">
<link rel="stylesheet" href="inputerror.css">
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
</head>
<body>
<h1>Homework Tracker</h1>
<?php
  if(isLoggedIn()){
    header('location:index.php');
  }
?>
  <div class="form">
  <h2>Create an Account</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="userForm">
    <fieldset>
      <legend>Personal Information</legend>
      <label for="firstname">First Name *</label>
      <input name="firstname" type="text" id="firstname" maxlength="15" required>
      <?php echo "<div class='error'>".$fname_err."</div>"; ?>

      <label for="lastname">Last Name *</label>
      <input name="lastname" type="text" id="lastname" maxlength="20" required>
      <?php echo "<div class='error'>".$lname_err."</div>"; ?>

      <label for="birthday">Birthday *</label><br>
      <input name="birthday" type="date" id="birthday" required>
    </fieldset>
    <fieldset>
      <legend>School Information</legend>
      <label for="college">College *</label>
      <input name="college" type="text" id="college" maxlength="40" required>
      <?php echo "<div class='error'>".$college_err."</div>"; ?>

      <label for="major">Major *</label>
      <input name="major" type="text" id="major" maxlength="30">
      <?php echo "<div class='error'>".$major_err."</div>"; ?>

    </fieldset>
    <fieldset>
      <legend>Account Information</legend>
      <label for="email">Email *</label>
      <input name="email" type="email" id="email" maxlength="45" required> <br>
      <label for="username">Username *</label>
      <input name="username" type="text" id="username" minlength="3" maxlength="20" required>
      <?php echo "<div class='error'>".$exists_err."</div>";
            echo "<div class='error'>".$user_err."</div>"; ?>

      <label for="password">Password *</label><br>
      <input name="password" type="password" id="password" minlength="5" maxlength="20" required>
    </fieldset>
    <h4>* Required</h4>
    <button type="submit">Sign-up</button>
  </form>
  </div>
</body>
</html>
