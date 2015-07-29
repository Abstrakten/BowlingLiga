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
    $result = $db->query("SELECT  a.*,
        b.name as team_one,
        p1.username as team1_player1,
        p2.username as team1_player2,
        c.name as team_two,
        p3.username as team2_player1,
        p4.username as team2_player2

FROM    games a
        INNER JOIN teams b
            ON a.team1 = b.id
        INNER JOIN teams c
            ON a.team2 = c.id
        INNER JOIN players p1
         ON b.player1 = p1.id
        INNER JOIN players p2
         ON b.player2 = p2.id
        INNER JOIN players p3
         ON c.player1 = p3.id
        INNER JOIN players p4
         ON c.player2 = p4.id
WHERE 	p1.id = '$id' Or p2.id = '$id' Or p3.id = '$id' Or p4.id = '$id'");
    if (!empty($result)){
        // check for empty result
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = json_encode($row);
            }
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