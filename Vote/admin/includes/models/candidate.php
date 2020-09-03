<?php

class Candidate {
  
private static $tbl = "candidate_tbl";
  

 public static function insert_candidate($name, $email, $phone, $level, $std_no, $index_no, $program, $organization, $position, $image){
   global $database;
   $sql = "INSERT INTO ".self::$tbl." VALUES(NULL, '${name}', '${email}', '${phone}', '${level}', '${std_no}', '${index_no}', '${program}', '${organization}', '${position}', '{$image}')";
   $result = $database->query_from_db($sql);
   
   
//   return !mysqli_connect_errno();
   
   return $database->success;
 }

 public static function update_candidate($id, $name, $email, $phone, $level, $std_no, $index_no, $program, $organization, $position, $profile){
   global $database;
   $sql = "UPDATE ".self::$tbl." SET name = '${name}',email = '${email}', phone = '${phone}', level = {$level}, std_no = {$std_no}, std_index_no = '${index_no}', program = '{$program}', organization_id = {$organization}, position = '${position}', profile_picture = '{$profile}' WHERE candidate_id = {$id}";
   $result = $database->query_from_db($sql);
   
   
//   return !mysqli_connect_errno();
   
   return $database->success;
 }
  
//public static function find_all_organization(){
//  $sql = "SELECT * FROM ".self::$tbl;
//  global $database;
//  $result_set = $database->query_from_db($sql);
//  return $result_set;
//}  
public static function find_all_candidate(){
  $sql = "SELECT * FROM ".self::$tbl;
  global $database;
  $result_set = $database->query_from_db($sql);
  return $result_set;
}

public static function find_candidate_by_id($id){
  global $database;
  $id = $database->escape_string($id);
  $sql = "SELECT * FROM ".self::$tbl;
  $sql .= " WHERE candidate_id = {$id} LIMIT 1";
  $result_set = $database->query_from_db($sql);
  return $result_set;
}
public static function find_all_candidate_by_org_id_pos($org_id, $pos){
  $sql = "SELECT * FROM ".self::$tbl;
  $sql .= " WHERE organization_id = {$org_id} AND position = '{$pos}'";
  global $database;
  $result_set = $database->query_from_db($sql);
  return $result_set;
}
  
  
public static function select_orginazation_element(){
  global $database;
  $data = self::find_all_organization();
  $database->selectElement($data);
}

private static function find_candidate_by_org_id_and_pos($org_id, $pos){
  global $database;
//  $id = $database->escape_string($org_id);
//  $pos = $database->escape_string($pos);
  $id = $org_id;
  $pos = $pos;
  $sql = "SELECT candidate_id, name, std_index_no, level, program, position ,organization_id, profile_picture FROM ".self::$tbl;
  $sql .= " WHERE organization_id = {$id} AND position = '{$pos}'";
  $result_set = $database->query_from_db($sql);
  return $result_set;
}
 
public static function validate_voter($org_id, $pos, $user_id){
  global $database;
  
  $id = $org_id;
  $pos = $pos;
  $user_id= $_SESSION['user_id'];
  $sql = "SELECT * FROM vote_tbl";
  $sql .= " WHERE organization_id = {$id} AND position = '{$pos}' AND user_id = {$user_id} LIMIT 1";
  $res = $database->query_from_db($sql);
  $data = mysqli_fetch_array($res);
  return $data;
}
  
  
public static function display_voters_card($user_id,$org_id, $pos){
  $card = '';
  $data = self::find_candidate_by_org_id_and_pos($org_id, $pos);
  while($row = mysqli_fetch_assoc($data)){
  $name = $row['name'];
  $org_id = $row['organization_id'];
  $pos = $row['position'];
  $program = $row['program'];
  $index = $row['std_index_no'];
  $profile = $row['profile_picture'];
  $record = self::validate_voter($org_id, $pos, $user_id);
if(empty($record)){
  $card = self::show_card($user_id,$name, $org_id, $pos, $program, $index, $profile, true);

}else{
  
  $card = self::show_card($user_id,$name, $org_id, $pos, $program, $index, $profile, false);
}
  echo $card;
  }
  
}
private static function show_card($user_id,$name, $org_id, $pos, $program, $index, $profile, $exit){
  $card = '';
  if($exit){
  $card = '<div class="card mb-4" style="width: 18rem;">
          <div class="card-body">
              <img style="height: 15rem; width: 15rem; object-fit: cover; border-radius: 50%;" class="card-img-top" src="images/'.$profile.'" alt="Card image cap">
              <div class="card-block">
            <h5 class="card-title my-2">'.$pos.'</h5>
            <h6 class="card-subtitle mb-2 text-muted">NUGS</h6>
            <p class="card-text">I\'m '.$name.', a level 400 student. <small class="text-muted">Pursing '.$program.'</small></p>
           <p>
           <small class="text-muted mb-4">'.$index.'</small>
           </p>
           <p><input hidden class="id_user" checked type="checkbox" value="'.$user_id.'"></p>
            <a href="index.php?name='.$name.'& pos='.$pos.'& org_id='.$org_id.'& vote=true" id="vote_btn" class="btn btn-dark">Vote</a>
          </div>
        </div></div>';
    
  }else{
      $card = '<div class="card mb-4" style="width: 18rem;">
          <div class="card-body">
           <img style="height: 15rem; width: 15rem; object-fit: cover; border-radius: 50%;" class="card-img-top" src="./images/'.$profile.'" alt="Card image cap">
          <div class="card-block text-center">
            <h5 class="card-title my-2">'.$pos.'</h5>
            <h6 class="card-subtitle mb-2 text-muted">NUGS</h6>
            <p class="card-text">I\'m '.$name.', a level 400 student. <small class="text-muted">Pursing '.$program.'</small></p>
           <p>
           <small class="text-muted mb-4">'.$index.'</small>
           </p>
           <p><input hidden class="id_user" checked type="checkbox" value="'.$user_id.'"></p>
            <a hidden href="index.php?name='.$name.'& pos='.$pos.'& org_id='.$org_id.'& vote=true" id="vote_btn" class="btn btn-dark">Vote</a>
          </div>
        </div></div>';
  }
  return $card;
}
  
public static function vote($user_id, $name, $org_id, $pos, $vote){
    $record = self::validate_voter($org_id, $pos, $user_id);
  if(empty($record)){
    
  global $database;
  $sql = "INSERT INTO vote_tbl VALUES(NULL,'{$name}', {$org_id}, '{$pos}', 1, {$user_id})";
  $res = $database->query_from_db($sql);
  if($res > 0){return true;}else{return false;}
  }
}
  
    
    //Table methods goes here ....
    public static function candidate_table_show_all(){
    $table = self::find_all_candidate();
    while($row = mysqli_fetch_array($table)){
        
        $org_name = Organization::get_org_placeholder_id($row['organization_id'], 'name');
        dom_string('<tr>');
        dom_string('<td>'.$row['name'].'</td>');
        dom_string('<td>'.$row['email'].'</td>');
        dom_string('<td>'.$row['level'].'</td>');
        dom_string('<td>'.$row['std_index_no'].'</td>');
        dom_string('<td>'.$row['program'].'</td>');
        dom_string('<td>'.$org_name.'</td>');
        dom_string('<td>'.$row['position'].'</td>');
        dom_string('<td class="text-center">
        <a href="manage_candidate.php?url=edit_candidate&id='.$row['candidate_id'].'" class="mr-4"><i class="fa fa-edit"></i></a>
        <a href="manage_candidate.php?delete='.$row['candidate_id'].'" class="text-danger"><i class="fa fa-trash"></i></a>
        </td>');
        dom_string('</tr>');
        
    }
}
    
    public static function delete_candidate($id){
    global $database;
    $id = $database->escape_string($id);
    $sql = "DELETE FROM ".self::$tbl;
    $sql .= " WHERE candidate_id = {$id}";
    $del = $database->query_from_db($sql);
    $del_res = $del === true ? true : false;
    return $del_res;
}
    
    
    
    
    
    
}




































?>