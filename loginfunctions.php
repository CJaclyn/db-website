<?php
include('functions.php');
include_once("connection.php");

function login(){
  include_once("connection.php");
  if (isset($_POST['username']) && isset($_POST['password']))
  {
    $username = htmlspecialchars($_POST['username']);
    $password = SHA1($_POST['password']);

    global $user_err, $pass_err;
    $user_err = $pass_err = "";

    if(usernameRegex($username)){
      $selectUserQ = $db->prepare("SELECT COUNT(1) FROM user WHERE username = ? AND admin = 0");
      $selectUserQ->bind_param("s", $username);

      if($selectUserQ->execute()){
        $selectUserQ->bind_result($count);
        $selectUserQ->fetch();
        $selectUserQ->close();

        if($count == 1){
          $selectUserPassQ = $db->prepare("SELECT COUNT(1) FROM user
          WHERE username = ? AND password = ? AND admin = 0");
          $selectUserPassQ->bind_param("ss", $username, $password);

          if($selectUserPassQ->execute()){
            $selectUserPassQ->bind_result($count);
            $selectUserPassQ->fetch();

            if($count == 1){
              $_SESSION['reg_user'] = $username;
              $_SESSION['loggedin'] = true;

            }else {
              $pass_err = "Password is wrong.";
            }
          }else {
            echo $db->error();
          }
        }else {
          $user_err = "Regular user does not exist.";
        }
      }else {
        echo $db->error();
      }
    }else {
      $user_err = "Invalid username.";
    }
  }
}

function isLoggedIn(){
    if(isset($_SESSION['reg_user'])) {
      global $username;
      $username = $_SESSION['reg_user'];
      echo "
  		<nav>
  		  <ul>
          <li><a href=\"index.php\">Home</a></li>
          <li><a href=\"assignments.php\">Assignments</a></li>
          <li><a href=\"classes.php\">Classes</a></li>
          <li><a href=\"account.php\"><span id='user'>$username</span></a></li>
          <li><a href=\"logout.php\">Logout</a></li>
  		  </ul>
  		</nav>";

      return true;
    }elseif(isset($_SESSION['valid_admin'])) {
      $username = $_SESSION['valid_admin'];
      echo "
      <nav>
        <ul>
          <li><a href=\"index.php\">Home</a></li>
          <li><a href=\"adminPage.php\"><span id='user'>$username</span></a></li>
          <li><a href=\"logout.php\">Logout</a></li>
        </ul>
      </nav>";

      return true;

    }else {
      echo "
      <nav>
        <ul>
          <li><a href=\"index.php\">Home</a></li>
          <li><a href=\"register.php\">Register</a></li>
          <li><a href=\"login.php\">Login</a></li>
          <li><a href=\"adminlogin.php\">Admin</a></li>
        </ul>
      </nav>";

    return false;
  }
}

function notLoggedIn() {
  header("Location: index.php");
}

function logout(){
  if (isset($_SESSION['loggedin'])) {
  $_SESSION = array();
  session_destroy();
  }
}

/*admin login functions*/
function loginAdmin(){
  include_once("connection.php");
  if (isset($_POST['username']) && isset($_POST['password']))
  {
    $username = htmlspecialchars($_POST['username']);
    $password = SHA1($_POST['password']);

    global $user_err, $pass_err;
    $user_err = $pass_err = "";

    if(usernameRegex($username)){
      $selectUserQ = $db->prepare("SELECT COUNT(1) FROM user WHERE username = ? AND admin = 1");
      $selectUserQ->bind_param("s", $username);

      if($selectUserQ->execute()){
        $selectUserQ->bind_result($count);
        $selectUserQ->fetch();
        $selectUserQ->close();

        if($count == 1){
          $selectUserPassQ = $db->prepare("SELECT COUNT(1) FROM user
          WHERE username = ? AND password = ? AND admin = 1");
          $selectUserPassQ->bind_param("ss", $username, $password);

          if($selectUserPassQ->execute()){
            $selectUserPassQ->bind_result($count);
            $selectUserPassQ->fetch();

            if($count == 1){
              $_SESSION['valid_admin'] = $username;
              $_SESSION['loggedin'] = true;

            }else {
              $pass_err = "Password is wrong.";
            }
          }else {
            echo $db->error();
          }
        }else {
          $user_err = "User does not exist or is not an admin.";
        }
      }else {
        echo $db->error();
      }
    }else {
      $user_err = "Invalid username.";
    }
  }
}

function isLoggedInAdmin(){
  if(isset($_SESSION['valid_admin'])) {
    $username = $_SESSION['valid_admin'];
    echo "
    <nav>
      <ul>
        <li><a href=\"index.php\">Home</a></li>
        <li><a href=\"adminPage.php\"><span id='user'>$username</span></a></li>
        <li><a href=\"logout.php\">Logout</a></li>
      </ul>
    </nav>";

    return true;
  }else {
    return false;
  }
}

function isNotLoggedInAdmin() {
  if(!isset($_SESSION['valid_admin'])) {
    header('Location:index.php');
    return true;

  }else {
    return false;
  }
}

 ?>
