<?php
  session_start();
  include('connection.php');
  include('loginfunctions.php');
  global $collegemajor_err;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Modify Account</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="modifyaccount.css">
<link rel="stylesheet" href="inputerror.css">

</head>
<body>
  <h1>Homework Tracker</h1>

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $choice = htmlspecialchars($_POST['choice']);
    $input = htmlspecialchars($_POST['new-info']);
    $username = $_SESSION['reg_user'];
    global $collegemajor_err;
    $collegemajor_err = "";

    if(regexCheck($input)){
      if($choice == 'college'){
        $updateCollegeQ = $db->prepare("UPDATE user SET college = ? WHERE username = ?");
        $updateCollegeQ->bind_param("ss", $input, $username);

        if($updateCollegeQ->execute()){
          echo "<script type='text/javascript'>alert('College successfully changed!');</script>";
          header( "refresh:1;url=account.php" );
        } else{
            //echo mysqli_error($db);
            echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
        }
      }
      if($choice == 'major'){
        $updateMajorQ = $db->prepare("UPDATE user SET major = ? WHERE username = ?");
        $updateMajorQ->bind_param("ss", $input, $username);

        if($updateMajorQ->execute()){
            echo "<script type='text/javascript'>alert('Major successfully changed!');</script>";
            header( "refresh:1;url=account.php" );
        } else{
            //echo mysqli_error($db);
            echo "<h2>There was an error, please contact <a href='mailto:eq6679uu@metrostate.edu?Subject=Error' target='_top'>Jaclyn Cao.</a></h2>";
        }
      }
    }else {
      $collegemajor_err = "Input can only have letters, numbers, periods, hyphens, single quotes, and spaces.";
    }
  }
   ?>

  <?php
  if (isLoggedIn()){
      echo "<h2>Modify Account Information</h2>";

      echo "
        <form method='POST' action=''>
          <label for='choice'>What to Modify</label>
          <select name='choice' id='choice'>
            <option value='college'>College</option>
            <option value='major'>Major</option>
            </select>
          <label for='new-info'>Enter New Information</label>
          <input type='text' name='new-info' id='new-info'></input>";
          echo "<div class='error'>".$collegemajor_err."</div>";
          echo"<button type='submit'>Modify</button>
        </form>";

        echo "<div id='centered'><a href='account.php'>Go Back</a></div>";
    }

    else
    {
      notLoggedIn();
    }
  ?>
</body>
</html>
