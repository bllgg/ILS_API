<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/building.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$Building = new building($db);
 
// set ID property of record to read
$building_id = isset($_GET['building_id']) ? $_GET['building_id'] : die();

// read the details of product to be edited
$stmt = $Building->readOne($building_id);
$num = $stmt->rowCount();

if($building_id!=null and $num > 0){
    
    // products array
    $Buildings_arr=array();
    $Buildings_arr["records"]=array();
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $Building_item=array(
            "building_id" => $building_id,
            "map_reference" => $map_reference
        );
 
        array_push($Buildings_arr["records"], $Building_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($Buildings_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Building does not exist."));
}
?>