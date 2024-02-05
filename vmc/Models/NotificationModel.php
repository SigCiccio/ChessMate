<?php

namespace vmc\Models;

class NotificationModel
{
    private int $id;
    private String $user;
    private String $author;
    private $date;
    private $time;
    private $post;
    private $comment;
    private $viewed;
    

    public function __construct(int $id, String $user, String $author, $date, $time, $post, $comment, $viewed)  
    {
        $this->id = $id;
        $this->$user = $user;
        $this->author = $author;
        $this->date = $date;
        $this->time = $time;
        $this->post = $post;
        $this->comment = $comment;
        $this->viewed = $viewed;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function isViewed()
    {
        return $this->viewed;
    }
}