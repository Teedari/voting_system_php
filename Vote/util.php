<?php require_once('admin/includes/init.php') ?>

<?php
  
  
switch($_POST['type']){
  case 'position_dep':
    $id = $_POST['id'];
    Position::select_position_element_by_org_id($id);
    break;
  default:
    echo "Error";
  break;
}

?>