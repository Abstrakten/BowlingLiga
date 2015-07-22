<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>player1</th>
        <th>player2</th>
        <th>rating</th>
        <th>created_on</th>
    </tr>
<?php
	require_once '../dbconfig.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error){
        die("Connect failed: " . $conn->connect_error);
    }
	$sql = "SELECT * FROM teams ORDER BY created_on DESC";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
        $i = 0;
        $data = array();
        while ($row = $result->fetch_assoc() ){
            echo "<tr>
            <td>" .$row['id'] ."</td>
            <td>" .$row['name'] ."</td>
            <td>" .$row['player1'] ."</td>
            <td>" .$row['player2'] ."</td>
            <td>" .$row['rating'] ."</td>
            <td>" .$row['created_on'] ."</td>
            </tr>";
            //$data[] = json_encode($row);
        }
        //echo json_encode($data);
    }
    else {
        echo "0 results";
    }
	$conn->close();
?>
</table>