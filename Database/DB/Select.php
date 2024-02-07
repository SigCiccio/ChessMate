<?php

namespace Database\DB;

require_once('utils/DatabaseHelper.php');

use DatabaseHelper;

class Select 
{
    private DatabaseHelper $dbh;
    private $fields;
    private $from;
    private $join = [];
    private $where = [];
    private $whereValue = [];
    private $whereTypes;
    private $orderBy;
    private $groupBy;
    private $having;
    private $havingValue;
    private $limit;
    private $limitValue;

    public function __construct(DatabaseHelper $dbh, String $fields)
    {
        $this->dbh = $dbh;
        $this->fields = $fields;
        $this->join = " ";
        $this->orderBy = " ";
        $this->groupBy = " ";
        $this->having = " ";
        $this->limit = " ";
        $this->limitValue = NULL;
        $this->havingValue = NULL;
    }

    public function from($table) 
    {
        $this->from = " FROM ${table} ";
        return $this;
    }

    public function join($table, $on1, $on2)
    {
        $this->join = $this->join . " JOIN ${table} ON ${on1} = ${on2} ";
        return $this;
    }

    public function leftJoin($table, $on1, $on2)
    {
        $this->join = $this->join ." LEFT JOIN ${table} ON ${on1} = ${on2} ";
        return $this;
    }

    public function rightJoin($table, $on1, $on2)
    {
        $this->join = $this->join . " RIGHT JOIN ${table} ON ${on1} = ${on2} ";
        return $this;
    }

    public function orderBy($field) 
    {
        $this->orderBy = " ORDER BY ${field} ";
        return $this;
    }

    public function groupBy($field)
    {
        $this->groupBy = " GROUP BY " . $field . " ";
        return $this;
    }

    public function having($field, $confronter, $value, $type)
    {
        $this->having = " HAVING " . $field . " " . $confronter . " ? ";
        $this->havingValue = [
            'value' => $value,
            'type' => $type
        ];
        return $this;
    }

    public function where($field, $confronter, $value, $type)
    {
        if($this->where == [])
        {
            $this->where[] = " WHERE ${field} ${confronter} ? ";
        }
        else 
        {
            $this->where[] = " AND ${field} ${confronter} ? ";
        }
        $this->whereValue[] = $value;
        $this->whereTypes = $this->whereTypes . $type;
        return $this;
    }

    public function isNull($field)
    {
        if($this->where == [])
            $this->where[] = " WHERE ${field} IS NULL ";
        else 
            $this->where[] = " AND ${field} IS NULL ";
        return $this;
    }

    public function orWhere($field, $confronter, $value, $type)
    {
        if($this->where == [])
        {
            $this->where[] = "WHERE ${field} ${confronter} ? ";
        }
        else 
        {
            $this->where[] = " OR ${field} ${confronter} ? ";
        }
        $this->whereValue[] = $value;
        $this->whereTypes = $this->whereTypes . $type;
        return $this;
    }

    public function limit($number) 
    {
        $this->limitValue = $number;
        $this->limit = " LIMIT ? ";
        return $this;   
    }

    public function commit()
    {
        $statement = "SELECT " . $this->fields . " ";
        $statement = $statement . $this->from . $this->join;

        if($this->where != [])
        {
            foreach($this->where as $w)
            {
                $statement = $statement . $w;
            }
        }
        
        $statement = $statement . $this->orderBy;
        $statement = $statement . $this->groupBy;
        
        if($this->limitValue != NULL) 
        {
            $statement = $statement . $this->limit;
            $this->whereValue[] = $this->limitValue;
            $this->whereTypes = $this->whereTypes . 'i'; 
        }

        if($this->whereTypes == NULL)
        {
            $this->whereTypes = "";
        }

        return $this->dbh->exec($statement, $this->whereValue, $this->whereTypes, true);
    }

    public function toString()
    {
        $statement = "SELECT " . $this->fields . " ";
        $statement = $statement . $this->from . $this->join;

        if($this->where != [])
        {
            foreach($this->where as $w)
            {
                $statement = $statement . $w;
            }
        }
        
        $statement = $statement . $this->orderBy;
        $statement = $statement . $this->groupBy;

        if($this->havingValue != NULL)
        {
            $statement = $statement . $this->having;
            $this->whereValue[] = $this->havingValue['value'];   
            $this->whereTypes = $this->whereTypes . $this->havingValue['type'];   
        }
        
        if($this->limit != NULL) 
        {
            $statement = $statement . $this->limit;
            $this->whereValue[] = $this->limitValue;
            $this->whereTypes = $this->whereTypes . 'i'; 
        }

        
        
        return $statement;
    }

}