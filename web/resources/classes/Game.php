<?php
class Game
{
    private $id;
    private $team1;
    private $team2;
    private $score1;
    private $score2;
    function __construct($id, $team1, $team2, $score1, $score2){
        $this->id = $id;
        $this->team1 = $team1;
        $this->team2 = $team2;
        $this->score1 = $score1;
        $this->score2 = $score2;
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
     * @param mixed $team1
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;
    }

    /**
     * @return mixed
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * @param mixed $team2
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;
    }

    /**
     * @return mixed
     */
    public function getScore1()
    {
        return $this->score1;
    }

    /**
     * @param mixed $score1
     */
    public function setScore1($score1)
    {
        $this->score1 = $score1;
    }

    /**
     * @return mixed
     */
    public function getScore2()
    {
        return $this->score2;
    }

    /**
     * @param mixed $score2
     */
    public function setScore2($score2)
    {
        $this->score2 = $score2;
    }
}