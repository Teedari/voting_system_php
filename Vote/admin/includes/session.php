<?php

class Session{
private $signed_in;
public $user_id;
private $user_role;
private $username;
private $activate;
private $email;
    
    
function __construct(){
     session_start();
    $this->check_the_login();
 }


private function check_the_login(){
    if(isset($_SESSION['user_id'])){
        $this->user_id = $_SESSION['user_id'];
        $this->signed_in = true;
    }else{
        unset($this->user_id);
        $this->signed_in = false;
    }
}

public function is_signed_in(){
    return $this->signed_in;
}
    
public function is_admin(){
    $is_admin = $this->user_role == 1 ? true : false;
    return $is_admin;
}

//method to log in a user

public function login($user){
    if($user){
        $this->user_id = $_SESSION['user_id'] = $user->user_id;
        $this->user_role = $_SESSION['user_role'] = $user->user_role;
        $this->signed_in = true;
        $this->username = $_SESSION['username'] = $user->username;    
        //voter db
        if($this->user_role <= 0){
            $this->set_session_user_only();
        }
    }
}


private function set_session_user_only(){
        
        $voter_data = User::user_email_verified($this->username);
        $this->activate = $_SESSION['activate'] = $voter_data['activate'];
        $this->email = $_SESSION['email'] = $voter_data['voter_email'];
    
}

public function logout(){
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['activate']);
    unset($_SESSION['user_role']);
    unset($this->user_id);
    $this->signed_in = false;
    return !$this->signed_in;
}

public function login_user($username, $password){
 $data = User::verify_username_password($username, $password);
 $this->login($data);
}

    
}

$session = new Session();



?>