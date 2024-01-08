<?php

namespace vmc\Models;

require_once("vmc/Models/ImageModel.php");

use vmc\Models\ImageModel;

class PostModel
{
    private int $id;
    private String $author;
    private $publication_date;
    private String $title;
    private String $text;
    private $image;
    private int $vote;
    private $discussions;


    public function __construct(int $id, String $author, $publication_date, String $title, String $text, int $vote)  
    {
        $this->id = $id;
        $this->author = $author;
        $this->publication_date = $publication_date;
        $this->title = $title;
        $this->text = $text;
        $this->vote = $vote;
        $this->image = NULL;
        $this->discussions = NULL;
    }

    public function hasImage()
    {
        return ($this->image != NULL);
    }

    public function hasDiscussion()
    {
        return ($this->discussions != NULL);
    }

    public function setImage(ImageModel $image)
    {
        $this->image = $image;
    }

    public function toString()
    {
        return "" . 
        "id:\t" . $this->id . "\n" . 
        "author:\t" . $this->author  . "\n" .
        "publication_date:\t" . $this->publication_date . "\n" .
        "title:\t" . $this->title . "\n" .
        "text:\t" . $this->text . "\n" .
        "vote:\t" . $this->vote . "\n";
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getPublicationDate()
    {
        return $this->publication_date;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getVote()
    {
        return $this->vote;
    }

    public function getImage()
    {
        return $this->image;
    }
}
