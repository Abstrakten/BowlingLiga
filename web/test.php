<?php
ob_start();
function runSubmitGameUnitTests(){
    testSubmitGamesInvalidUsername();
    testSubmitGamesInvalidPassword();
    testSubmitGamesWithTeamsTeam1Bad();
    testSubmitGamesWithTeamsTeam2Bad();
    testSubmitGamesWithTeamsGood();
    testSubmitGamesNoTeamsBad();
}
function testSubmitGamesInvalidUsername(){
    echo "Testing for invalid username...</br>";
    $url = 'http://beer.mokote.dk/resources/api/submitGame.php';
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
    $url = 'http://beer.mokote.dk/resources/api/submitGame.php';
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
    $url = 'http://beer.mokote.dk/resources/api/submitGame.php';
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
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

    var_dump($result);
}
function testSubmitGamesWithTeamsTeam1Bad(){
    echo "Testing for invalid team 1...</br>";
    $url = 'http://beer.mokote.dk/resources/api/submitGame.php';
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
    $url = 'http://beer.mokote.dk/resources/api/submitGame.php';
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'team1' => 'nerdboosters',
        'team2' => 'wrongapp',
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
function testSubmitGamesNoTeamsGood(){
    echo "Testing No teams good</br>";
    $url = 'http://beer.mokote.dk/resources/api/submitGame.php';
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
function testSubmitGamesNoTeamsBad(){
    echo "Testing No teams bad</br>";
    $url = 'http://beer.mokote.dk/resources/api/submitGame.php';
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