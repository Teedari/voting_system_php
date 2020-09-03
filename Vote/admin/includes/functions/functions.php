<?php


function success_info($msg,$title){
   echo"<p class='alert alert-success'>".$msg."<small class='text-muted'>".$title."</small>
       </p>"; 
}


function __autoload($class){
   $class = strtolower($class);
   $path = "admin/includes/models/{$class}.php";
   if(file_exists($path)){
      require_once($path);
   }
   else{die("The class file name {$class}.php doesn't exit in our models folder path: {$path}");};
}



function redirect($location){
  header("Location: {$location }"); 
}

function dom_string($str){
    echo $str;
}

function send_mail($email, $code){
$sender_mail = $email;
$subject = "UENR Voting System Verification Code";
$body = "Enter the code this {$code} to verify your account.";
if(mail($sender_mail, $subject, $body)){
    return true;  
}else{
   return false;
}
   
   
}


if(isset($_GET['logout'])){
    echo "logout";
    global $session;
    if($session->logout()){
     redirect('../login.php');
    }
}