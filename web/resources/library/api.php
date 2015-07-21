<?php
	require_once 'classes.php';
	
	function createPlayer($user, $pass, $email){
		require_once './dbconfig.php';
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		} 		
		// Input validation + sanitize input
		$username = mysqli_escape_string($conn, $user);
		$pass = mysqli_escape_string($conn, $pass);
		$email = mysqli_escape_string($conn, $email);
		// Perform query
		$sql = "INSERT INTO players (username, password, email)
		VALUES ('$user', '$pass', '$email')";
		if ($conn->query($sql) === TRUE) {
			$conn->close();
		    return TRUE;
		}
		else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		    $conn->close();
		    return FALSE;
		}
		$conn->close();
	}
	function getRankings(){
		require_once '../dbconfig.php';
		$conn = new mysqli($servername, $username, $password, $dbname);
		if($conn->connect_error){
			die("Connect failed: " . $conn->connect_error);
		}
		$sql = "SELECT id, username, MMR FROM players ORDER BY MMR DESC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$i = 0;
			$data = array();
			while ($row = $result->fetch_assoc() ){
    			$data[] = json_encode($row);
			}
			echo json_encode($data);
		}
		else {
	    	echo "0 results";
		}
	$conn->close();
	}
	function authPlayer($name, $pass){
		require_once '../dbconfig.php';
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		}
		$name = mysqli_escape_string($conn, $name);
		$pass = mysqli_escape_string($conn, $pass);
		$salt1 = "hK-5F/9$%Z]Y1>j";
		$salt2 = "L{>4-(V}#O5*d@K";
		$sql = "SELECT id, username, password, privilege FROM players WHERE username = '$name'";
		$result = $conn->query($sql);
		if ($result === FALSE) {
	    	echo "Error: " . $sql . "<br>" . $conn->error;
		} 
		else{
			$currentUser = $result->fetch_assoc();
			//echo "db password";
			//var_dump($currentUser["password"]);
			//echo "try pw";
			if(hash("sha256", $salt1.$pass.$salt2) == $currentUser["password"]){
				echo json_encode($currentUser);
			}
			else{
				die("Username and/or password combination does not exist.");
			}
		}
		$conn->close();
	}
?>