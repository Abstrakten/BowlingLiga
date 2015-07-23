<?php
// array for JSON response
$response = array();

// connecting to db
$db = new mysqli($servername, $username, $password, $dbname);

// check for post data
if (isset($_POST["id"])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);

    // get a product from products table
    $result = $db->query("Select Distinct games.*
                          From games
                          Inner Join teams On teams.id = games.team1 Or teams.id = games.team2
                          Inner Join players On teams.player1 = 1 Or teams.player2 = 1
                          Order by games.played_on DESC");
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
            echo '0 results.';
        }
    }
}
else{
    echo 'Not enough parameters.';
}