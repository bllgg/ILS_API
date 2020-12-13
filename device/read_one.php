<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/device.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$Device = new device($db);
 
// set ID property of record to read
$device_id = isset($_GET['device_id']) ? $_GET['device_id'] : die();
    
// read the details of product to be edited
$stmt = $Device->readOne($device_id);
$num = $stmt->rowCount();

if($device_id!=null and $num > 0){ 
    
    // products array
    $Devices_arr=array();
    $Devices_arr["records"]=array();
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $Device_item=array(
            "device_id" => $device_id,
            "building_id" => $building_id,
            "x_position" => $x_position,
            "y_position" => $y_position
        );
 
        array_push($Devices_arr["records"], $Device_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($Devices_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Device does not exist."));
}
?>