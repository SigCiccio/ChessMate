<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");

require_once("vmc/Controllers/PostController.php");

require_once("vmc/Models/NotificationModel.php");

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Controllers\PostController;

use vmc\Models\NotificationModel;

class NotificationController
{
    private QueryBuilder $qb;
    private PostController $pc;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
        $this->pc = new PostController($dbh);
    }

    public function findNotificationNullPostComment($user, $author, $post, $comment)
    {
        $res = $this->qb->select('id')
            ->from('notifications n')
            ->where('user', '=', $user, 's')
            ->where('author', '=', $author, 's')
            ->isNull('post')
            ->isNull('comment')
            ->commit();
        if(count($res) == 0)
            return NULL;
        return $res[0]['id'];
    }

    public function makeModel(array $data)
    {
        return new NotificationModel($data['id'], $data['user'], $data['author'], $data['date'], $data['time'], $data['post'], $data['comment'], $data['viewed']);
    }

    public function getUnviewedNotification($user)
    {
        $res = $this->qb->select('*')
            ->from('notifications')
            ->where('user', '=', $user, 's')
            ->where('viewed', '=', 0, 'i')
            ->commit();

        if(count($res) == 0)
            return [];

        return $res;
    }

    public function getNotifications($user)
    {
        $res = $this->qb->select('*')
            ->from('notifications')
            ->where('user', '=', $user, 's')
            ->orderBy('date, time DESC')
            ->commit();
        if(count($res) == 0)
            return [];

        $model = [];
        foreach($res as $r)
            $model[] = $this->makeModel($r);

        return $model;
    }

    public function makeNotification($user, $author, $post, $comment)
    {
        $date = date('Y/m/d');
        $time = date("H:i:s");
        
        if($comment != NULL)
        {
            // Notifica commento al post
            $column = "comment, user, author, date, time";
            $query = $this->qb->insert($column)
                ->value($comment, 'i');
        }
        else if($post != NULL)
        {
            // Notifica reazione al post
            $column = "post, user, author, date, time";
            $query = $this->qb->insert($column)
                ->value($post, 'i');
        }
        else 
        {
            // Notifica follow
            $column = "user, author, date, time";
            $query = $this->qb->insert($column);
        }

        return $query->into('notifications')
            ->value($user, 's')
            ->value($author, 's')
            ->value($date, 's')
            ->value($time, 's')
            ->commit();
    }

    public function makeCommentNotification($author, $comment, $post)
    {
        $user = $this->pc->getPostAuthor($post);
        $this->makeNotification($user, $author, NULL, $comment);
    }

    public function makePostNotification($author, $post)
    {
        $user =  $this->pc->getPostAuthor($post);
        $this->makeNotification($user, $author, $post, NULL);
    }

    public function notificationViewed($id)
    {
        $this->qb->update()
            ->table('notifications')
            ->set('viewed', 1, 'i')
            ->where('id', $id, 'i')
            ->commit();
    }

    public function removeNotification($id)
    {
        $this->qb->delete()
            ->table('notifications')
            ->where('id', $id, 'i')
            ->commit();
    }

    public function removePostNotification($author, $post)
    {
        $this->qb->delete()
            ->table('notifications')
            ->where('post', $post, 'i')
            ->andWhere('author', $author, 's')
            ->commit();
    }

    public function removeFollowNotification($user, $author)
    {
        $notificationId = $this->findNotificationNullPostComment($user, $author, NULL, NULL);
        if($notificationId != NULL)
        {
            $res = $this->qb->delete()
                ->table('notifications')
                ->where('id', $notificationId, 's')
                ->commit();
                
            return $res . "";
        }
        
        return "";
    }

    public function removeCommentNotification($user, $comment)
    {
        $this->qb->delete()
            ->table('notifications')
            ->where('comment', $comment, 'i')
            ->andWhere('user', $user, 's')
            ->commit();
    }

}
