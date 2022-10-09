<?php
$servername = "db";
$username = "db";
$password = "db";
$db = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}