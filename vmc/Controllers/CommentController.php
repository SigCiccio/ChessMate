<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");

require_once("vmc/Models/CommentModel.php");

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Models\CommentModel;

class CommentController
{
    private QueryBuilder $qb;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
    }

    private function makeModel(array $data)
    {
        return new CommentModel($data['id'], $data['author'], $data['post'], $data['publication_date'], $data['publication_time'], $data['text']);
    }   

    public function selectCommentsOfPost(int $post)
    {
        $res = $this->qb->select('*')
            ->from('comments')
            ->where('post', '=', $post, 'i')
            ->orderBy('publication_date DESC')
            ->commit();
        
        if(count($res) == 0)
        {
            return [];
        }
        
        $cm = [];
        foreach($res as $r)
            $cm[] = $this->makeModel($r);

        return $cm;
    }
}
