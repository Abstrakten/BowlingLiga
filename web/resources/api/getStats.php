<?php
require_once '../dbconfig.php';
// array for JSON response
$response = array();

// connecting to db
$db = new mysqli($servername, $username, $password, $dbname);

// check for post data
if (isset($_POST["id"])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);

    // Get the game history of player with $id
    $result = $db->query("SELECT players.id, players.username, players.rating, players.gamesplayed, players.beersdrunk, players.won_games, players.lost_games, players.registered_on
FROM players
WHERE players.id = '$id'");
    if (!empty($result)){
        // check for empty result
        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc();
            // echoing JSON response
            echo json_encode($response);
        }
        else {
            $response[] = json_encode('0 results');
            echo json_encode($response);
        }
    }
}
else{
    $response[] = json_encode('Not enough parameters');
    echo json_encode($response);
}