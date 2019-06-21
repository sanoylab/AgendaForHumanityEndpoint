<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../models/crosscutting-issues.php';
 
$database = new Database();
$db = $database->getConnection();
 
$transformation = new CrosscuttingIssues($db); 
$stmt = $transformation->read_detail();
$num = $stmt->rowCount(); 

if($num>0){  
    $transformations_arr=array();
     
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){        
        extract($row);
         $transformation_item=array(
            "CCI" => $CCI,
            "Transformation_Short" => $Transformation_Short,
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
        array("message" => "No cross cutting issues found.")
    );
}
 
