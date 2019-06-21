<?php
class Transformation{ 
    
    private $conn;
    private $table_name = "raw_ws_PACT_reports"; 
  
    public $Transformation_Short;
    public $Transformation_Long;
    public $Total;
    public $ReportingYear; 
   
    public function __construct($db){
        $this->conn = $db;
    }


function read(){ 
     
    $query = "SELECT `raw_ws_PACT_reports`.transformation_short as Transformation_Short, `raw_ws_PACT_reports`.commitment_shift_transformation as Transformation_Long, COUNT(`raw_ws_PACT_reports`.report_line_id) AS Total, `raw_ws_PACT_reports`.reporting_year AS ReportingYear FROM `raw_ws_PACT_reports` LEFT OUTER JOIN `ref_transformation` ON `raw_ws_PACT_reports`.transformation_short = `ref_transformation`.Transformation WHERE (`raw_ws_PACT_reports`.`transformation_short` <> '') AND (`raw_ws_PACT_reports`.is_reported = 'Reported') AND (`raw_ws_PACT_reports`.report_status = 'Approved') GROUP BY `raw_ws_PACT_reports`.transformation_short, `raw_ws_PACT_reports`.commitment_shift_transformation, `raw_ws_PACT_reports`.reporting_year";

   // echo $query;
 //   exit;
    
    $stmt = $this->conn->prepare($query);
    
    $stmt->execute();
 
    return $stmt;
   }
}
?>


