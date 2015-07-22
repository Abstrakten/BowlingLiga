<?php
ob_start();
$url = 'http://beer.mokote.dk/resources/api/submitGame.php';
//$url = 'http://127.0.0.1/beer/web/resources/api/submitGame.php';
function runSubmitGameUnitTests(){
    testSubmitGamesInvalidUsername();
    testSubmitGamesInvalidPassword();
    testSubmitGamesWithTeamsTeam1Bad();
    testSubmitGamesWithTeamsTeam2Bad();
    testSubmitGamesWithTeamsGood();             // One game entry
    testSubmitGamesNoTeamsPlayer1Bad();
    testSubmitGamesNoTeamsPlayer2Bad();
    testSubmitGamesNoTeamsPlayer3Bad();
    testSubmitGamesNoTeamsPlayer4Bad();
    testSubmitGamesNoTeamsAllPlayersGood();     // two game entry
}
function testSubmitGamesInvalidUsername(){
    echo "Testing for invalid username...</br>";
    global $url;
    $data = array(
        'username' => 'a',
        'password' => 'b',
        'team1' => 'svin',
        'team2' => 'nerdboosters',
        'score1' => '5',
        'score2' => '5',
        'hasTeams' => 'TRUE',
    );

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    echo $result . "</br>";
}
function testSubmitGamesInvalidPassword(){
    echo "Testing for VALID username with invalid password...</br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => '1234',
        'team1' => 'svin',
        'team2' => 'nerdboosters',
        'score1' => '5',
        'score2' => '5',
        'hasTeams' => 'TRUE',
    );

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    echo $result . "</br>";
}
function testSubmitGamesWithTeamsGood(){
    echo "Testing with valid teams</br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'team1' => 'deadbeats',
        'team2' => 'nigger faggets',
        'score1' => '5',
        'score2' => '5',
        'hasTeams' => 'TRUE',
    );

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    echo $result . "</br>";
}
function testSubmitGamesWithTeamsTeam1Bad(){
    echo "Testing for invalid team 1...</br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'team1' => 'wrongteam1',
        'team2' => 'nerdboosters',
        'score1' => '5',
        'score2' => '5',
        'hasTeams' => 'TRUE',
    );
// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    echo $result . "</br>";
}
function testSubmitGamesWithTeamsTeam2Bad(){
    echo "Testing for invalid team 2...</br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'team1' => 'nerdboosters',
        'team2' => 'wrongteam',
        'score1' => '5',
        'score2' => '5',
        'hasTeams' => 'TRUE',
    );

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    echo $result . "</br>";
}
function testSubmitGamesNoTeamsPlayer1Bad(){
    echo "Testing No teams player 1 bad </br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'player1' => 'nonexistant',
        'player2' => 'fedesvin',
        'player3' => 'Hotdogfun',
        'player4' => 'four',
        'score1' => '1234',
        'score2' => '5678',
        'hasTeams' => 'FALSE',
    );

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    echo $result . "</br>";
}
function testSubmitGamesNoTeamsPlayer2Bad(){
    echo "Testing No teams player 2 bad</br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'player1' => 'svin',
        'player2' => 'nonexistantplayer',
        'player3' => 'Hotdogfun',
        'player4' => 'four',
        'score1' => '1234',
        'score2' => '5678',
        'hasTeams' => 'FALSE',
    );

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    echo $result . "</br>";
}
function testSubmitGamesNoTeamsPlayer3Bad(){
    echo "Testing No teams player 3 bad</br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'player1' => 'svin',
        'player2' => 'fedesvin',
        'player3' => 'nonexistantplayer',
        'player4' => 'four',
        'score1' => '1234',
        'score2' => '5678',
        'hasTeams' => 'FALSE',
    );

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    echo $result . "</br>";
}
function testSubmitGamesNoTeamsPlayer4Bad(){
    echo "Testing No teams player 4 bad</br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'player1' => 'svin',
        'player2' => 'fedesvin',
        'player3' => 'Hotdogfun',
        'player4' => 'nonexistantplayer',
        'score1' => '1234',
        'score2' => '5678',
        'hasTeams' => 'FALSE',
    );

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    echo $result . "</br>";
}
function testSubmitGamesNoTeamsAllPlayersGood(){
    echo "Testing no teams, all players good</br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'player1' => 'svin',
        'player2' => 'fedesvin',
        'player3' => 'Hotdogfun',
        'player4' => 'four',
        'score1' => '1234',
        'score2' => '5678',
        'hasTeams' => 'FALSE',
    );

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    echo $result . "</br>";
}
runSubmitGameUnitTests();
?>