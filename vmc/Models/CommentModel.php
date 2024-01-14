<?php

namespace vmc\Models;

class CommentModel
{
    private int $id;
    private int $post;
    private String $author;
    private $publication_date;
    private $publication_time;
    private String $text;  

    public function __construct(int $id, String $author, int $post, $publication_date, $publication_time, String $text)  
    {
        $this->id = $id;
        $this->author = $author;
        $this->post = $post;
        $this->publication_date = $publication_date;
        $this->publication_time = $publication_time;
        $this->text = $text;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getPublicationDate()
    {
        return $this->publication_date;
    }

    public function getPublicationTime()
    {
        return $this->publication_time;
    }

}
