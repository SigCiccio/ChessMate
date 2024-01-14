<?php

namespace vmc\Models;

class GameModel
{
    private int $id;
    private int $post;
    private String $move;
    

    public function __construct(int $id, int $post, String $move)  
    {
        $this->id = $id;
        $this->post = $post;
        $this->move = $move;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getMove()
    {
        return $this->move;
    }
}
