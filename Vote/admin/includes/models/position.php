<?php

class Position {
  
private static $tbl = "position_tbl";
  

 public static function insert_position($name, $organization){
//   $name = $name == '' ? '' : $name;
//   $organization = $organization == '' ? '' : $organization;
   
   global $database;
   $sql = "INSERT INTO ".self::$tbl." VALUES(NULL, '${name}', ${organization})";
   
   $result = $database->query_from_db($sql);
   
   return $database->success;
 }
  
  
public static function find_all_position(){
  $sql = "SELECT * FROM ".self::$tbl;
  global $database;
  $result_set = $database->query_from_db($sql);
  return $result_set;
}
  
//Query involving FK's
private static function find_position_by_org_id($id){
  $sql = "SELECT * FROM ".self::$tbl." WHERE organization_id = ${id}";
  global $database;
  $result_set = $database->query_from_db($sql);
  return $result_set;
}
  
private static function selectElementByOrganizationID($data){
  while($row = mysqli_fetch_array($data)){
  echo "<option value=".$row['position_name'].">".$row['position_name']."</option>";
}

}
  
public static function select_position_element_by_org_id($id){
  global $database;
  $data = self::find_position_by_org_id($id);
  self::selectElementByOrganizationID($data);
}
  
  


public static function select_position_element(){
  global $database;
  $data = self::find_all_organization();
  $database->selectElement($data);
}
    
    
//Tables Methods here...
public static function position_table_show_all(){
    $table = self::find_all_position();
    while($row = mysqli_fetch_array($table)){
        $org_name = Organization::get_org_placeholder_id($row['organization_id'], 'name');
        dom_string('<tr>');
        dom_string('<td>'.$row['position_name'].'</td>');
        dom_string('<td>'.$org_name.'</td>');
        dom_string('</tr>');
        
    }
}
  
  
}
































?>