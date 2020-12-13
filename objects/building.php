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

    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    building_id=:building_id, map_reference=:map_reference";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->building_id=htmlspecialchars(strip_tags($this->building_id));
        $this->map_reference=htmlspecialchars(strip_tags($this->map_reference));
    
        // bind values
        $stmt->bindParam(":building_id", $this->building_id);
        $stmt->bindParam(":map_reference", $this->map_reference);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}
?>