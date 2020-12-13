<?php
class device{
 
    // database connection and table name
    private $conn;
    private $table_name = "position";
 
    // object properties
    public $building_id;
    public $device_id;
    public $x_position;
    public $y_position;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name ;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // used when filling up the update product form
    function readOne($d_id){
        
        // query to read single record
        $query = "SELECT *
                FROM
                    " . $this->table_name . " d
                WHERE
                    d.device_id =". $d_id;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();

        return $stmt;
    }
}
?>