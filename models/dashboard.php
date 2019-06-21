<?php
class Dashboard{ 
    
    private $conn;
    private $table_name = "raw_ws_PACT_reports"; 
  
   
    
    public $Reported;
 public $NotReported;

    public $ReportingYear; 
   
    public function __construct($db){
        $this->conn = $db;
    }




   function read(){    
    
  $query = "SELECT (SELECT COUNT(DISTINCT org_name) AS NotReported FROM `raw_ws_PACT_reports` WHERE(`raw_ws_PACT_reports`.report_status = 'Not Reported') AND(`raw_ws_PACT_reports`.org_name NOT LIKE '%test%') AND(`raw_ws_PACT_reports`.org_name NOT LIKE 'Z Demo%') AND (`raw_ws_PACT_reports`.org_name <> '')) AS NotReported,  COUNT(DISTINCT `raw_ws_PACT_reports`.org_name) AS Reported, `raw_ws_PACT_reports`.reporting_year AS ReportingYear FROM `raw_ws_PACT_reports` LEFT OUTER JOIN `ref_orgtype` ON `raw_ws_PACT_reports`.type_name = `ref_orgtype`.Type_Name WHERE(`raw_ws_PACT_reports`.report_status = 'Approved') AND(`raw_ws_PACT_reports`.org_name NOT LIKE '%test%') AND(`raw_ws_PACT_reports`.org_name NOT LIKE 'Z Demo%') AND (`raw_ws_PACT_reports`.org_name <> '') GROUP BY `raw_ws_PACT_reports`.reporting_year ";    
    $stmt = $this->conn->prepare($query);    
    $stmt->execute();
 
    return $stmt;
   }


}
?>