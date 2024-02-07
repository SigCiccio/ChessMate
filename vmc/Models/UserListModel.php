<?php

namespace vmc\Models;

class UserListModel
{
    private $list;

    public function __construct($list)  
    {
        $this->list = $list;
    }

    // Setter
    public function addUserToList($user)
    {
        $this->list[] = $user;
    }

    public function removeUserToList($user)
    {
        $to_remove = array($user);

        $place_holder = array_diff($this->list, $to_remove);
        $this->list = $place_holder;
        /* for($i = 0; $i < count($this->list); $i++)
        {
            if($this->list[$i] == $user)
            {
                unset($this->list[$i]);
                return $i;
            }
        } */
        return $to_remove;
    }

    // Getter
    public function getNumber()
    {
        return count($this->list);
    }

    public function  getList()
    {
        return $this->list;
    }



}
