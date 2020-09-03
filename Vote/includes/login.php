<?php
if(isset($_POST['admin_login'])){
    echo "admin";
    header("Location: ../admin_login.php");
}



if(isset($_POST['user_login'])){
    echo "user";
}