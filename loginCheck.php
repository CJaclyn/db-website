<?php

function login(){
	if (isset($_POST['username']) && isset($_POST['password']))
	{
	  // if the user has just tried to log in
	  $username = $_POST['username'];
	  $password = $_POST['password'];

	  include('connection.php');

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
			<li><a href=\"adminLogin.html\">Admin</a></li>
		</ul>
	</nav>";

	echo '<div id="error"><h2>You need to login to see this page.</h2>';
	echo "<a href='login.php'>Login</a>";
	echo "<a href='index.html'>Go to homepage</a></div>";
}

?>
