<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");
require_once("utils/functions.php");

require_once('vmc/Models/DiscussionModel.php');

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Models\DiscussionModel;

class DiscussionController
{
    private QueryBuilder $qb;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
    }

    private function makeModel(array $data)
    {
        return new DiscussionModel($data['id'], $data['post'], $data['replay_to'], $data['author'], $data['publication_date'], $data['text']);    
    }

    private function makeFullModel(array $data, $sub_discussions)
    {
        $dm = $this->makeModel($data);
        $count = 0;
        foreach($sub_discussions as $sub)
        {
            if($sub['replay_to'] == $dm->getId())
            {
                $dm->addSubDiscussion($this->makeModel($sub));
                unset($sub_discussions[$count]);
            }
            $count++;
        }

        return [
            "sub" => $sub_discussions,
            "model" => $dm,
        ];
    }

    public function getAllDiscussionsFromPost($post)
    {
        $res = $this->qb->select('*')
            ->from('discussions')
            ->where('post', '=', $post, 'i')
            ->commit();
        foreach($res as $r)
        {
            if($r['replay_to'] == NULL)
            {
                $main_discussions[] = $r;
            } 
            else 
            {
                $sub_discussions[] = $r;    
            }
        }

        foreach($main_discussions as $main)
        {
            $res = $this->makeFullModel($main, $sub_discussions);
            $sub_discussions =  $res['sub'];
            $dm[] = $res['model'];
        }

        return [
            'res' => 0,
            'model' => $dm,
        ];
    }

}
