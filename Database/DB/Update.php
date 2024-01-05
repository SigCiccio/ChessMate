<?php

namespace Database\DB;

require_once('utils/DatabaseHelper.php');

use DatabaseHelper;

class Update 
{

    /* 
        UPDATE table_name
        SET column1 = value1, column2 = value2, ...
        WHERE condition; 
    */
    private DatabaseHelper $dbh;
    private String $table;
    private String $columns;
    private $values = [];
    private $condition = [];
    private String $types;

    public function __construct(DatabaseHelper $dbh)
    {
        $this->dbh = $dbh; 
        $this->table = "";
        $this->columns = "";
        $this->types = "";
    }

    public function table(String $table) 
    {
        $this->table = "UPDATE " . $table . " ";
        return $this;
    }

    public function set(String $column, $value, String $type)
    {
        if($this->columns == "")
            $this->columns = "SET " . $column . " = ? ";
        else 
            $this->columns = $this->columns . ", " . $column . " = ? ";
        
        $this->values[] = $value;
        $this->types = $this->types . $type;   
        
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
        $statement = $this->table . $this->columns . $this->condition["statement"];
        $this->values[] = $this->condition["value"];
        $this->types = $this->types . $this->condition["type"];
        
        return $this->dbh->exec($statement, $this->values, $this->types);
    }

    public function toString()
    {
        $statement = $this->table . $this->columns . $this->condition["statement"];
        $this->values[] = $this->condition["value"];
        $this->types = $this->types . $this->condition["type"];

        return $statement;
    }

}
