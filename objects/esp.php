<?php
class esp{
 
    // database connection and table name
    private $conn;
    private $table_name = "ESP_device";
 
    // object properties
    public $building_id;
    public $esp_device;
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
    function readOne($e_id){
        
        // query to read single record
        $query = "SELECT *
                FROM
                    " . $this->table_name . " e
                WHERE
                    e.esp_device =". $e_id;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();

        return $stmt;
    }
}
?>