<?php

namespace vmc\Models;

class ImageModel
{
    private int $id;
    private String $url;
    

    public function __construct(int $id, String $url)  
    {
        $this->id = $id;
        $this->url = $url;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
