<?php

class DatabaseAccessLayer
{
    private $connection;
    public function __construct($connection){
        $this->connectiton = $connection;
    }
    public function __destruct(){
        $this->connection->close();
    }
    // Create
    public function CreateTeam($player1, $player2, $teamName){
        date_default_timezone_set('Europe/Copenhagen');
        $now = date('Y-m-d H:i:s', time());
        $sql = "INSERT INTO teams (name, player1, player2, rating, created_on)
            VALUES ('$teamName','$player1','$player2',0, '$now')";
        return $this->connection->query($sql);
    }
    public function CreateGame($team1, $team2, $score1, $score2){
        // Timestamp the game
        date_default_timezone_set('Europe/Copenhagen');
        $now = date('Y-m-d H:i:s', time());

        // Create local game, calculating new ratings.
        $newGame = new Game(0, $this->ReadTeam($team1), $this->ReadTeam($team2), $score1, $score2);

        // Perform SQL query. TODO: Incorporate transactions, such that all or none of the queries completes.
        $sql = "INSERT INTO games (team1, team2, score1, score2, played_on)
        VALUES ('$team1', '$team2', '$score1', '$score2', '$now')";
        $result = $this->connection->query($sql);
        // Update players' rating and games played
        $this->UpdatePlayer($newGame->getTeam1()->getPlayer1());
        $this->UpdatePlayer($newGame->getTeam1()->getPlayer2());
        $this->UpdatePlayer($newGame->getTeam2()->getPlayer1());
        $this->UpdatePlayer($newGame->getTeam2()->getPlayer2());
        return $result;
    }
    public function CreatePlayer($name, $pass, $email){
        // ...
    }
    // Read
    public function ReadTeam($id){
        $sql = "SELECT * FROM teams WHERE teams.id = '$id'";
        $result = $this->connection->query($sql)->fetch_assoc();
        $player1 = $this->ReadPlayer($result['player1']);
        $player2 = $this->ReadPlayer($result['player2']);
        return new Team($result['id'], $result['name'], $player1, $player2, $result['created_on']);
    }
    public function ReadGame($id){
        $sql = "SELECT * FROM games WHERE games.id = '$id'";
        $result = $this->connection->query($sql)->fetch_assoc();
        $team1 = $this->ReadTeam($result['team1']);
        $team2 = $this->ReadTeam($result['team2']);
        return new Game($result['id'], $team1, $team2, $result['score1'], $result['score2']);
    }
    public function ReadPlayer($id){
        $sql = "SELECT * FROM players WHERE players.id = '$id'";
        $result = $this->connection->query($sql)->fetch_assoc();
        return new Player(
            $result['id'],
            $result['username'],
            $result['password'],
            $result['email'],
            $result['phone'],
            $result['beersdrunk'],
            $result['gamesplayed'],
            $result['rating'],
            $result['registered_on']);

    }
    // Update
    public function UpdateTeam($teamObject){
        $id = $teamObject->getId();
        $name = $teamObject->getName();
        $p1 = $teamObject->getPlayer1();
        $p2 = $teamObject->getPlayer2();
        // Create SQL statement
        $sql = "UPDATE teams
                SET teams.name='$name',
                    teams.player1 = '$p1',
                    teams.player2 = '$p2',
                WHERE id='$id'";
        return $this->connection->query($sql);
    }
    public function UpdateGame($gameObject){
        // ...
    }
    public function UpdatePlayer($playerObject){
        $id = $playerObject->getId();
        $name = $playerObject->getUsername();
        $pass = $playerObject->getPassword();
        $email = $playerObject->getEmail();
        $phone = $playerObject->getPhone();
        $beersDrunk = $playerObject->getBeersDrunk();
        $gamesPlayed = $playerObject->getGamesPlayed();
        $rating = $playerObject->getRating();

        $sql = "UPDATE players
                SET players.username='$name',
                    players.password='$pass',
                    players.email = $email,
                    players.phone = $phone,
                    players.beersdrunk = '$beersDrunk',
                    players.gamesplayed = '$gamesPlayed',
                    players.rating = '$rating',
                WHERE id='$id'";
        return $this->connection->query($sql);
    }
    // Delete
    public function DeleteTeam($id){
        // ...
    }
    public function DeleteGame($id){
        // ...
    }
    public function DeletePlayer($id){
        // ...
    }
}