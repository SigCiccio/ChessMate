<?php

namespace Database\DB;

require_once('utils/DatabaseHelper.php');

use DatabaseHelper;

class Delete 
{
    # DELETE FROM table WHERE column = ? 

    private DatabaseHelper $dbh;
    private String $table;
    private array $condition;

    public function __construct(DatabaseHelper $dbh)
    {
        $this->dbh = $dbh;
    }

    public function table(String $table) 
    {
        $this->table = "DELETE FROM " . $table . " ";
        return $this;
    }

    public function where(String $column, $value, String $type)
    {
        $this->condition = [
            "statement" => "WHERE " . $column . " = ? ",
            "value" => $value,
            "type" => $type
        ];
        return $this;
    }

    public function commit()
    {
        $statement = $this->table . $this->condition['statement'];
        
        
        return $this->dbh->exec($statement, [$this->condition['value']], $this->condition['type']);
    }

    public function toString()
    {
        return $this->table . $this->condition['statement'];
    }

}
