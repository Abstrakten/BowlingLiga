<?php
	require_once '../dbconfig.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error){
        die("Connect failed: " . $conn->connect_error);
    }
	$sql = "SELECT * FROM games ORDER BY played_on DESC";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
        $i = 0;
        $data = array();
        while ($row = $result->fetch_assoc() ){
            echo "team with id " . $row['team1'] . " vs " . "team with id " . $row['team2'] . " with a score of " . $row['score1'] . ":" . $row['score2'] . " played at " . $row['played_on'] . "</br>";
            //$data[] = json_encode($row);
        }
        //echo json_encode($data);
    }
    else {
        echo "0 results";
    }
	$conn->close();