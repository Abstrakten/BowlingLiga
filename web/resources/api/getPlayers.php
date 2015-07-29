<table>
    <tr>
        <th>id</th>
        <th>username</th>
        <th>email</th>
        <th>phone</th>
        <th>beersdrunk</th>
        <th>won_games</th>
        <th>lost_games</th>
        <th>Win Rate</th>
        <th>rating</th>
        <th>registered_on</th>
    </tr>
<?php
	require_once '../dbconfig.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error){
        die("Connect failed: " . $conn->connect_error);
    }
	$sql = "SELECT * FROM players ORDER BY registered_on DESC";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
        $i = 0;
        $data = array();
        while ($row = $result->fetch_assoc() ){
            echo "<tr>
            <td>" .$row['id'] ."</td>
            <td>" .$row['username'] ."</td>
            <td>" .$row['email'] ."</td>
            <td>" .$row['phone'] ."</td>
            <td>" .$row['beersdrunk'] ."</td>
            <td>" .$row['won_games'] ."</td>
            <td>" .$row['lost_games'] ."</td>";
            $total = $row['lost_games'] + $row['won_games'];
            if ($total != 0){ $wr = ($row['won_games'] / $total) * 100 . " %"; }
            else{ $wr = "N/A"; }
            echo "<td>" . $wr  ."</td>
            <td>" .$row['rating'] ."</td>
            <td>" .$row['registered_on'] ."</td>
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