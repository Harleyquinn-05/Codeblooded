<?php
// db.php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "skill_swap_platform";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
