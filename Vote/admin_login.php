<?php include("admin/includes/init.php")?>
   <?php 
   if(isset($_POST['admin_login'])){
       $username = $_POST['admin_username'];
       $password = $_POST['admin_password'];
       $session->login_user( $username, $password);
    
   }

   ?>
   <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>UENR VOTING SYSTEM - Admin Login</title>

  <!-- Custom fonts for this template-->
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="">
<nav class="navbar navbar-expand-lg navbar-white bg-white shadow">
  <a class="navbar-brand" href="home.html">
    <img src="images/logo/logo2.png" />
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="ml-auto">
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="login.php">Student Portal<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_login.php">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Register Voter</a>
      </li>
    </ul>
    </div>
  </div>
</nav>
   
    <div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-4 col-md-6 m-auto">
            <div class="py-5 px-5 shadow">
               <img src="images/logo/logo.png"/>
                <h2 class="my-4 text-primary">Admin Login</h2>
                 <form action="" method="post" class="form">
                    <div class="form-group">
                       <label for="">username</label>
                       <input name="admin_username" type="text" class="form-control" required>
                   </div>
                   <div class="form-group">
                       <label for="">password</label>
                       <input name="admin_password" type="text" class="form-control" required>
                   </div>
                   <div class="form-group">
                       <button id="btnHide" type="submit" name="admin_login" class="btn btn-secondary px-5">Login</button>
                   </div>
               </form>
                
                  <!-- <?php if(isset($success) && $success == false) { ?>
                  <p class='text-center mb-4 text-danger'>Please enter a valid student number and index number.</p> 
                  <?php }else{ ?>
                   <p class='text-center mb-4 text-danger'></p><?php } ?> -->
              
               </div>
        </div>
    </div>
      <!-- Bootstrap core JavaScript-->
  <script src="admin/vendor/jquery/jquery.min.js"></script>
  <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>