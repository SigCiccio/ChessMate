<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");

require_once("vmc/Models/PostModel.php");

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Models\PostModel;

class PostController
{
    private QueryBuilder $qb;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
    }

    private function numberOfVote(int $id)
    {
        $res = $this->qb->select('COUNT(*) as n')
            ->from('votes v')
            ->where('v.post', '=', $id, 'i')
            ->commit();
        return count($res);
    }

    private function updateVote(int $n, int $id)
    {
        $this->qb->update()
            ->table('posts')
            ->set('vote', $n, 'i')
            ->where('id', $id, 'i')
            ->commit();
    }

    public function makeModel(array $data)
    {
        $vote = $this->numberOfVote($data['id']);

        if($vote != $data['vote'])
            $this->updateVote($vote, $data['id']);

        return new PostModel($data['id'], $data['author'], $data['publication_date'], $data['publication_time'], $data['title'], $data['game'], $vote);
    }

    public function selectPostById(int $id)
    {
        $res = $this->qb->select('*')
            ->from('posts p')
            ->where('p.id', '=', $id, 'i')
            ->commit();
        
        if(count($res) == 0)
        {
            return -1;
        }
        return $this->makeModel($res[0]);
    }

    public function getMostRecentPost()
    {
        $res = $this->qb->select('*')
            ->from('posts p')
            ->orderBy('p.publication_date')
            ->commit();
        
        if(count($res) == 0)
        {
            return -1;
        }

        foreach($res as $r)
            $m[] = $this->makeModel($r);

        return $m;
    }
}
