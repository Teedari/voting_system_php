<?php include("includes/admin_header.php") ?>
<!-- Nav Bar -->
  <?php include("includes/admin_navbar.php") ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php
      include("includes/admin_sidebar.php");
      
    ?>
    
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $submitted = false;
          $org_id = $_POST['organization'];
          $pos = $_POST['position'];
        
       
      }
    ?>

    <div id="content-wrapper">

      <div class="container-fluid">

       <?php 
        
        if(isset($success) && $success == true){
          
        success_info("Organization added successfully", "organization");
          
        }
        
        ?>
        <h1 class="display-4 font-weight-bold text-lg-center">Results <small class="text-muted">
            <?php echo $info = isset($submitted) ? Organization::get_org_placeholder_id($org_id,'name') : ''; ?>
        </small></h1>
        <hr>

        <!-- Body goes heree.... -->
<div class="row">
    <div class="col-lg-6 col-md-12 ml-auto">
      <form class="form-inline my-4" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div class="form-group mx-sm-3">
            <select name="organization" id="organization" class="form-control" required>
                <option value="">Select organization</option>
         <?php
         Organization::select_orginazation_element();
         ?>
            </select>
        </div>
        <div class="form-group mx-sm-3">
            <select id="position" name="position"  class="form-control" required>
                <option value="">Select position</option>
            </select>
        </div>
      
          <button type="submit" class="btn btn-info ">Display Result</button>
        
      </form>
     </div>
</div>
   <div class="container">
       
        <?php if(isset($submitted)){
  echo '<div class="d-flex justify-content-between flex-wrap">';
     Result::ds_candidate_by_id_pos($org_id, $pos);
  echo '</div>';
    }else{?>
   
   <h2 class="display-4 text-center">No record selected</h2>
   <?php } ?>
   
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
  
  <script>
    $(document).ready(function(){
           $('#organization').change(function(){
       let org_id = this.value;
       $('#position').load('get_position.php',{id: org_id, type: 'position_dep'});
     });
     
    });
  </script>

</body>

</html>
