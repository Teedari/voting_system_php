<?php require_once('includes/init.php') ?>

<?php
  
  
switch($_POST['type']){
  case 'position_dep':
    $id = $_POST['id'];
    Position::select_position_element_by_org_id($id);
    break;
  case 'validate_index':
//    $num = $_POST['number'];
//    $index = $_POST['index'];
//    $newIndex = $database->validate_index_no($num);
//    if($newIndex == $index){
//       echo 'true';
//    }
    global $database;
    $num = $_POST['number'];
    $index = $_POST['index'];
    $newIndex = $database->validate_index_no($num, $index);
    echo $newIndex;
   
    break;
  case 'email_check_exist':
     
    $name = $_POST['name'];
    
   
    if(!empty($name)){
     $exits = Voter::check_if_email_exist($name);
      echo $exits;
    }
    
      break;
  default:
    echo "Error";
  break;
}

?>