<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");
require_once("utils/functions.php");

require_once('vmc/Models/PostModel.php');

require_once('vmc/Controllers/ImageController.php');

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Models\PostModel;

use vmc\Controllers\ImageController;

class PostController
{
    private QueryBuilder $qb;
    private ImageController $ic;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
        $this->ic = new ImageController($dbh);
    }

    private function makeModel(array $data)
    {
        $pm = new PostModel( $data['id'], $data['author'], $data['publication_date'], $data['title'], $data['text'], $data['vote']); 
        if($data['image'] != NULL)
            $pm->setImage($this->ic->selectImageById($data['image']));
        return $pm;
    }

    public function selectUserFromUsername(String $username)
    {
        $res = $this->qb->select('*')
        ->from('posts')
        ->where('username', '=', $username, 's')
        ->commit();

        if(count($res) == 0)
            return [
                'res' => -1,
                'value' => NULL,
            ];

        return [
            'res' => 0,
            'value' => $this->makeModel($res[0]),
        ];
    }

    public function selectPosts()
    {
        $res = $this->qb->select('*')
            ->from('posts')
            ->commit();
        
        if(count($res) == 0)
            return [
                "res" => -1,
                "value" => NULL,
            ];

        foreach($res as $r)
        {
            $pm[] = $this->makeModel($r);
        }
        return [
            'res' => 0,
            'value' => $pm,
        ];

    }

}
