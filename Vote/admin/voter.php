<?php include("includes/admin_header.php") ?>
<!-- Nav Bar -->
  <?php include("includes/admin_navbar.php") ?>

  <div id="wrapper">
    <?php
  
  if(isset($_POST['register'])){
    $number = $database->escape_string($_POST['std_number']);
    $index = $database->escape_string($_POST['index_number']);
    $email = $database->escape_string($_POST['email']);
    
   $success = Voter::insert_voters($number, $index, $email);
    if($success){ User::insert_user($index, $number, 0); }
    
    
    
  }
  
  
  
  ?>

    <!-- Sidebar -->
    <?php
      include("includes/admin_sidebar.php");
    ?>

    <div id="content-wrapper">

      <div class="container-fluid">

       <?php 
        
        if(isset($success) && $success == true){
          
        success_info("New Voter Registered successfully", "voter table");
          
        }
          
        ?>
        <h1 class="display-4 font-weight-bold text-lg-center">Register New Voter</h1>
        <hr>

        <!-- Body goes heree.... -->
       <div class="row">
           <div class="col-md-12 col-lg-6 m-auto">
               <div class="py-5 px-5 shadow">
                <h2 class="text-center mb-4 text-primary">Voter Registration</h2>
                 <form action="" method="post" class="form">
                   <div class="form-group">
                       <label for="">Student number</label>
                       <input name="std_number" type="number" class="form-control" required>
                   </div>
                    <div class="form-group">
                       <label for="">Index number</label>
                       <input name="index_number" type="text" class="form-control" required>
                   </div>
                  <div class="form-group">
                       <label for="">Email</label>
                       <input name="email" id="email" type="email" class="form-control" required>
                       <p id="email_alert" class="text-danger text-mute"><input checked hidden type="checkbox"></p>
                   </div>
                   <div class="form-group">
                       <button id="btnHide" type="submit" name="register" class="btn btn-c-dark">Register</button>
                   </div>
               </form>
                
                  <?php if(isset($success) && $success == false) { ?>
                  <p class='text-center mb-4 text-danger'>Please enter a valid student number and index number.</p> 
                  <?php }else{ ?>
                   <p class='text-center mb-4 text-danger'></p><?php } ?>
              
               </div>
           </div>
       </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your UENR VOTING 2020</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
<?php include 'includes/pages/logout_modal.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
  <!-- My Scripts -->
  <script src="js/my-script/voter.js">

  </script>

</body>

</html>
