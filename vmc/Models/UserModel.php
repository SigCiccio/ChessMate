<?php

namespace vmc\Models;

require_once("vmc/Models/ImageModel.php");
require_once("vmc/Models/UserListModel.php");

use vmc\Models\ImageModel;
use vmc\Models\UserListModel;

class UserModel
{
    private String $username;
    private String $mail;
    private String $bio;
    private $image;
    private String $name;
    private String $surname;
    private $birthday;
    private $followers;
    private $follow;

    public function __construct(String $username, String $mail, String $bio, String $name, String $surname, $birthday)  
    {
        $this->username = $username;
        $this->mail = $mail;
        $this->bio = $bio;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthday = $birthday;
        $this->followers = NULL;
        $this->follow = NULL;
        $this->image = NULL;
    }

    // --- ------------------------------------------------
    // --- Followers e Follow
    // --- ------------------------------------------------

    // Setter
    public function setFollowList(array $list)
    {
        $this->follow = new UserListModel($list);
    }

    public function setFollowersList(array $list)
    {
        $this->followers = new UserListModel($list);
    }

    // Getter
    public function getFollowersList()
    {
        return $this->followers->getList();
    }

    public function getFollowList()
    {
        return $this->follow->getList();
    }

    public function getFollowers()
    {
        return count($this->getFollowersList());
    }

    public function getFollow()
    {
        return count($this->getFollowList());
    }

    // Altro
    public function removeToFollow($username)
    {
        return $this->follow->removeUserToList($username);
    }
    
    public function addToFollow($username)
    {
        $this->follow->addUserToList($username);
    }

    

    











    public function hasImage()
    {
        return $this->image != NULL;
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

    public function getImage()
    {
        return $this->image;
    }

    public function getBio()
    {
        return $this->bio;
    }
}
