<?php

function login(){
	if (isset($_POST['username']) && isset($_POST['password']))
	{
	  // if the user has just tried to log in
	  $username = $_POST['username'];
	  $password = $_POST['password'];

	  //$db = mysqli_connect('localhost', 'ics311fa190304', '8736', 'ics311fa190304') or die('Error connecting to MySQL server.');
	  $db = mysqli_connect('localhost', 'root', '12345', 'ics311fa190304') or die('Error connecting to MySQL server.');

	  $query = "SELECT * FROM user WHERE
	  username='".$username."' AND
	  password='".$password."'";

	  $result = $db->query($query);
	  if ($result->num_rows)
	  {
	    $_SESSION['valid_user'] = $username;
	  }
	  $db->close();
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['valid_user'])) {
		return true;
	}else{
		return false;
	}
}

function logOut()
{
  if (isset($_SESSION['valid_user'])) {
    unset($_SESSION['valid_user']);
    session_destroy();
  }
}

function notLoggedIn(){
	echo
	"<nav>
		<ul>
			<li><a href=\"index.html\">Home</a></li>
			<li><a href=\"register.html\">Sign-up</a></li>
			<li><a href=\"login.php\">Login</a></li>
			<li><a href=\"about.html\">About</a></li>
			<li><a href=\"adminLogin.html\">Admin</a></li>
		</ul>
	</nav>";

	echo '<div id="error"><h1>You need to login to see this page.</h1>';
	echo "<a href='login.php'>Login</a>";
	echo "<a href='index.html'>Go to homepage</a></div>";
}

?>
