<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '12345');
define('DB_NAME', 'ics311fa190304');


$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

/*for ssh website
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ics311fa190304');
define('DB_PASSWORD', '8736');
define('DB_NAME', 'ics311fa190304');


$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
*/
?>
