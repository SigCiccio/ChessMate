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

    public function selectCommentById($id)
    {
        $res = $this->qb->select('*')
            ->from('comments')
            ->where('id', '=', $id, 'i')
            ->commit();

        if(count($res) == 0 || count($res) > 1)
        {
            return [];
        }

        return $res[0];
        
    }

    public function insertComment($post, $author, $publication_date, $publication_time, $text)
    {
        return $this->qb->insert('post, author, publication_date, publication_time, text')
            ->into('comments')
            ->value($post, 'i')
            ->value($author, 's')
            ->value($publication_date, 's')
            ->value($publication_time, 's')
            ->value($text, 's')
            ->commit();
    }
}
