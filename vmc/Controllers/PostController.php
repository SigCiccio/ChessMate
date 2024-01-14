<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");

require_once("vmc/Controllers/GameController.php");
require_once("vmc/Models/GameModel.php");
require_once("vmc/Models/PostModel.php");

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Controllers\GameController;
use vmc\Models\GameModel;
use vmc\Models\PostModel;

class PostController
{
    private QueryBuilder $qb;
    private GameController $gc;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
        $this->gc = new GameController($dbh);
    }

    public function makeModel(array $data)
    {
        $pm = new PostModel($data['id'], $data['author'], $data['title'], $data['publication_date'], $data['time'], $data['vote']);
        if($data['gameId'] != NULL)
        {
            $pm->setGame(new GameModel($data['gameId'], $data['id'], $data['move']));
        }
        return $pm;
    }

    public function selectPostById(int $id)
    {
        $res = $this->qb->select('p.id, p.author, p.publication_date, p.time, p.title, p.vote, g.id as gameId, g.move')
            ->from('posts p')
            ->leftJoin('games g', 'p.id', 'g.post')
            ->where('p.id', '=', $id, 'i')
            ->commit();
        
        if(count($res) == 0)
        {
            return -1;
        }
        return $this->makeModel($res[0]);
    }

    public function getMostRecentPost($followerList)
    {
        $query = $this->qb->select('p.id, p.author, p.publication_date, p.time, p.title, p.vote, g.id as gameId, g.move')
            ->from('posts p')
            ->leftJoin('games g', 'p.id', 'g.post')
            ->join('users u', 'u.username', 'author');
    }
}
