<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");

require_once("vmc/Controllers/NotificationController.php");

require_once("vmc/Models/CommentModel.php");

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Controllers\NotificationController;

use vmc\Models\CommentModel;

class CommentController
{
    private QueryBuilder $qb;
    private NotificationController $nc;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
        $this->nc = new NotificationController($dbh);
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


        $res = $this->qb->insert('post, author, publication_date, publication_time, text')
            ->into('comments')
            ->value($post, 'i')
            ->value($author, 's')
            ->value($publication_date, 's')
            ->value($publication_time, 's')
            ->value($text, 's')
            ->commit();

        $this->nc->makeCommentNotification($author, $res, $post);

        return $res;
    }

    public function getPostId($comment)
    {
        $res = $this->qb->select('c.post')
            ->from('comments c')
            ->where('c.id', '=', $comment, 'i')
            ->commit();
        if(count($res) == 0)
            return 0;
        return $res[0]['post'];
    }

    public function deleteComment($id)
    {
        $this->qb->delete()
            ->table('comments')
            ->where('id', $id, 'i')
            ->commit();

        $this->nc->removeCommentNotification($_SESSION['user']->getUsername(), $id);
    }
}
