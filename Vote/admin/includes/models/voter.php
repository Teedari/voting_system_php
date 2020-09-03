<?php

class Voter{
private static $tbl_base = "voters_tbl";
public $voter_id;
public $voter_number;
public $voter_index;
public $voter_email;
public $activate;
public $activation_key;
  
public static function instantiation($found_voter){
  $the_object = new self;
//  $the_object->voter_id = $found_voter['voter_id'];
//  $the_object->voter_number = $found_voter['voter_number'];
//  $the_object->voter_index = $found_voter['voter_index'];
//  $the_object->voter_email = $found_voter['voter_email'];
//  $the_object->activate = $found_voter['activate'];
//  $the_object->activation_key = $found_voter['activation_key'];
  
  foreach($found_voter  as $props => $val){
    if($the_object->has_the_props($props)){
      $the_object->$props = $val; 
    }
  }
  return $the_object;
}  
  
private function has_the_props($object){
  //get all props in a class;
  $props = get_object_vars($this);
  return array_key_exists($object, $props);
}
  
public static function find_voter_by_id($id){
  $sql = "SELECT * FROM ".Voter::$tbl_base." WHERE voter_id = $id LIMIT 1";
  $result_set = self::find_query($sql);
  $result_array = self::loop_instance($result_set);
  return self::fetch_first_item($result_array);
}
  
private function loop_instance($obj){
    $object_array = array();
    while($row = mysqli_fetch_array($obj)){
     $object_array[] = self::instantiation($row);
    }
    return $object_array;
  }

private function fetch_first_item($arr){
  return !empty($arr) ? array_shift($arr) : false;
}
  public static function find_all_voters(){
  $sql = "SELECT * FROM ".Voter::$tbl_base;
  $result_set = self::find_query($sql);

  return self::loop_instance($result_set);
}
private static function find_query($sql){
global $database;
return $database->query_from_db($sql);
}
  
private static function list_emails(){

}
  
  
public static function check_if_email_exist($email){
 $nameExits = false;
  global $database;
  
  $sql = "SELECT voter_email FROM voters_tbl WHERE voter_email = '${email}'";
  
  $res = $database->query_from_db($sql);
  
  if(mysqli_num_rows($res) > 0){
    $nameExits = true;
  }
  return $nameExits;
}
  
  
public static function insert_voters($num, $index, $email){
  global $database;
  $res = false;
  
  if(self::validate_std_index($num, $index) && !self::validate_voters($num, $index)){
  
  $activate = 0;
  $activate_key = self::genKeyCode();
    
  $timer = date('Y-m-d h:i:sa');
  $sql = "INSERT INTO voters_tbl VALUES(NULL,'${num}', '${index}', '${email}', '${activate}', '${activate_key}', '${timer}')";
    
  $result = $database->query_from_db($sql);
    
  $res = $database->success;
  }
  
  return $res;
}

private static function validate_std_index($num,$index){
  global $database;
  $sql = " SELECT * FROM student_card_tbl WHERE student_number = ${num} AND student_index_no = '${index}'";
  
  $res = $database->query_from_db($sql);
  
  $isFound = self::numRows($res);
  return $isFound;
}
  
private static function validate_voters($num,$index){
  global $database;
  $sql = " SELECT * FROM voters_tbl WHERE voter_number = ${num} AND voter_index = '${index}'";
  
  $res = $database->query_from_db($sql);
  
  $isFound = self::numRows($res);
  return $isFound;
} 

private static function numRows($res){
  $rows = mysqli_num_rows($res) > 0 ? true : false;
  return $rows;
}

public static function genKeyCode(){
  $timeCode = substr(time(),5);
  return $timeCode;
}
  
   


//find out if the student has verified his/her email

//Save generate code to database of the specific user by username / voter_index
public static function save_gen_code($index_no, $keygen = ''){
    $keygen = empty($keygen) ? self::genKeyCode() : $keygen;
    global $database;
    
    $sql = "UPDATE ".self::$tbl_base. " SET activation_key = '{$keygen}' WHERE voter_index = '{$index_no}'";
    $res = $database->query_from_db($sql);
    return $res;
}

// Retrieve saved activation key from db to validate
public static function retrieve_key($index_no, $key){
  $sql = "SELECT activation_key FROM ".self::$tbl_base. " WHERE voter_index = '{$index_no}' LIMIT 1";
  $result_set = self::find_query($sql);
  $result_array = self::loop_instance($result_set);
  $data =  self::fetch_first_item($result_array);
  $res = $data->activation_key == $key ? true : false;
  return $res;  
}
    
// Email activate 
        public static function email_activate($index_no){
        global $database;
        $username = $database->escape_string($index_no);
        $sql = "UPDATE voters_tbl SET activate = 1 WHERE voter_index = '{$username}'";
        $result_set = $database->query_from_db($sql);
        return $result_set;
    }


}


?>