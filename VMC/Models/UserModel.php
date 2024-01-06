<?php

namespace vmc\Models;

require_once("vmc/Models/ImageModel.php");

use vmc\Models\ImageModel;

class UserModel
{
    private String $username;
    private String $mail;
    private String $bio;
    private ImageModel $image;
    private String $name;
    private String $surname;
    private $birthday;
    private String $nationality;
    private int $elo;
    private int $followers;
    private int $follow;

    public function __construct(String $username, String $mail, String $bio, String $name, String $surname, $birthday, String $nationality, int $elo, int $followers, int $follow)  
    {
        $this->username = $username;
        $this->mail = $mail;
        $this->bio = $bio;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthday = $birthday;
        $this->nationality = $nationality;
        $this->elo = $elo;
        $this->followers = $followers;
        $this->follow = $follow;
    }

    public function setImage(ImageModel $image)
    {
        $this->image = $image;
    }

    public function toString()
    {
        return "" . 
        "username:\t" . $this->username . "\n" . 
        "mail:\t" . $this->mail  . "\n" .
        "name:\t" . $this->name . "\n" .
        "surname:\t" . $this->surname . "\n" .
        "birthday:\t" . $this->birthday . "\n" .
        "nationality:\t" . $this->nationality . "\n" .
        "elo:\t" . $this->elo . "\n" .
        "followers\t" . $this->followers . "\n" .
        "follow:\t" . $this->follow . "\n";
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function getElo()
    {
        return $this->elo;
    }

    public function getFollowers()
    {
        return $this->followers;
    }

    public function getFollow()
    {
        return $this->follow;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getBio()
    {
        return $this->bio;
    }
}
