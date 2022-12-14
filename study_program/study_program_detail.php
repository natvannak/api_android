<?php  
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   
   $response = array();  
   
   if(isset($_GET['id'])){
      
      require_once $_SERVER['DOCUMENT_ROOT']. '/api_android/config/Database.php'; 
      $db = new Database();  
      $query = "SELECT level_kh, description FROM tbl_education_levels WHERE study_program = " . $_GET['id'];
      
   
      $result = mysqli_query($db->connect(),$query);  
      
      if (mysqli_num_rows($result) > 0) {  
   
   
         $response["status"] = array("code"=>200,"message"=>"success");
         $response["data"] = array();  
         $response["data"]['education_levels'] = array();
   
         while ($row = mysqli_fetch_assoc($result)) {
            array_push($response["data"]['education_levels'], $row);  
         }
         
   
      } else {  
   
         $response["status"] = array("code"=>400,"message"=>"No Data");

      }
   }
   else{
      $response["status"] = array("code"=>400,"message"=>"Empty ID");
   }
     
   echo json_encode($response);  
 
?>