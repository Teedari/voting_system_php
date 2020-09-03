<?php require_once('includes/init.php') ?>
<?php


if(isset($_POST['validate_index'])){
    global $database;
    $num = $_POST['number'];
    $index = $_POST['index'];
    $newIndex = $database->validate_index_no(10000000, 'UE29999999');
    echo 'true';
}

echo "hello";