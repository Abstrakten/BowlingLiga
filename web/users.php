<html>
<table>
  <tr>
    <th>id</th>
    <th>navn</th>
    <th>email</th>
  </tr>
<?php
require_once 'dbconfig.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, username, email FROM players";
$result = $conn->query($sql);

if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		echo "<tr><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["email"]. "</td></tr>";
	}
}
else {
    echo "0 results";
}
$conn->close();
?>
</table>
</html>