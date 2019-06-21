<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../models/transformation.php';
 
$database = new Database();
$db = $database->getConnection();
 
$transformation = new Transformation($db); 
$stmt = $transformation->read();
$num = $stmt->rowCount(); 

if($num>0){  
    $transformations_arr=array();
    $transformations_arr=array();    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){        
        extract($row);
         $transformation_item=array(
            "Transformation_Short" => $Transformation_Short,
            "Transformation_Long" => $Transformation_Long,
            "Total" => (int)$Total,
            "ReportingYear" => $ReportingYear
        ); 
        array_push($transformations_arr, $transformation_item);
    }    
    http_response_code(200);  
    echo json_encode($transformations_arr);
}
else{
    
    http_response_code(404);    
    echo json_encode(
        array("message" => "No transformation found.")
    );
}
 
