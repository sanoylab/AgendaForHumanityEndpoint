<?php
class Stakeholder{ 
    
    private $conn;
    private $table_name = "raw_ws_PACT_reports"; 
  
    public $Stakeholder;
    
    public $Total;
    public $ReportingYear; 
   
    public function __construct($db){
        $this->conn = $db;
    }


function read_organization(){ 
     
    $query = "SELECT `raw_ws_PACT_reports`.type_name AS Stakeholder, COUNT(DISTINCT `raw_ws_PACT_reports`.org_name) AS Total, `raw_ws_PACT_reports`.reporting_year AS ReportingYear     FROM `raw_ws_PACT_reports` LEFT OUTER JOIN ".
                      " `ref_orgtype` ON `raw_ws_PACT_reports`.type_name = `ref_orgtype`.Type_Name WHERE(`raw_ws_PACT_reports`.report_status = 'Approved') AND(`raw_ws_PACT_reports`.org_name NOT LIKE '%test%') AND(`raw_ws_PACT_reports`.org_name NOT LIKE 'Z Demo%') AND (`raw_ws_PACT_reports`.org_name <> '') ".
                       " GROUP BY `raw_ws_PACT_reports`.type_name, `raw_ws_PACT_reports`.reporting_year";    
    $stmt = $this->conn->prepare($query);    
    $stmt->execute(); 
    return $stmt;
   }

   function read_region(){      
    $query = "SELECT  `raw_ws_PACT_reports`.region_name AS Stakeholder, `raw_ws_PACT_reports`.reporting_year AS ReportingYear, COUNT(DISTINCT `raw_ws_PACT_reports`.org_name) AS Total".
    " FROM `raw_ws_PACT_reports` LEFT OUTER JOIN".
                             " `ref_region` ON `raw_ws_PACT_reports`.region_name = `ref_region`.Region_name".
    " WHERE(`raw_ws_PACT_reports`.report_status = 'Approved') AND(`raw_ws_PACT_reports`.org_name NOT LIKE '%test%') AND(`raw_ws_PACT_reports`.org_name NOT LIKE 'Z Demo%') AND".
                   " (`raw_ws_PACT_reports`.org_name <> '')".
    " GROUP BY `raw_ws_PACT_reports`.reporting_year, `raw_ws_PACT_reports`.region_name";
        $stmt = $this->conn->prepare($query);    
    $stmt->execute();
 
    return $stmt;
   }
   function read_total(){    
    
    $query = "SELECT COUNT(DISTINCT `raw_ws_PACT_reports`.org_name) AS Total, `raw_ws_PACT_reports`.reporting_year AS ReportingYear FROM `raw_ws_PACT_reports` LEFT OUTER JOIN `ref_orgtype` ON `raw_ws_PACT_reports`.type_name = `ref_orgtype`.Type_Name WHERE(`raw_ws_PACT_reports`.report_status = 'Approved') AND(`raw_ws_PACT_reports`.org_name NOT LIKE '%test%') AND(`raw_ws_PACT_reports`.org_name NOT LIKE 'Z Demo%') AND (`raw_ws_PACT_reports`.org_name <> '') GROUP BY `raw_ws_PACT_reports`.reporting_year ";    

    $stmt = $this->conn->prepare($query);    
    $stmt->execute();
 
    return $stmt;
   }

}
?>