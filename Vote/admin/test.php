<?php

require_once("includes/init.php");

function genRandomStudent(){
      $init = 0;

  
    $keyString = 'UE';
    $keyStringLength = 10;
    $index_no_start = 29999999;
    $stud_no_start = 10000000;
    
    $codeLimit = 10;
    $name = "Unknown ";

    while($init < 100){
      $newName =  $name. ''.$init;
      $stud = $stud_no_start;
      $index = 'UE' . $index_no_start;
      
      $sql = "INSERT INTO student_card_tbl VALUES(NULL, '${newName}',${stud}, '${index}', 2020)";
       $database->query_from_db($sql);
      echo $newName ."<br>";
      
      echo $stud . ' ==> ' . $index . '<br>';
      
        $stud_no_start++;
        $index_no_start--;
      $init++;
    }
}

echo date('Y-m-d h:i:sa');


$sql = "select * from position_tbl where position_id = 1";
$res = $database->query_from_db($sql);
$row = mysqli_fetch_array($res);
echo "<br>";
echo $row['organization_id'];
?>