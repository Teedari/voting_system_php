<?php include("includes/admin_header.php") ?>
<!-- Nav Bar -->
  <?php include("includes/admin_navbar.php") ?>

  <div id="wrapper">
    
    <?php
        if(isset($_POST['org_update'])){
   echo $name = $database->escape_string($_POST['name']);
   echo $founder = $database->escape_string($_POST['founder']);
   echo $slogan = $database->escape_string($_POST['slogan']);
   echo $year = $database->escape_string($_POST['year']);
        $id = $_SESSION['org_id'];
    $updated = Organization::update_organization($id, $name, $founder,$slogan,$year);
    if($update){
        redirect("manage_organization.php?url=edit_organization&id=".$id);
    }else
    {
        redirect($_SERVER['PHP_SELF']);
        }
    }
    
    
    ?>

    <!-- Sidebar -->
    <?php
      include("includes/admin_sidebar.php");
      if(isset($_GET['delete'])){
          $id = $_GET['delete'];
          $success = Organization::delete_organization($id);
      }
    ?>
    

    <div id="content-wrapper">

      <div class="container-fluid">
       <?php 
        
            if(isset($success) && $success == true){

            success_info("Organization deleted successfully", "organization");

            }
        
        ?>

        <h1 class="display-4 font-weight-bold text-lg-center">View Organization</h1>
        <hr>

        <!-- Body goes heree.... -->
       <?php
          $url = "";
          if($_SERVER['REQUEST_METHOD'] == 'GET'){
            
              if(isset($_GET['url'])){
                  $url = $_GET['url'];
                
              }
                  
              switch($url){
                  case 'edit_organization':
                      include 'includes/pages/edit_organization.php';
                      break;
                  case 'view_candidate':
                      include 'includes/tables/table_organization.php';
                      break;
                  default:
                      include 'includes/tables/table_organization.php';
                      break;
              }
              
      
        
        
          
          
        
          }
          
          
          
        ?>
        

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
