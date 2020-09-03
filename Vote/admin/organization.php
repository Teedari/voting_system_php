<?php include("includes/admin_header.php") ?>
<!-- Nav Bar -->
  <?php include("includes/admin_navbar.php") ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php
      include("includes/admin_sidebar.php");
      
    ?>
    
    <?php
    
    if(isset($_POST['org_submit'])){
    $name = $database->escape_string($_POST['name']);
    $founder = $database->escape_string($_POST['founder']);
    $slogan = $database->escape_string($_POST['slogan']);
    $year = $database->escape_string($_POST['year']);
    $success = Organization::insert_organization($name, $founder,$slogan,$year);
    }
    
    ?>

    <div id="content-wrapper">

      <div class="container-fluid">

       <?php 
        
        if(isset($success) && $success == true){
          
        success_info("Organization added successfully", "organization");
          
        }
        
        ?>
        <h1 class="display-4 font-weight-bold text-lg-center">Organization</h1>
        <hr>

        <!-- Body goes heree.... -->
       <div class="row">
           <div class="col-md-12 col-lg-6 m-auto">
               <form action="" method="post" class="form">
                   <div class="form-group">
                       <label for="">Name</label>
                       <input name="name" type="text" class="form-control">
                   </div>
                   <div class="form-group">
                       <label for="">Founder</label>
                       <input name="founder" type="text" class="form-control">
                   </div>
                   <div class="form-group">
                       <label for="">Year</label>
                       <input name="year" type="text" class="form-control">
                   </div>
                   <div class="form-group">
                       <label for="">Slogan</label>
                       <input name="slogan" type="text" class="form-control">
                   </div>
                   <div class="form-group">
                       <button type="submit" name="org_submit" class="btn btn-c-dark">Submit</button>
                   </div>
               </form>
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

</body>

</html>
