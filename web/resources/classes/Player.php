<?php

class Player
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $phone;
    private $beersDrunk;
    private $gamesPlayed;
    private $rating;
    private $registered_on;
    public function __construct($id, $name, $pass, $email, $phone, $beers, $gamesplayed, $rating, $registeredOn){
        $this->id = $id;
        $this->username = $name;
        $this->password = $pass;
        $this->email = $email;
        $this->phone = $phone;
        $this->beersDrunk = $beers;
        $this->gamesPlayed = $gamesplayed;
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
    public function getGamesPlayed()
    {
        return $this->gamesPlayed;
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
}