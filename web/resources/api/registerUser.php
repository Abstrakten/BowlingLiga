<?php
require_once '../dbconfig.php';
require_once '../library/security.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(!isset($_POST["username"]) && !isset($_POST["password"]) && !isset($_POST["email"])){
    die("Username, password and email must be provided.");
}
$name = mysqli_escape_string($conn, $_POST["username"]);
$pass = mysqli_escape_string($conn, hash("sha256", $salt1.$_POST["password"].$salt2));
$email = mysqli_escape_string($conn, $_POST["email"]);
$sql = "INSERT INTO players (username, password, email)
VALUES ('$name', '$pass', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Success!";

} else {
    echo $conn->error;
}
$conn->close();
?>