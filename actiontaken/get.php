<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/actiontaken.php';
 
$database = new Database();
$db = $database->getConnection();
 
$transformation = new ActionTaken($db); 
$stmt = $transformation->read();
$num = $stmt->rowCount(); 

if($num>0){  
    $subcategory_arr=array();
    $subcategory_arr=array();    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){        
        extract($row);
         $transformation_item=array(
            "Transformation_Short" => $Transformation_Short,
            "Transformation_Short" => $Transformation_Short,
            "ActionTaken" => $ActionTaken,
            "Total" => (int)$Total,
            "ReportingYear" => $ReportingYear
        ); 
        array_push($subcategory_arr, $transformation_item);
    }    
    http_response_code(200);  
    echo json_encode($subcategory_arr);
}
else{
    
    http_response_code(404);    
    echo json_encode(
        array("message" => "No action taken found.")
    );
}
 ?>