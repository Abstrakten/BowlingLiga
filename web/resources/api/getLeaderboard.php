<?php
	require_once '../dbconfig.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error){
		die("Connect failed: " . $conn->connect_error);
	}
	$sql = "SELECT id, username, rating FROM players ORDER BY rating DESC";
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
?>