<?php
require_once 'Team.php';
require_once 'Player.php';
class Game
{
    private $id;
    private $team1;
    private $team2;
    private $score1;
    private $score2;
    function __construct($id, Team $team1, Team $team2, $score1, $score2){
        $this->id = $id;
        $this->team1 = $team1;
        $this->team2 = $team2;
        $this->score1 = $score1;
        $this->score2 = $score2;

        if ($score1 > $score2)
        {
            $winner = $team1;
            $loser = $team2;
            // Using constants for scoring...
            $score1 = 1;
            $score2 = 0;
        }
        else{
            $winner = $team2;
            $loser = $team1;
            // Using constants for scoring...
            $score1 = 0;
            $score2 = 1;
        }
        $r = new Rating($team1->getRating(), $team2->getRating(), $score1, $score2);
        // Call new ratings because shit PHP cant call from new instance construtor......
        $r = $r->getNewRatings();
        // Get differences in rating change
        $winDif = $winner->getRating() - $r["a"];
        $lossDif = $loser->getRating() - $r["b"];
        echo "Win dif: " . $winDif . "<br>";
        echo "Loss dif: " . $lossDif . "<br>";
        // Update ratings for participants
        $winner->getPlayer1()->setRating($winner->getPlayer1()->getRating() + $winDif);
        $winner->getPlayer2()->setRating($winner->getPlayer2()->getRating() + $winDif);
        $loser->getPlayer1()->setRating($loser->getPlayer1()->getRating() + $lossDif);
        $loser->getPlayer2()->setRating($loser->getPlayer2()->getRating() + $lossDif);

        // Update games played for participants
        $winner->getPlayer1()->setGamesPlayed($winner->getPlayer1()->getGamesPlayed() + 1);
        $winner->getPlayer2()->setGamesPlayed($winner->getPlayer2()->getGamesPlayed() + 1);
        $loser->getPlayer1()->setGamesPlayed($loser->getPlayer1()->getGamesPlayed() + 1);
        $loser->getPlayer2()->setGamesPlayed($loser->getPlayer2()->getGamesPlayed() + 1);
        // TODO: Update beers drunk for participants.
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * @return mixed
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * @return mixed
     */
    public function getScore1()
    {
        return $this->score1;
    }

    /**
     * @return mixed
     */
    public function getScore2()
    {
        return $this->score2;
    }
}