<?php
class Challenges{ 
    
    private $conn;
    private $table_name = "raw_ws_PACT_reports"; 
  
    public $ChallengesShortCode;
    public $ChallengeID;
    public $Total;
    public $ReportingYear; 
   
    public function __construct($db){
        $this->conn = $db;
    }


function read(){ 
     
    $query = "SELECT COUNT(DISTINCT `raw_ws_PACT_reports`.report_line_id) AS Total, `ref_challenges`.Challenge_Short_code AS ChallengesShortCode, `ref_challenges`.Challenge_ID AS ChallengeID, 
    `raw_ws_PACT_reports`.reporting_year AS ReportingYear
    FROM  `raw_ws_PACT_reports` LEFT OUTER JOIN `raw_ws_PACT_KeyChallenges` ON `raw_ws_PACT_reports`.report_line_id = `raw_ws_PACT_KeyChallenges`.report_line_id LEFT OUTER JOIN
    `ref_challenges` ON `raw_ws_PACT_KeyChallenges`.challenge = `ref_challenges`.Challenge
    WHERE (`ref_challenges`.Challenge_Short_code <>'') AND(`raw_ws_PACT_reports`.org_name NOT LIKE '%test%') AND(`raw_ws_PACT_reports`.org_name NOT LIKE 'Z Demo%') AND(`raw_ws_PACT_KeyChallenges`.challenge IS NOT NULL) AND
    (`raw_ws_PACT_KeyChallenges`.challenge <> '') AND(`raw_ws_PACT_reports`.is_reported = 'Reported') AND
    (`raw_ws_PACT_reports`.report_status = 'Approved') GROUP BY `ref_challenges`.Challenge_Short_code, `ref_challenges`.Challenge_ID, `raw_ws_PACT_reports`.reporting_year";


    
    $stmt = $this->conn->prepare($query);
    
    $stmt->execute();
 
    return $stmt;
   }

function read_detail(){ 
     
    $query = "SELECT COUNT(DISTINCT `raw_ws_PACT_reports`.report_line_id) AS Total, `ref_challenges`.Challenge_Short_code AS ChallengesShortCode, `raw_ws_PACT_reports`.`transformation_short` AS Transformation_Short, 
    `raw_ws_PACT_reports`.reporting_year AS ReportingYear
    FROM  `raw_ws_PACT_reports` LEFT OUTER JOIN `raw_ws_PACT_KeyChallenges` ON `raw_ws_PACT_reports`.report_line_id = `raw_ws_PACT_KeyChallenges`.report_line_id LEFT OUTER JOIN
    `ref_challenges` ON `raw_ws_PACT_KeyChallenges`.`challenge` = `ref_challenges`.Challenge
    WHERE (`ref_challenges`.Challenge_Short_code <>'') AND(`raw_ws_PACT_reports`.org_name NOT LIKE '%test%') AND(`raw_ws_PACT_reports`.org_name NOT LIKE 'Z Demo%') AND(`raw_ws_PACT_KeyChallenges`.`challenge` IS NOT NULL) AND
    (`raw_ws_PACT_KeyChallenges`.`challenge` <> '') AND(`raw_ws_PACT_reports`.`transformation_short` <> '') AND(`raw_ws_PACT_reports`.is_reported = 'Reported') AND
    (`raw_ws_PACT_reports`.report_status = 'Approved') GROUP BY `ref_challenges`.Challenge_Short_code, `raw_ws_PACT_reports`.transformation_short, `raw_ws_PACT_reports`.reporting_year";


    
    $stmt = $this->conn->prepare($query);
    
    $stmt->execute();
 
    return $stmt;
   }


}
?>


