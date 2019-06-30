<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/dashboard.php';
 
$database = new Database();
$db = $database->getConnection();
 
$stakeholder = new Dashboard($db); 
$stmt = $stakeholder->readNotReported();

$num = $stmt->rowCount(); 

if($num>0){  
    $stakeholders_arr=array();
    $stakeholders_arr=array();    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){        
        extract($row);
         $stakeholder_item=array(
            "NotReported" => (int)$NotReported, 	  
            "ReportingYear" => $ReportingYear
        ); 
        array_push($stakeholders_arr, $stakeholder_item);
    }    
    http_response_code(200);  
    echo json_encode($stakeholders_arr);
}
else{
    
    http_response_code(404);    
    echo json_encode(
        array("message" => "There is no [not reported] data found.")
    );
}