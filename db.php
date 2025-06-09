<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db"; // Replace this with your actual database name if different

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
