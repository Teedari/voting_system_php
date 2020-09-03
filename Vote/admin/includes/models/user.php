  <?php

class User {
    private static $tbl_base = "users";
    public $user_id;
    public $username;
    public $password;
    public $user_role;
    
    
    //methods goes here....
public static function instantiation($found_user){
  $the_object = new self;
//  $the_object->username = $found_user['username'];
//  $the_object->password = $found_user['password'];
  
  foreach($found_user as $props => $val){
    if($the_object->has_the_props($props)){
      $the_object->$props = $val; 
    
    }
  }
  return $the_object;
} 
private function loop_the_instance($obj){
    $object_array = array();
    while($row = mysqli_fetch_array($obj)){
     $object_array[] = self::instantiation($row);
    }
    return $object_array;
  }
 private function has_the_props($object){
        $result_obj = get_object_vars($this);
        return array_key_exists($object, $result_obj);
    }
    public static function find_all_users(){
        $sql = "SELECT * FROM ".self::$tbl_base;
        $query_result = self::find_query($sql);
        return self::loop_the_instance($query_result);
        
    }
    private static function find_query($sql){
        global $database;
        $result  = $database->query_from_db($sql);
        return $result;
        
    }
    
    public static function insert_user($username, $password, $user_role){
     $sql = "INSERT INTO ".self::$tbl_base;
     $sql .= " VALUES(NULL, '{$username}', '{$password}', {$user_role})";
     return self::find_query($sql);
    }
    
    public static function find_user_by_id($id){
          global $database;
          
          $sql = "SELECT * FROM ".self::$tbl_base." WHERE user_id = {$id} LIMIT 1";
          $result_set = self::find_query($sql);
          $result_array = self::loop_the_instance($result_set);
          return self::fetch_first_item($result_array);
    }
    public static function find_user_by_username_and_password($username, $password){
          global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
          $sql = "SELECT * FROM ".self::$tbl_base." WHERE username = '{$username}' AND password = '{$password}'";
          $result_set = self::find_query($sql);
          $result_array = self::loop_the_instance($result_set);
          return self::fetch_first_item($result_array);
    }
    private function fetch_first_item($arr){
        return !empty($arr) ? array_shift($arr) : false;
}
    
    //find all users
    
    public static function verify_username_password($username, $password){
     $data = self::find_user_by_username_and_password($username, $password);
  
if(!empty($data)){
               if($username == $data->username && $password == $data->password){

             self::switch_user($data);
            return $data;
           }
}
        return false;
    }
    
    public static function switch_user($user_info){

       $role = $user_info->user_role;
       $user_name = $user_info->username;
       switch($role){
           case 0:

                $data = self::user_email_verified($user_name);
                $key = $data['activate'];
               echo $key;
               if($key <= 0){       
                    
                  redirect("./verification.php?email_sent=true");
        
               }else{
                   redirect("./index.php");
              
               }
               break;
           case 1:
               redirect("admin");
               break;
           default:
               redirect('login.php');
               break;
       }
    }
    
    public static function user_email_verified($username){
        global $database;
        $username = $database->escape_string($username);
        $sql = "SELECT voter_id, voter_email, activate FROM voters_tbl WHERE voter_index = '{$username}' LIMIT 1";
        $result_set = $database->query_from_db($sql);
        $data = mysqli_fetch_array($result_set);
        return $data;
    }
    
    
    public static function email_activate($username, $key){
        global $database;
        $username = $database->escape_string($username);
        $sql = "UPDATE voters_tbl SET activate = 1, activation_key = '{$key}' WHERE voter_index = '{$username}'";
        $result_set = $database->query_from_db($sql);
        return true;
    }

    
    
}


?>