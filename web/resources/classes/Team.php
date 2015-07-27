<?php

class Team
{
    private $id;
    private $name;
    private $player1;
    private $player2;
    private $created_on;
    public function __construct($id, $name, $p1, $p2, $created_on){
        $this->id = $id;
        $this->name = $name;
        $this->player1 = $p1;
        $this->player2 = $p2;
        $this->created_on = $created_on;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * @param mixed $player1
     */
    public function setPlayer1($player1)
    {
        $this->player1 = $player1;
    }

    /**
     * @return mixed
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * @param mixed $player2
     */
    public function setPlayer2($player2)
    {
        $this->player2 = $player2;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return ($this->player1->rating + $this->player2->rating) / 2;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->created_on;
    }
}