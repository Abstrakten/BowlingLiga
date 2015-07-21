<?php
	require_once '../dbconfig.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	$name = mysqli_escape_string($conn, $_POST["username"]);
	$pass = mysqli_escape_string($conn, $_POST["password"]);
	$salt1 = "hK-5F/9$%Z]Y1>j";
	$salt2 = "L{>4-(V}#O5*d@K";
	$sql = "SELECT id, username, password, privilege FROM players WHERE username = '$name'";
	$result = $conn->query($sql);
	if ($result === FALSE) {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	} 
	else{
		$currentUser = $result->fetch_assoc();
		if(hash("sha256", $salt1.$pass.$salt2) == $currentUser["password"]){
			session_start();
    		$_SESSION["id"] = $currentUser["id"];
    		$_SESSION["user"] = $currentUser["username"];
    		$_SESSION["isLoggedIn"] = TRUE;
    		$_SESSION["privilege"] = $currentUser["privilege"];
    		echo "User with id " . $currentUser["id"] . " is now logged in.";
    		echo "User has privilege level of " . $_SESSION["privilege"];
    		header("Location: http://127.0.0.1/projects/OBL/default.php");
		}
		else{
			die("Username and/or password combination does not exist.");
		}

	}
	$conn->close();
?>	