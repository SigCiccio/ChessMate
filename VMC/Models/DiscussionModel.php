<?php

namespace vmc\Models;

class UserModel
{
    private int $id;
    private int $post;
    private int $replay_to;
    private String $author;
    private $pubblication_date;
    private String $text;
    private int $vote;
    

    public function __construct(int $id, int $post, int $replay_to, String $author, $publication_date, String $text, int $vote)  
    {
        $this->id = $id;
        $this->post = $post;
        $this->replay_to = $replay_to;
        $this->author = $author;
        $this->publication_date = $publication_date;
        $this->text = $text;
        $this->vote = $vote;
    }

    public function toString()
    {
        return "" . 
        "id:\t" . $this->id . "\n" . 
        "post:\t" . $this->post  . "\n" .
        "replay_to:\t" . $this->replay_to  . "\n" .
        "author:\t" . $this->author  . "\n" .
        "publication_date:\t" . $this->publication_date . "\n" .
        "text:\t" . $this->text . "\n" .
        "vote:\t" . $this->vote . "\n";
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getReplayTo()
    {
        return $this->replay_to;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getPublicationDate()
    {
        return $this->publication_date;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getVote()
    {
        return $this->vote;
    }
}
