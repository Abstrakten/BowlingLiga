<?php
require_once '../dbconfig.php';
require_once '../library/security.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// TODO: expand implementation
// 1. Authenticate user credentials
// 2. Check if either player1 or player2 is the registering user
// 3. Check for existing team with this player combination.

if(!isset($_POST["name"]) && !isset($_POST["player1"]) && !isset($_POST["player2"])){
    die("Must provide team name and two players.");
}
// Sanitize input
$name = mysqli_escape_string($conn, $_POST["name"]);
$player1 = mysqli_escape_string($conn, $_POST["player1"]);
$player2 = mysqli_escape_string($conn, $_POST["player2"]);

// Get the current time.
date_default_timezone_set('Europe/Copenhagen');
$time = date('Y-m-d H:i:s', time());
$sql = "INSERT INTO teams (name, player1, player2, created_on)
VALUES ('$name', '$player1', '$player2', '$time')";

// Perform query to DB
if ($conn->query($sql) === TRUE) {
    echo "Success!";

} else {
    echo $conn->error;
}
$conn->close();