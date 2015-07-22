<?php
// Debug
ob_start();
require_once '../dbconfig.php';
require_once '../library/security.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// User credentials
$name = mysqli_escape_string($conn, $_POST["username"]);
$pass = mysqli_escape_string($conn, $_POST["password"]);
// Debug
//var_dump($name);
//var_dump($pass);

// Game details
$score1 = $_POST["score1"];       // score1
$score2 = $_POST["score2"];       // score2
if($_POST["hasTeams"] == 'TRUE'){
    // Debug
    // echo "has teams </br>";
    $team1 = mysqli_escape_string($conn, $_POST["team1"]);
    $team2 = mysqli_escape_string($conn, $_POST["team2"]);
    if (authUser($conn, $name, $pass) === FALSE) {
        die("Username and password combination invalid.</br>");
    }
    else{
        // Debug
        //echo "Authenticated successfully... </br>";
        // get ids of the teams TODO: use team names asa identifier, since they are unique ?
        $teamId1 = $conn->query("SELECT id FROM teams WHERE name = '$team1'");
        $teamId2 = $conn->query("SELECT id FROM teams WHERE name = '$team2'");
        $team1 = $teamId1->fetch_assoc();
        $team2 = $teamId2->fetch_assoc();

        $team1 = $team1["id"];
        $team2 = $team2["id"];
        // debug
        echo "Team 1 id is: " . $team1 . " </br>";
        echo "Team 2 id is: " . $team2 . "</br>";
        if(empty($team1) || empty($team2)){
            die("One of the teams does not exist.</br>");
        }
        $sql = "INSERT INTO games (team1, team2, score1, score2)
                VALUES ('$team1', '$team2', '$score1', '$score2')";

        if ($conn->query($sql) === TRUE) {
            echo "Success!";
        } else {
            echo $conn->error;
        }
        $conn->close();
    }
}
else{
    // Debug
    // echo "has NO teams... </br>";
    if (authUser($conn, $name, $pass) === FALSE){
        die("Username and password combination invalid.</br>");
    }
    else{
        //echo 'Authentication successfull!';
        //echo "Authenticated successfully</br>";
        $player1 = $_POST["player1"];     // team1
        $player2 = $_POST["player2"];     // team1
        $player3 = $_POST["player3"];     // team2
        $player4 = $_POST["player4"];     // team2

        // Get ids of players
        $player1 = $conn->query("SELECT id FROM players WHERE username = '$player1' ")->fetch_assoc()["id"];
        $player2 = $conn->query("SELECT id FROM players WHERE username = '$player2' ")->fetch_assoc()["id"];
        $player3 = $conn->query("SELECT id FROM players WHERE username = '$player3' ")->fetch_assoc()["id"];
        $player4 = $conn->query("SELECT id FROM players WHERE username = '$player4' ")->fetch_assoc()["id"];

        // Debug
        //var_dump("player1 is " . $player1) ."</br>";
        //var_dump("player2 is " . $player2). "</br>";
        //var_dump("player3 is " . $player3). "</br>";
        //var_dump("player4 is " . $player4). "</br>";
        // TODO: fix method of submission, so that one team can be selected by player an other team can be selected as
        // Premade team.
        if (empty($player1) || empty($player2) || empty($player3) || empty($player4)){
            die("one of the players does not exist.</br>");
        }
        // Try to find existing teams based on player ids
        $teamId1 = $conn->query("SELECT id
                    FROM teams
                    WHERE (player1 = '$player1' AND player2 = '$player2')
                    OR (player1 = '$player2' AND player2 = '$player1')");
        if($teamId1 === FALSE){
            die("No existing teams exist for player with id " . $player1 . " and " . $player2);
        }
        else {
            $teamId1 = $teamId1->fetch_assoc()['id'];
        }
        $teamId2 = $conn->query("SELECT id
                    FROM teams
                    WHERE (player1 = '$player3' AND player2 = '$player4')
                    OR (player1 = '$player4' AND player2 = '$player3')");
        if($teamId2 === FALSE){
            die("No existing teams exist for player with id " . $player3 . " and " . $player4);
        }
        else {
            $teamId2 = $teamId2->fetch_assoc()['id'];
        }
        // Debug
        //var_dump("teamId1 is ". $teamId1) ;
        //var_dump("teamId2 is ". $teamId2) ;

        // Prepare submission of new game
        date_default_timezone_set('Europe/Copenhagen');
        // Old
        //$time = date('m/d/Y h:i:s a', time());
        // Convert to sql format
        $time = date('Y-m-d H:i:s', time());
        $sql = "INSERT INTO games (team1, team2, score1, score2, played_on)
                VALUES ('$teamId1', '$teamId2', '$score1', '$score2', '$time')";
        if ($conn->query($sql) === TRUE) {
            echo "Success!";
        } else {
            echo $conn->error;
        }
        $conn->close();
    }
}
?>