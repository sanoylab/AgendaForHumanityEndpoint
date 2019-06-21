<?php
class Subcategory{ 
    
    private $conn;
    private $table_name = "reportsBySubcategoriesCombinedwithKeywords"; 
  
    public $Transformation_Short;
   
    public $SubCategoryName;
    public $Total;
    public $ReportingYear; 
   
    public function __construct($db){
        $this->conn = $db;
    }


function read(){ 
    $query = "SELECT `reportsBySubcategoriesCombinedwithKeywords`.Year AS ReportingYear, COUNT(DISTINCT `reportsBySubcategoriesCombinedwithKeywords`.report_line_id) AS Total, `reportsBySubcategoriesCombinedwithKeywords`.transformation_short AS Transformation_Short, `reportsBySubcategoriesCombinedwithKeywords`.subcategory AS SubCategoryName
     FROM `reportsBySubcategoriesCombinedwithKeywords` WHERE (`reportsBySubcategoriesCombinedwithKeywords`.subcategory <> '') AND(`reportsBySubcategoriesCombinedwithKeywords`.report_line_id IS NOT NULL) 
   GROUP BY `reportsBySubcategoriesCombinedwithKeywords`.Year, `reportsBySubcategoriesCombinedwithKeywords`.transformation_short, `reportsBySubcategoriesCombinedwithKeywords`.subcategory";


  
    $stmt = $this->conn->prepare($query);
    
    $stmt->execute();
 
    return $stmt;
   }
}
?>