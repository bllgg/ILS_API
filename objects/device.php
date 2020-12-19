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
    public $variance;
 
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

    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    device_id=:device_id, building_id=:building_id, x_position=:x_position, y_position=:y_position";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->device_id=htmlspecialchars(strip_tags($this->device_id));
        $this->building_id=htmlspecialchars(strip_tags($this->building_id));
        $this->x_position=htmlspecialchars(strip_tags($this->x_position));
        $this->y_position=htmlspecialchars(strip_tags($this->y_position));
        $this->variance=htmlspecialchars(strip_tags($this->variance));
    
        // bind values
        $stmt->bindParam(":device_id", $this->device_id);
        $stmt->bindParam(":building_id", $this->building_id);
        $stmt->bindParam(":x_position", $this->x_position);
        $stmt->bindParam(":y_position", $this->y_position);
        $stmt->bindParam(":variance", $this->variance);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}
?>