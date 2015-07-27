<?php
ob_start();
//$url = 'http://beer.mokote.dk/resources/api/submitGame.php';
$url = 'http://127.0.0.1/beer/resources/api/submitGame.php';
function runSubmitGameUnitTests(){
    //testSubmitGamesInvalidUsername();
    //testSubmitGamesInvalidPassword();
    //testSubmitGamesWithTeamsTeam1Bad();
    //testSubmitGamesWithTeamsTeam2Bad();
    //testSubmitGamesWithTeamsGood();             // One game entry
    //testSubmitGamesNoTeamsPlayer1Bad();
    //testSubmitGamesNoTeamsPlayer2Bad();
    //testSubmitGamesNoTeamsPlayer3Bad();
    //testSubmitGamesNoTeamsPlayer4Bad();
    //testSubmitGamesNoTeamsAllPlayersGood();     // two game entry
    testSubmitGamesNoTeamsAllPlayersGoodNoExistingTeams();
    //testSubmitGamesMissingParameters1();
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
function testSubmitGamesNoTeamsAllPlayersGoodNoExistingTeams(){
    echo "Testing no teams, all players good, but no existing teams for the players. Should create two teams. </br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'player1' => 'Soren',
        'player2' => 'Jens',
        'player3' => 'Mads',
        'player4' => 'direkte',
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
function testSubmitGamesMissingParameters1(){
    echo "Testing missing parameter hasTeams</br>";
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
        'hasTeam' => 'FALSE',
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
function testSubmitGamesMissingParameters2(){
    echo "Testing missing parameter hasTeams</br>";
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
        'hasTeam' => 'FALSE',
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
//runSubmitGameUnitTests();
function runRegisterTeamTests(){
    testRegisterTeamPlayer1Bad();
}
function testRegisterTeamPlayer1Bad(){
    echo "TESTING: player1 does not exist.</br>";
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
function testRegisterTeamPlayer2Bad(){
    echo "TESTING: player 2 does not exist.</br>";
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
function testRegisterTeamNameTaken(){
    echo "TESTING: Team name already exists.</br>";
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
function testRegisterTeamInvalidUsername(){
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
function testRegisterTeamInvalidPassword(){
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
function testRegisterTeamSubmitterNotPlayer(){
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
function testRegisterTeamAllGood(){
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
function testRegisterTeamPlayerTeamAlreadyExists(){
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
//runRegisterTeamTests();
function runGetMatchHistoryTests(){
    testGetMatchHistoryInvalidPlayerId();
    testGetMatchHistoryGood();
}
function testGetMatchHistoryInvalidPlayerId(){
    echo "TESTING: invalid player name</br>";
    global $url;
    $data = array(
        'id' => '9999999999999',
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
function testGetMatchHistoryGood(){
    echo "TESTING: Good test. Should return JSON array.</br>";
    global $url;
    $data = array(
        'id' => '1',
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
//runGetMatchHistoryTests();
function runCalcRatingUnitTests(){
    testCalcRatingGood();
}
function testCalcRatingGood(){
    require_once '/resources/classes/Rating.php';
    require_once '/resources/classes/Player.php';
    require_once '/resources/classes/Team.php';
    $p1 = new Player(1, "Molle", "1234", "ok@ok.dk", "12345678", 1, 0, 1000, 0);
    $p2 = new Player(2, "Dun", "1234", "ok@ok.dk", "12345678", 1, 0, 900, 0);
    $p3 = new Player(2, "Andreas", "1234", "ok@ok.dk", "12345678", 1, 0, 900, 0);
    $p4 = new Player(2, "T", "1234", "ok@ok.dk", "12345678", 1, 0, 900, 0);
    $t1 = new Team(1, "Team 1", $p1, $p2, 0, 0);
    $t2 = new Team(2, "Team 2", $p3, $p4, 0, 0);
    $r1 = new Rating(1200, 1200, 0, 1);
    $r2 = new Rating(1180, 1220, 0, 1);
    $r3 = new Rating(1162, 1237, 0, 1);
    $r4 = new Rating(1146, 1252, 0, 1);
    $r1 = $r1->getNewRatings();
    $r2 = $r2->getNewRatings();
    $r3 = $r3->getNewRatings();
    $r4 = $r4->getNewRatings();
    echo "Lose dif: " . $r1["a"] . " and win dif: " . $r1["b"] . "<br>";
    echo "Lose dif: " . $r2["a"] . " and win dif: " . $r2["b"] . "<br>";
    echo "Lose dif: " . $r3["a"] . " and win dif: " . $r3["b"] . "<br>";
    echo "Lose dif: " . $r4["a"] . " and win dif: " . $r4["b"] . "<br>";
}
runCalcRatingUnitTests();