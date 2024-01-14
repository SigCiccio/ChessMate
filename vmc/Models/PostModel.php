<?php

namespace vmc\Models;

require_once("vmc/Models/GameModel.php");

use vmc\Models\GameModel;

class PostModel
{
    private int $id;
    private String $author;
    private String $title;
    private $publicationDate;
    private $time;
    private int $vote;
    private $game;
    

    public function __construct(int $id, String $author, String $title, $publicationDate, $time, int $vote)  
    {
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->publicationDate = $publicationDate;
        $this->time = $time;
        $this->vote = $vote;
        $this->game = NULL;
    }

    public function hasGame()
    {
        return $this->game != NULL;
    }

    public function setGame(GameModel $game)
    {
        $this->game = $game;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getVote()
    {
        return $this->vote;
    }

    public function getGame()
    {
        return $this->game;
    }

}
