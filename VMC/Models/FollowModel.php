<?php

namespace vmc\Models;

class FollowModel
{
    private String $follower;
    private String $followed;
    

    public function __construct(String $follower, String $followed)  
    {
        $this->follower = $follower;
        $this->followed = $followed;
    }

    public function toString()
    {
        return "" . 
        "follower:\t" . $this->follower . "\n" . 
        "followed:\t" . $this->followedost  . "\n";
    }

    public function getFollower()
    {
        return $this->follower;
    }

    public function getFollowed()
    {
        return $this->followed;
    }
}
