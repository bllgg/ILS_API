<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/esp.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$ESP = new esp($db);
 
// set ID property of record to read
$esp_device = isset($_GET['esp_device']) ? $_GET['esp_device'] : die();
    
// read the details of product to be edited
$stmt = $ESP->readOne($esp_device);
$num = $stmt->rowCount();

if($esp_device!=null and $num > 0){ 
    
    // products array
    $ESP_arr=array();
    $ESP_arr["records"]=array();
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $ESP_item=array(
            "esp_device" => $esp_device,
            "building_id" => $building_id,
            "x_position" => $x_position,
            "y_position" => $y_position
        );
 
        array_push($ESP_arr["records"], $ESP_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($ESP_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "ESP does not exist."));
}
?>