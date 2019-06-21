<?php
class CrosscuttingIssues{ 
    
    private $conn;
    private $table_name = "raw_ws_PACT_reports"; 
  
    public $Transformation;
    public $CCI;
    public $Total;
    public $ReportingYear; 
   
    public function __construct($db){
        $this->conn = $db;
    }


function read(){ 
     
    $query = "SELECT  COUNT(DISTINCT `raw_ws_PACT_reports`.report_line_id) AS Total, `raw_ws_PACT_reportCci`.cci AS CCI, `raw_ws_PACT_reports`.reporting_year AS ReportingYear ".

" FROM            `raw_ws_PACT_reports` LEFT OUTER JOIN".
    " `raw_ws_PACT_reportCci` ON `raw_ws_PACT_reports`.report_line_id = `raw_ws_PACT_reportCci`.report_line_id LEFT OUTER JOIN".
    " `ref_cci` ON `raw_ws_PACT_reportCci`.cci = `ref_cci`.`Cros_ Cutting_Issue`".
" WHERE        (`raw_ws_PACT_reportCci`.cci IS NOT NULL) AND (`raw_ws_PACT_reportCci`.cci <> '') AND (`raw_ws_PACT_reports`.org_name NOT LIKE '%test%') AND ".
    " (`raw_ws_PACT_reports`.org_name NOT LIKE 'Z Demo%') AND (`raw_ws_PACT_reports`.report_status = 'Approved')".
" GROUP BY `raw_ws_PACT_reportCci`.cci, `raw_ws_PACT_reports`.reporting_year";  
    $stmt = $this->conn->prepare($query);    
    $stmt->execute(); 
    return $stmt;
   }

function read_detail(){ 
     
    $query = "SELECT  COUNT(DISTINCT `raw_ws_PACT_reports`.report_line_id) AS Total, `raw_ws_PACT_reportCci`.cci AS CCI, `raw_ws_PACT_reports`.`transformation_short` AS Transformation_Short, `raw_ws_PACT_reports`.reporting_year AS ReportingYear FROM `raw_ws_PACT_reports` LEFT OUTER JOIN          `raw_ws_PACT_reportCci` ON `raw_ws_PACT_reports`.report_line_id = `raw_ws_PACT_reportCci`.report_line_id LEFT OUTER JOIN `ref_cci` ON `raw_ws_PACT_reportCci`.cci = `ref_cci`.`Cros_ Cutting_Issue`
    WHERE (`raw_ws_PACT_reportCci`.cci IS NOT NULL) AND (`raw_ws_PACT_reportCci`.cci <> '') AND (`raw_ws_PACT_reports`.org_name NOT LIKE '%test%') AND 
        (`raw_ws_PACT_reports`.org_name NOT LIKE 'Z Demo%') AND (`raw_ws_PACT_reports`.`transformation_short` <> '') AND (`raw_ws_PACT_reports`.report_status = 'Approved')
    GROUP BY `raw_ws_PACT_reportCci`.cci, `raw_ws_PACT_reports`.transformation_short, `raw_ws_PACT_reports`.reporting_year";  
    $stmt = $this->conn->prepare($query);    
    $stmt->execute(); 
    return $stmt;
   }


  

}
?>