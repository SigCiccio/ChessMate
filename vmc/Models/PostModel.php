<?php

namespace vmc\Models;

class PostModel
{
    private int $id;
    private String $author;
    private $publication_date;
    private $publication_time;
    private String $title;
    private String $game;
    private int $vote;    

    public function __construct(int $id, String $author, $publication_date, $publication_time, String $title, String $game, int $vote)  
    {
        $this->id = $id;
        $this->author = $author;
        $this->publication_date = $publication_date;
        $this->publication_time = $publication_time;
        $this->title = $title;
        $this->game = $game;
        $this->vote = $vote;
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
        return $this->publication_date;
    }

    public function getPublicationTime()
    {
        return $this->publication_time;
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
