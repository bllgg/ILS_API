<?php
class building{
 
    // database connection and table name
    private $conn;
    private $table_name = "building";
 
    // object properties
    public $building_id;
    public $map_reference;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // used when filling up the update product form
    function readOne($b_id){
        
        // query to read single record
        $query = "SELECT *
                FROM
                    " . $this->table_name . " b
                WHERE
                    b.building_id =". $b_id;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();

        return $stmt;
    }
}
?>