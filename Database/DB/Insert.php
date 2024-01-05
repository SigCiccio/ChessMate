<?php

namespace Database\DB;

require_once('utils/DatabaseHelper.php');

use DatabaseHelper;

class Insert 
{

    /* 
        INSERT INTO table_name (column1, column2, column3, ...)
        VALUES (value1, value2, value3, ...); 
    */
    private DatabaseHelper $dbh;
    private String $table;
    private String $columns;
    private $values = [];
    private String $types;

    public function __construct(DatabaseHelper $dbh, String $columns)
    {
        $this->dbh = $dbh; 
        $this->columns = $columns;
        $this->table = "";
        $this->types = "";
    }

    public function into(String $table) 
    {
        $this->table = $table;
        return $this;
    }

    public function value($value, String $type)
    {
        $this->values[] = $value;
        $this->types = $this->types . $type;   
        return $this;
    }

    public function commit()
    {
        $isFirst = true;
        $statement = "INSERT INTO " . $this->table . " (" . $this->columns . ") VALUES (";

        foreach($this->values as $value)
        {
            if($isFirst)
            {
                $statement = $statement . '?';
                $isFirst = false;
            }
            else 
            {
                $statement = $statement . ', ?';
            }
        }
        $statement = $statement . ")";
        
        return $this->dbh->exec($statement, $this->values, $this->types);
    }

    public function toString()
    {
        $isFirst = true;
        $statement = "INSERT INTO " . $this->table . " (" . $this->columns . ") VALUES (";

        foreach($this->values as $value)
        {
            if($isFirst)
            {
                $statement = $statement . '?';
                $isFirst = false;
            }
            else 
            {
                $statement = $statement . ', ?';
            }
        }
        $statement = $statement . ")";

        return $statement;
    }

}
