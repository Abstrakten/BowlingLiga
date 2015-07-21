<?php
	require_once '../dbconfig.php';
	require_once '../library/security.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	$name = mysqli_escape_string($conn, $_POST["username"]);
	$pass = mysqli_escape_string($conn, $_POST["password"]);
	$sql = "SELECT * FROM players WHERE username = '$name'";
	$result = $conn->query($sql);
	if ($result === FALSE) {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	else{
		$currentUser = $result->fetch_assoc();
		if(hash("sha256", $salt1.$pass.$salt2) == $currentUser["password"]){
			header('Content-Type: application/json');
    		echo json_encode($currentUser);
		}
		else{
			die("Username and/or password combination does not exist.");
		}
	}
	$conn->close();
?>