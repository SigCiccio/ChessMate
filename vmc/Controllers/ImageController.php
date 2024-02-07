<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");

require_once("vmc/Models/ImageModel.php");

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Models\ImageModel;

class ImageController
{
    private QueryBuilder $qb;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
    }

    public function makeModel(array $data)
    {
        return new ImageModel($data['id'], $data['url']);
    }

    public function insertImage($url)
    {
        return $this->qb->insert("`url`")
            ->into('images')
            ->value($url, 's')
            ->commit();
    }

    public function newImage($file)
    {
        $img_name = $file['name'];
	    $img_size = $file['size'];
	    $tmp_name = $file['tmp_name'];
	    $error = $file['error'];

        if ($error === 0) 
        {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png"); 

            if (in_array($img_ex_lc, $allowed_exs)) 
            {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'imgs/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $id = $this->insertImage($new_img_name);
                
                return $this->selectImageById($id);

            }
            else
            {
                $em = "Non puoi inserire un file di questo tipo! Formati cnsentiti: jpg, jpeg, png";
                echo $img_ex_lc;
                /* header("Location: index.php?error=$em"); */
            }
        }
        else 
        {
            echo $error;
            $em = "errore";
            /* header("Location: index.php?error=$em"); */
        }
    }

    public function selectImageById(int $id)
    {
        $res = $this->qb->select('*')
            ->from('images i')
            ->where('id', '=', $id, 'i')
            ->commit();
        
        if(count($res) == 0)
        {

        }
        return $this->makeModel($res[0]);
    }
}
