<?php 
	require_once 'resources/dbconfig.php';
	session_start();
	if(isset($_SESSION["isLoggedIn"])){
		echo "User with id " . $_SESSION["id"] . " is now logged in.";
    	echo "User has privilege level of " . $_SESSION["privilege"];
	}
	else{
		echo "No user logged in / no session active.";
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<center><h1>ØL - Ølbowling Ligaen</h1></center>
<style type="text/css">
#nav {
	width: 40%;
	margin: 0 0 3em 0;
	margin-left: auto;
	margin-right:auto;
	padding: 0;
	list-style: none; }
#nav li {
	float: left;
}
#nav li a {
		display: block;
		padding: 8px 15px;
		text-decoration: none;
		font-weight: bold;
		color: #069;
		border-right: 1px solid #ccc; }
.resizedTextbox {width: 100px; height: 15px}
</style>
<ul id="nav">
	<li><a href="default.php">Rangliste</a></li>
	<li><a href="#">Stats</a></li>
	<li><a href="#">Regler</a></li>
	<?php
		if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == TRUE){
			echo "<li><a href='#'>Profil</a></li>";
		}
	?>
	<li>
		<?php
			if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == TRUE){
				echo "<a href='logout.php'>Log ud</a>";
			}
			else{
				echo "<a href='login.php'>Log ind / registrér</a>";

			}
		?>
	</li>
</ul></br>
<style type="text/css">
.fg{margin-left:auto;margin-right:auto; width:40%;margin-bottom: 1em}
.tg  {border-collapse:collapse;border-spacing:0;width:40%;margin-right: auto;margin-left: auto;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-e3zv{font-weight:bold}
</style>
<table class="tg">
  <tr>
    <th class="tg-e3zv">Navn</th>
    <th class="tg-e3zv">Rating</th>
    <th class="tg-e3zv">Rank</th>
  </tr>
<?php
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql = "SELECT id, username, rating FROM players ORDER BY rating DESC";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0){
		$i = 0;
		while($row = $result->fetch_assoc()){
			$i += 1;
			echo "<tr><td class=\"tg-031e\">" . $row["username"] . "</td>
			<td class=\"tg-031e\">" . $row["MMR"]. "</td>
			<td class=\"tg-031e\">" . $i . "</td>
			</tr>";
		}
	}
	else {
	    echo "0 results";
	}
	$conn->close();
?>
</table>
</br>
<form class="fg" action="functions/auth.php" method="POST">
Brugernavn: <input class="resizedTextbox" type="text" name="username">
Kodeord: <input class="resizedTextbox" type="password" name="password">
<input type="submit" value="Log ind">
</form>
</body>
</html>