<?php
require_once '../dbconfig.php';
require_once 'functions/security.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$name = mysqli_escape_string($conn, $_POST["username"]);
$pass = mysqli_escape_string($conn, hash("sha256", $salt1.$_POST["password"].$salt2));
$email = mysqli_escape_string($conn, $_POST["email"]);
$sql = "INSERT INTO users (username, password, email)
VALUES ('$name', '$pass', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Success!";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>