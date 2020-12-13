<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/device.php';
 
$database = new Database();
$db = $database->getConnection();
 
$Device = new device($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->device_id) &&
    !empty($data->building_id) &&
    !empty($data->x_position) &&
    !empty($data->y_position)
){
 
    // set product property values
    $Device->device_id = $data->device_id;
    $Device->building_id = $data->building_id;
    $Device->x_position = $data->x_position;
    $Device->y_position = $data->y_position;
 
    // create the product
    if($Device->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Device was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create device."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create device   . Data is incomplete."));
}
?>