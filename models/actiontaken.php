<?php
class ActionTaken{ 
    
    private $conn;
    private $table_name = "reportsBySubcategoriesCombinedwithKeywords"; 
  
    public $Transformation_Short;
   
    public $ActionTaken;
    public $Total;
    public $ReportingYear; 
   
    public function __construct($db){
        $this->conn = $db;
    }


function read(){ 
    $query = "SELECT `reportsBySubcategoriesCombinedwithKeywords`.Year AS ReportingYear, COUNT(DISTINCT `reportsBySubcategoriesCombinedwithKeywords`.report_id) AS Total, `reportsBySubcategoriesCombinedwithKeywords`.transformation_short AS Transformation_Short, `reportsBySubcategoriesCombinedwithKeywords`.action_type AS ActionTaken
     FROM `reportsBySubcategoriesCombinedwithKeywords` WHERE (`reportsBySubcategoriesCombinedwithKeywords`.action_type <> '') AND(`reportsBySubcategoriesCombinedwithKeywords`.report_line_id IS NOT NULL) 
   GROUP BY `reportsBySubcategoriesCombinedwithKeywords`.Year, `reportsBySubcategoriesCombinedwithKeywords`.transformation_short, `reportsBySubcategoriesCombinedwithKeywords`.subcategory";


  
    $stmt = $this->conn->prepare($query);
    
    $stmt->execute();
 
    return $stmt;
   }

   function read_detail(){ 
     
    $query = "SELECT `reportsBySubcategoriesCombinedwithKeywords`.Year AS ReportingYear, COUNT(DISTINCT `reportsBySubcategoriesCombinedwithKeywords`.report_id) AS Total, `reportsBySubcategoriesCombinedwithKeywords`.transformation_short AS Transformation_Short, `reportsBySubcategoriesCombinedwithKeywords`.action_type AS ActionTaken, `reportsBySubcategoriesCombinedwithKeywords`.subcategory AS SubCategory, `reportsBySubcategoriesCombinedwithKeywords`.subcategory_type AS SubCategoryType
     FROM `reportsBySubcategoriesCombinedwithKeywords` WHERE (`reportsBySubcategoriesCombinedwithKeywords`.action_type <> '') AND(`reportsBySubcategoriesCombinedwithKeywords`.report_line_id IS NOT NULL) 
   GROUP BY `reportsBySubcategoriesCombinedwithKeywords`.Year, `reportsBySubcategoriesCombinedwithKeywords`.transformation_short, `reportsBySubcategoriesCombinedwithKeywords`.subcategory, `reportsBySubcategoriesCombinedwithKeywords`.subcategory, `reportsBySubcategoriesCombinedwithKeywords`.subcategory_type";


    
    $stmt = $this->conn->prepare($query);
    
    $stmt->execute();
 
    return $stmt;
   }
}
?>