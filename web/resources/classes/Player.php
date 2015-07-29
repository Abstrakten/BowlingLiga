<?php

class Player
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $phone;
    private $beersDrunk;
    private $gamesWon;
    private $gamesLost;
    private $rating;
    private $registered_on;
    public function __construct($id, $name, $pass, $email, $phone, $beers, $wonGames, $lostGames, $rating, $registeredOn){
        $this->id = $id;
        $this->username = $name;
        $this->password = $pass;
        $this->email = $email;
        $this->phone = $phone;
        $this->beersDrunk = $beers;
        $this->gamesWon = $wonGames;
        $this->gamesLost = $lostGames;
        $this->rating = $rating;
        $this->registered_on = $registeredOn;
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getBeersDrunk()
    {
        return $this->beersDrunk;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
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
    public function getRegisteredOn()
    {
        return $this->registered_on;
    }

    /**
     * @param mixed $gamesPlayed
     */
    public function setGamesPlayed($gamesPlayed)
    {
        $this->gamesPlayed = $gamesPlayed;
    }

    /**
     * @param mixed $beersDrunk
     */
    public function setBeersDrunk($beersDrunk)
    {
        $this->beersDrunk = $beersDrunk;
    }

    /**
     * @return mixed
     */
    public function getGamesLost()
    {
        return $this->gamesLost;
    }

    /**
     * @param mixed $gamesLost
     */
    public function setGamesLost($gamesLost)
    {
        $this->gamesLost = $gamesLost;
    }

    /**
     * @return mixed
     */
    public function getGamesWon()
    {
        return $this->gamesWon;
    }

    /**
     * @param mixed $gamesWon
     */
    public function setGamesWon($gamesWon)
    {
        $this->gamesWon = $gamesWon;
    }
}