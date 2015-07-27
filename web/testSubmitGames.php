<?php
ob_start();
//$url = 'http://beer.mokote.dk/resources/api/submitGame.php';
$url = 'http://127.0.0.1/beer/resources/api/submitGame.php';
function runAllTests(){
    testCreateNewGame();
}
function testCreateNewGame(){
    echo "TEST: CREATE A NEW GAME.</br>";
    global $url;
    $data = array(
        'username' => 'test2',
        'password' => 'test2',
        'player1' => 'svin',
        'player2' => 'fedesvin',
        'player3' => 'Hotdogfun',
        'player4' => 'four',
        'score1' => '12',
        'score2' => '23',
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
runAllTests();