<?php require_once("new_config.php");   ?>
<?php

class Database {
  public $connection;
  public $success = false;
  

  function __construct(){
      $this->db_connection_open();
    }

  public function db_connection_open(){
      $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      if(mysqli_connect_errno()){
        die("Database connection failed " .mysqli_error());
      }
//      else{
//echo "connected";}
  }

  private function confirm_query($result){
    
  if(!$result){
    die("Query Failed");
  }else{
    $this->setSuccess(true); 
  }
      
  }
  
  public function query_from_db($sql){

  $result = mysqli_query($this->connection,$sql);
 
  $this->confirm_query($result);
    
  return $result;

  }
  
  
  public function escape_string($str){
    return mysqli_real_escape_string($this->connection,$str);
  }
  
  
  private function setSuccess($success){
    $this->success = $success;
  }
  
  public function selectElement($data){
    while($row = mysqli_fetch_array($data)){
    echo "<option value=".$row['organization_id'].">".$row['name']."</option>";
  }
    
  }
  
  
  public function validate_index_no($std_no,$index_no){
    $sql = "SELECT * FROM student_card_tbl WHERE student_number = '{$std_no}' AND student_index_no = '{$index_no}' LIMIT 1";
    $data = '';
    $is_found = false;
    $result = $this->query_from_db($sql);
    $res = mysqli_fetch_array($result);
    if(!empty($res)){
            if(count($res) > 0 ){
      $is_found = true;
      $one_student = mysqli_fetch_array($result);
//      $data = $one_student['student_index_no'];
      }
    }
    return $is_found;
  }
    
    //release result db
    public function release_result($is_release){
        $res = $is_release ? 1 : 0;
        $sql = "UPDATE release_tbl SET release_result = {$res} WHERE id = 1";
        $result = $this->query_from_db($sql);
        return $result;
    }    
    public function get_release_result(){
       
        $sql = "SELECT * FROM release_tbl WHERE id = 1";
        $result = $this->query_from_db($sql);
        $data = mysqli_fetch_array($result);
        
        return $data['release_result'];
    }
}



$database = new Database();
//$database->db_connection_open();
?>