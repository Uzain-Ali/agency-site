<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "agency";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

session_start();



// Directory constants
define('ROOT_PATH', dirname(__FILE__)); 
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('ADMIN_PATH', ROOT_PATH . '/admin');
define('ACTIONS_PATH', ROOT_PATH . '/actions');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('UPLOAD_PATH', ROOT_PATH . '/uploads');
define('ASSETS_PATH', PUBLIC_PATH . '/assets');


// URL constants (adjust if your site is in a subfolder)
define('BASE_URL', '/agency-site');
define('PUBLIC_URL', BASE_URL . '/public');
define('ADMIN_URL', BASE_URL . '/admin');
define('ACTIONS_URL', BASE_URL . '/actions');
define('UPLOAD_URL', BASE_URL . '/uploads');
define('ASSETS_URL', PUBLIC_URL . '/assets');
?>
