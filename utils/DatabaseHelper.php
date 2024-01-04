<?php

class DatabaseHelper {

    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }

    public function exec(String $statement, array $values, String $type, $ret = false)
    {
        $stmt = $this->db->prepare($statement);
        if($type != "")
            $stmt->bind_param($type, ...$values);
        $stmt->execute();

        if($ret) 
        {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return mysqli_insert_id($this->db);
    }
}
