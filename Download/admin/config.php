<?php
// Setting up the time zone
date_default_timezone_set('Africa/Lagos');

// Host Name
$dbhost = 'localhost';

// Database Name
$dbname = 'videos';

// Database Username
$dbuser = 'mysql796.umbler.com';

// Database Password
$dbpass = '57bvbr6xgm';

// Defining base url, you must end with a slash "/"
define("BASE_URL", "https://buumgames.com/");

// Getting Admin url
define("ADMIN_URL", BASE_URL . "admin" . "/");

//the journey into the database begins here, hop in :)
try {
    $pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
    echo "Connection error :" . $excepiton->getMessage();
}
?>