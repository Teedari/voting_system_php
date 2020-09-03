<?php 
require_once('init.php');

$session->logout();
redirect('../../login.php');
?>