<?php
	$salt1 = "hK-5F/9$%Z]Y1>j";
	$salt2 = "L{>4-(V}#O5*d@K";
	function authUser($conn, $name, $pass){
		global $salt1, $salt2;
		$sql = "SELECT * FROM players WHERE username = '$name'";
		$result = $conn->query($sql);
		if ($result === FALSE) {
			die("Error:" . $conn->error);
			return FALSE;
		}
		$currentUser = $result->fetch_assoc();
		if(hash("sha256", $salt1.$pass.$salt2) == $currentUser["password"]){
			header('Content-Type: application/json');
			return TRUE;
		}
		else{
			return FALSE;
		}
		$conn->close();
	}
?>