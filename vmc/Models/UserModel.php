<?php

namespace vmc\Models;

require_once("vmc/Models/ImageModel.php");

use vmc\Models\ImageModel;

class UserModel
{
    private String $username;
    private String $mail;
    private String $bio;
    private $image;
    private String $name;
    private String $surname;
    private $birthday;
    private int $followers;
    private int $follow;
    private $followersList;
    private $followList;

    public function __construct(String $username, String $mail, String $bio, String $name, String $surname, $birthday, int $followers, int $follow)  
    {
        $this->username = $username;
        $this->mail = $mail;
        $this->bio = $bio;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthday = $birthday;
        $this->followers = $followers;
        $this->follow = $follow;
        $this->image = NULL;
        $this->followersList = NULL;
        $this->followList = NULL;
    }

    public function hasImage()
    {
        return $this->image != NULL;
    }

    public function setFollowList(array $followList)
    {
        $this->followList = $followList;
    }

    public function setFollowersList(array $followersList)
    {
        $this->followersList = $followersList;
    }

    public function setFollowersNumber(int $n)
    {
        $this->followers = $n;
    }

    public function setFollowNumber($n)
    {
        $this->follow = $n;
    }

    public function setImage(ImageModel $image)
    {
        $this->image = $image;
    }

    public function setUsername(String $username)
    {
        $this->username = $username;
    }

    public function setMail(String $mail)
    {
        $this->mail = $mail;
    }

    public function setBio(String $bio)
    {
        $this->bio = $bio;
    }

    public function setName(String $name)
    {
        $this->name = $name;
    }

    public function setSurname(String $surname)
    {
        $this->surname = $surname;
    }

    public function setBirtDay($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getFollowersList()
    {
        return $this->followersList;
    }

    public function getFollowList()
    {
        return $this->followList;
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
