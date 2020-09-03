<?php require_once("../admin/includes/init.php")?>
<?php
 if(isset($_POST['code']))
 {
     $code =  $_POST['code'];
     Voter::save_gen_code($_SESSION['username'], $code);
     send_mail($_SESSION['email'], $code);
 }
    
    
    ?>