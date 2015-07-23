<table>
    <tr>
        <th>id</th>
        <th>team 1</th>
        <th>team 2</th>
        <th>score 1</th>
        <th>score 2</th>
        <th>played on</th>
    </tr>
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
            echo "<tr>
            <td>" .$row['id'] ."</td>
            <td>" .$row['team1'] ."</td>
            <td>" .$row['team2'] ."</td>
            <td>" .$row['score1'] ."</td>
            <td>" .$row['score2'] ."</td>
            <td>" .$row['played_on'] ."</td>
            </tr>";
            //$data[] = json_encode($row);
        }
        //echo json_encode($data);
    }
    else {
        echo "0 results";
    }
	$conn->close();