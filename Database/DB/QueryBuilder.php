<?php

namespace Database\DB;

require_once('utils/DatabaseHelper.php');
require_once('Database/DB/Select.php');
require_once('Database/DB/Insert.php');
require_once('Database/DB/Update.php');
require_once('Database/DB/Delete.php');

use DatabaseHelper;
use Database\DB\Select;
use Database\DB\Insert;
use Database\DB\Update;
use Database\DB\Delete;

class QueryBuilder 
{
    private DatabaseHelper $dbh;

    public function __construct(DatabaseHelper $dbh)
    {
        $this->dbh = $dbh;
    }

    public function select(String $fields) 
    {
        return  new Select($this->dbh, $fields);
    }

    public function insert(String $columns)
    {
        return new Insert($this->dbh, $columns);
    }

    public function update()
    {
        return new Update($this->dbh);
    }

    public function delete()
    {
        return new Delete($this->dbh);
    }
}