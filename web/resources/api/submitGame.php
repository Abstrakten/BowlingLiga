<?php
// Debug
ob_start();
require_once '../dbconfig.php';
require_once '../library/security.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check POST input variables
if(!(isset($_POST['hasTeams'], $_POST['username'], $_POST['password'], $_POST['score1'], $_POST['score2']) && (isset($_POST['player1'], $_POST['player2'], $_POST['player3'], $_POST['player4']) || isset($_POST['team1'], $_POST['team2']))))
{
    die("Missing parameters.");
}
// Sanitize input
$hasTeams = mysqli_escape_string($conn, $_POST['hasTeams']);
$name = mysqli_escape_string($conn, $_POST["username"]);
$pass = mysqli_escape_string($conn, $_POST["password"]);
$score1 = mysqli_escape_string($conn, $_POST["score1"]);
$score2 = mysqli_escape_string($conn, $_POST["score2"]);
$player1 =  mysqli_escape_string($conn, $_POST["player1"]);     // team1
$player2 =  mysqli_escape_string($conn, $_POST["player2"]);     // team1
$player3 =  mysqli_escape_string($conn, $_POST["player3"]);     // team2
$player4 =  mysqli_escape_string($conn, $_POST["player4"]);     // team2*/ // DISABLED
/*$team1 = mysqli_escape_string($conn, $team1['id']);
$team2 = mysqli_escape_string($conn, $team2["id"]);*/

// Authenticate submitting user
if (authUser($conn, $name, $pass) === FALSE){
    die("Username and password combination invalid.</br>");
}
// TODO: Handle team based input
/*if($_POST["hasTeams"] == 'TRUE'){
    $team1 = mysqli_escape_string($conn, $_POST["team1"]);
    $team2 = mysqli_escape_string($conn, $_POST["team2"]);

    // get ids of the teams TODO: use team names asa identifier, since they are unique ?
    $teamId1 = $conn->query("SELECT id FROM teams WHERE name = '$team1'");
    $teamId2 = $conn->query("SELECT id FROM teams WHERE name = '$team2'");
    $team1 = $teamId1->fetch_assoc();
    $team2 = $teamId2->fetch_assoc();

    if(empty($team1) || empty($team2)){
        die("One of the teams does not exist.</br>");
        // TODO: Create a new dummy team
    }
    else{
        date_default_timezone_set('Europe/Copenhagen');
        $time = date('Y-m-d H:i:s', time());
        $sql = "INSERT INTO games (team1, team2, score1, score2, played_on)
            VALUES ('$team1', '$team2', '$score1', '$score2', '$time')";

        if ($conn->query($sql) === TRUE) {
            echo "Success!";
        }
        else {
            echo $conn->error;
        }
        $conn->close();
    }
}*/

// Handle player based input
// Get ids of players
if($hasTeams === 'FALSE'){
    // Try get id corresponding to player names
    $player1 = $conn->query("SELECT id FROM players WHERE username = '$player1' ")->fetch_assoc()["id"];
    $player2 = $conn->query("SELECT id FROM players WHERE username = '$player2' ")->fetch_assoc()["id"];
    $player3 = $conn->query("SELECT id FROM players WHERE username = '$player3' ")->fetch_assoc()["id"];
    $player4 = $conn->query("SELECT id FROM players WHERE username = '$player4' ")->fetch_assoc()["id"];
    // Check if players actually exist..
    if (empty($player1) || empty($player2) || empty($player3) || empty($player4)){
        die("one of the players does not exist.</br>");
    }
    // Try find any existing teams based on the players' ids
    $teamId1 = $conn->query("SELECT id
            FROM teams
            WHERE (player1 = '$player1' AND player2 = '$player2')
            OR (player1 = '$player2' AND player2 = '$player1')");
    if($teamId1->num_rows == 0){
        if(!CreateTeam($conn, $player1, $player2, "Anonymt hold")){
            // This should not happen.
            die("Could not create team for players " . $player1 . " and " . $player2 . " this should not happen.");
        }
        // Get id of inserted record
        $teamId1 = $conn->insert_id;
    }
    else {
        $teamId1 = $teamId1->fetch_assoc()['id'];
    }
    $teamId2 = $conn->query("SELECT id
            FROM teams
            WHERE (player1 = '$player3' AND player2 = '$player4')
            OR (player1 = '$player4' AND player2 = '$player3')");
    if($teamId2->num_rows == 0){
        // Create new team
        if(!CreateTeam($conn, $player3, $player4, "Anonymt hold")){
            // This should not happen.
            die("Could not create team for players " . $player3 . " and " . $player4 . " this should not happen.");
        }
        // Get id of inserted record
        $teamId2 = $conn->insert_id;
    }
    else {
        $teamId2 = $teamId2->fetch_assoc()['id'];
    }
    if(!CreateGame($conn, $teamId1, $teamId2, $score1, $score2)){
        die("Could not create game. This should not happen.");
    }
    $response = json_encode("Success");
    echo json_encode($response);
}
$conn->close();

function CreateTeam($connection, $player1, $player2, $teamName){
    date_default_timezone_set('Europe/Copenhagen');
    $now = date('Y-m-d H:i:s', time());
    $sql = "INSERT INTO teams (name, player1, player2, rating, created_on)
            VALUES ('$teamName','$player1','$player2',0, '$now')";
    return $connection->query($sql);
}
function CreateGame($connection, $team1, $team2, $score1, $score2){
    // Create new game with the two teams.
    // Timestamp the game
    date_default_timezone_set('Europe/Copenhagen');
    $now = date('Y-m-d H:i:s', time());
    $sql = "INSERT INTO games (team1, team2, score1, score2, played_on)
        VALUES ('$team1', '$team2', '$score1', '$score2', '$now')";
    return $connection->query($sql);
}