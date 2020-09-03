<?php

class Organization {
  
private static $tbl = "organization_tbl";
  

 public static function insert_organization($name, $founder, $slogan, $year){
   $year = $year == '' ? '0000' : $year;
   global $database;
   $sql = "INSERT INTO ".self::$tbl." VALUES(NULL, '${name}', '${founder}', '${slogan}', '${year}')";
   $result = $database->query_from_db($sql);
   
   return $database->success;
 }
 public static function update_organization($id, $name, $founder, $slogan, $year){
   $year = $year == '' ? '0000' : $year;
   global $database;
   $sql = "UPDATE ".self::$tbl." SET name = '${name}', founder = '${founder}', slogan = '${slogan}', ext_year = '${year}' WHERE organization_id = {$id}";
   $result = $database->query_from_db($sql);
   
   return $database->success;
 }
  
public static function find_organization_by_id($id){
  global $database;
  $id = $database->escape_string($id);
  $sql = "SELECT * FROM ".self::$tbl;
  $sql .= " WHERE organization_id = {$id} LIMIT 1";
  $result_set = $database->query_from_db($sql);
  return $result_set;
} 
public static function find_all_organization(){
  $sql = "SELECT * FROM ".self::$tbl;
  global $database;
  $result_set = $database->query_from_db($sql);
  return $result_set;
}
  
public static function select_orginazation_element(){
  global $database;
  $data = self::find_all_organization();
  $database->selectElement($data);
}
private static function find_name_by_id($id){
    global $database;
    $sql = "SELECT * FROM ".self::$tbl;
    $sql .= " WHERE organization_id = {$id} LIMIT 1";
    $res = $database->query_from_db($sql);
    $data = mysqli_fetch_array($res);
    return $data;
}
    
public static function get_org_placeholder_id($id, $placeholder){
    $data = self::find_name_by_id($id);
    $value = '';
    switch(strtolower($placeholder)){
        case 'name':
          $value = $data['name'];  
            break;
        default:
            $value = '';
            break;
    }
    return $value;
}
    

public static function organization_table_show_all(){
    $table = self::find_all_organization();
    while($row = mysqli_fetch_array($table)){
        dom_string('<tr>');
        dom_string('<td>'.$row['name'].'</td>');
        dom_string('<td>'.$row['founder'].'</td>');
        dom_string('<td>'.$row['slogan'].'</td>');
        dom_string('<td>'.$row['ext_year'].'</td>');
        dom_string('<td class="text-center">
        <a href="manage_organization.php?url=edit_organization&id='.$row['organization_id'].'" class="mr-4"><i class="fa fa-edit"></i></a>
        <a href="manage_organization.php?delete='.$row['organization_id'].'" class="text-danger"><i class="fa fa-trash"></i></a>
        </td>');
        dom_string('</tr>');
        
    }
}

public static function delete_organization($id){
    global $database;
    $id = $database->escape_string($id);
    $sql = "DELETE FROM ".self::$tbl;
    $sql .= " WHERE organization_id = {$id}";
    $del = $database->query_from_db($sql);
    $del_res = $del ? true : false;
    return $del_res;
}
  
}
































?>