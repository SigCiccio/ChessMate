<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");

use DatabaseHelper;
use Database\DB\QueryBuilder;

class ImageController
{
    private QueryBuilder $qb;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
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
        echo "<pre>";
	    print_r($file);
	    echo "</pre>";

        $img_name = $file['name'];
	    $img_size = $file['size'];
	    $tmp_name = $file['tmp_name'];
	    $error = $file['error'];

        if ($error === 0) 
        {
            if ($img_size > 1250000000) 
            {
                $em = "Sorry, your file is too large.";
                header("Location: index.php?error=$em");
            }
            else 
            {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png"); 
    
                if (in_array($img_ex_lc, $allowed_exs)) 
                {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'imgs/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
    
                    // Insert into Database
                    $this->insertImage($img_upload_path);
                    /* header("Location: view.php"); */
                }
                else
                {
                    $em = "You can't upload files of this type";
                    header("Location: index.php?error=$em");
                }
            }
        }
        else 
        {
            $em = "unknown error occurred!";
            header("Location: index.php?error=$em");
        }
    }
}
