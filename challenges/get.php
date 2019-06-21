<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../models/challenges.php';
 
$database = new Database();
$db = $database->getConnection();
 
$challenge = new Challenges($db); 
$stmt = $challenge->read();
$num = $stmt->rowCount(); 

if($num>0){  
    $challenges_arr=array();
    $challenges_arr=array();    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){        
        extract($row);
         $challenge_item=array(
            "ChallengesShortCode" => $ChallengesShortCode,
            "ChallengeID" => $ChallengeID,
            "Total" => (int)$Total,
            "ReportingYear" => $ReportingYear
        ); 
        array_push($challenges_arr, $challenge_item);
    }    
    http_response_code(200);  
    echo json_encode($challenges_arr);
}
else{
    
    http_response_code(404);    
    echo json_encode(
        array("message" => "No challenge found.")
    );
}
 
