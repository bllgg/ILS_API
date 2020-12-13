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

    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    esp_device=:esp_device, building_id=:building_id, x_position=:x_position, y_position=:y_position";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->esp_device=htmlspecialchars(strip_tags($this->esp_device));
        $this->building_id=htmlspecialchars(strip_tags($this->building_id));
        $this->x_position=htmlspecialchars(strip_tags($this->x_position));
        $this->y_position=htmlspecialchars(strip_tags($this->y_position));
    
        // bind values
        $stmt->bindParam(":esp_device", $this->esp_device);
        $stmt->bindParam(":building_id", $this->building_id);
        $stmt->bindParam(":x_position", $this->x_position);
        $stmt->bindParam(":y_position", $this->y_position);
        
        // execute query
        //if(!$stmt->execute()) echo $stmt->errorInfo();
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}
?>