<?php

namespace Database\DB;

require_once('utils/DatabaseHelper.php');

use DatabaseHelper;

class Delete 
{
    # DELETE FROM table WHERE column = ? 

    private DatabaseHelper $dbh;
    private String $table;
    private String $statement;
    private array $value;
    private String $type;

    public function __construct(DatabaseHelper $dbh)
    {
        $this->dbh = $dbh;
        $this->statement = '';
        $this->type = '';
    }

    public function table(String $table) 
    {
        $this->table = "DELETE FROM " . $table . " ";
        return $this;
    }

    public function where(String $column, $value, String $type)
    {
        $this->statement = "WHERE " . $column . " = ? ";
        $this->value[] = $value;
        $this->type = $this->type . $type;
        return $this;
    }

    public function andWhere(String $column, $value, String $type)
    {
        $this->statement = $this->statement . " AND " . $column . " = ? ";
        $this->value[] = $value;
        $this->type = $this->type . $type;
        return $this;
    }

    public function commit()
    {
        $statement = $this->table . $this->statement;
        
        
        return $this->dbh->exec($statement, $this->value, $this->type);
    }

    public function toString()
    {
        return $this->table . $this->statement;
    }

}
