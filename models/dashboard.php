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




   function readReported(){    
    
  $query = "SELECT `raw_ws_PACT_reports`.reporting_year AS ReportingYear, COUNT(DISTINCT `raw_ws_PACT_reports`.org_name) AS Reported FROM `raw_ws_PACT_reports` LEFT OUTER JOIN `ref_orgtype` ON `raw_ws_PACT_reports`.type_name = `ref_orgtype`.Type_Name WHERE(`raw_ws_PACT_reports`.report_status = 'Approved') AND(`raw_ws_PACT_reports`.org_name NOT LIKE '%test%') AND(`raw_ws_PACT_reports`.org_name NOT LIKE 'Z Demo%') AND (`raw_ws_PACT_reports`.org_name <> '') GROUP BY `raw_ws_PACT_reports`.reporting_year";    
    $stmt = $this->conn->prepare($query);    
    $stmt->execute();
 
    return $stmt;
   }

   function readNotReported(){    
    
    $query = "SELECT `raw_ws_PACT_reports`.reporting_year AS ReportingYear, COUNT(DISTINCT org_name) AS NotReported FROM `raw_ws_PACT_reports` WHERE (`raw_ws_PACT_reports`.report_status NOT LIKE 'Approved' and org_name NOT LIKE 'z demo ngo' AND `raw_ws_PACT_reports`.org_name NOT LIKE '%test%') GROUP BY `raw_ws_PACT_reports`.reporting_year";    
      $stmt = $this->conn->prepare($query);    
      $stmt->execute();
   
      return $stmt;
     }


}
?>