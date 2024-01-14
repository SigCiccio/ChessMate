<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");

require_once("vmc/Models/GameModel.php");

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Models\GameModel;

class GameController
{
    private QueryBuilder $qb;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
    }

    public function makeModel(array $data)
    {
        return new GameModel($data['id'], $data['post'], $data['move']);
    }

    public function selectGameByPost(int $post)
    {
        $res = $this->qb->select('*')
            ->from('games g')
            ->where('post', '=', $post, 'i')
            ->commit();
        
        if(count($res) == 0)
        {
            return -1;
        }
        return $this->makeModel($res[0]);
    }
}
