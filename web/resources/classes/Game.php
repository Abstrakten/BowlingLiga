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

        if ($this->score1 > $this->score2)
        {
            $s1 = 1;
            $s2 = 0;
        }
        else{
            // Using constants for scoring...
            $s1 = 0;
            $s2 = 1;
        }
        $r = new Rating($this->team1->getRating(), $this->team2->getRating(), $s1, $s2);

        // Call new ratings because shit PHP cant call from new instance constructor......
        $r = $r->getNewRatings();
        // Get differences in rating change
        $team1Dif = $r["a"] - $this->team1->getRating();
        $team2Dif = $r["b"] - $this->team2->getRating();
        // Update ratings for participants
        $this->team1->getPlayer1()->setRating($team1->getPlayer1()->getRating() + $team1Dif);
        $this->team1->getPlayer2()->setRating($team1->getPlayer2()->getRating() + $team1Dif);
        $this->team2->getPlayer1()->setRating($team2->getPlayer1()->getRating() + $team2Dif);
        $this->team2->getPlayer2()->setRating($team2->getPlayer2()->getRating() + $team2Dif);

        // Update games played for participants
        $this->team1->getPlayer1()->setGamesPlayed($this->team1->getPlayer1()->getGamesPlayed() + 1);
        $this->team1->getPlayer2()->setGamesPlayed($this->team1->getPlayer2()->getGamesPlayed() + 1);
        $this->team2->getPlayer1()->setGamesPlayed($this->team2->getPlayer1()->getGamesPlayed() + 1);
        $this->team2->getPlayer2()->setGamesPlayed($this->team2->getPlayer2()->getGamesPlayed() + 1);
        // Update beers drunk stats
        $this->team1->getPlayer1()->setBeersDrunk($this->team1->getPlayer1()->getBeersDrunk() + ($this->score1 / 2));
        $this->team1->getPlayer2()->setBeersDrunk($this->team1->getPlayer2()->getBeersDrunk() + ($this->score1 / 2));
        $this->team2->getPlayer1()->setBeersDrunk($this->team2->getPlayer1()->getBeersDrunk() + ($this->score2 / 2));
        $this->team2->getPlayer2()->setBeersDrunk($this->team2->getPlayer2()->getBeersDrunk() + ($this->score2 / 2));
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