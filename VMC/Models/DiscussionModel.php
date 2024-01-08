<?php

namespace vmc\Models;

class DiscussionModel
{
    private int $id;
    private int $post;
    private $replay_to;
    private String $author;
    private $pubblication_date;
    private String $text;
    private $sub_discussions;
    

    public function __construct(int $id, int $post, $replay_to, String $author, $publication_date, String $text)  
    {
        $this->id = $id;
        $this->post = $post;
        $this->replay_to = $replay_to;
        $this->author = $author;
        $this->publication_date = $publication_date;
        $this->text = $text;
        $this->sub_discussions = NULL;
    }

    public function toString()
    {
        return "" . 
        "id:\t" . $this->id . "\n" . 
        "post:\t" . $this->post  . "\n" .
        "replay_to:\t" . $this->replay_to  . "\n" .
        "author:\t" . $this->author  . "\n" .
        "publication_date:\t" . $this->publication_date . "\n" .
        "text:\t" . $this->text . "\n";
    }

    public function addSubDiscussion(DiscussionModel $dm)
    {
        $this->sub_discussions[] = $dm;
    }

    public function hasSubdiscussion()
    {
        return ($this->sub_discussions != NULL);
    }

    public function getSubdiscussions()
    {
        return $this->sub_discussions;
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
}
