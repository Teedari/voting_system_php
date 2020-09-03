<?php include("includes/admin_header.php") ?>
<!-- Nav Bar -->
  <?php include("includes/admin_navbar.php") ?>
  

  <div id="wrapper">

    <!-- Sidebar -->
    <?php
      include("includes/admin_sidebar.php");
      if(isset($_GET['delete'])){
          $id = $_GET['delete'];
          $success = Candidate::delete_candidate($id);
        }
?>
   
<?php
    $not_image = false;
    $check = false;
if(isset($_POST['update_candidate'])){
    $target_dir = "../images/";
   $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $organization =  empty($database->escape_string($_POST['organization'])) || $database->escape_string($_POST['organization']) == 'value=' ? $_SESSION['org_id'] : $database->escape_string($_POST['organization']);
    $position = empty($database->escape_string($_POST['position'])) || $database->escape_string($_POST['position']) == 'value=' ? $_SESSION['pos'] : $database->escape_string($_POST['position']);
    $profile = empty($_FILES["fileToUpload"]["tmp_name"]) ? $_SESSION['picture'] : $target_file;
      $id = $_SESSION['candidate_id'];
      $name = $database->escape_string($_POST['name']);
      $email = $database->escape_string($_POST['email']);
      $phone = $database->escape_string($_POST['phone']);
      $level = $database->escape_string($_POST['level']);
      $std_no = $database->escape_string($_POST['stud_no']);
      $index_no = $database->escape_string($_POST['index_no']);
      $program = $database->escape_string($_POST['prog_study']);
      $match = $database->escape_string($_POST['match']);
    if(!empty($_FILES["fileToUpload"]["tmp_name"])){
      
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    }else{
      
      $updated = Candidate::update_candidate($id ,$name, $email, $phone, $level, $std_no, $index_no, $program, $organization, $position, $profile);
    if(!$updated){
         redirect('manage_candidate.php?url=edit_candidate&id='. $id);
      echo "DID not";
        }else{
            redirect('manage_candidate.php');
      }
    }
    if($check !== false) {
   // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
    } else {
     $not_image = true;
     $uploadOk = 0;
    }
      // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $err = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  
   // $match."<br>";
    
//    if(!empty($match) && $match != 'false'){
    $updated = Candidate::update_candidate($id ,$name, $email, $phone, $level, $std_no, $index_no, $program, $organization, $position, $profile);
    if(!$updated){
         redirect('manage_candidate.php?url=edit_candidate&id='. $id);
        }else{
            redirect('manage_candidate.php');
      }
    }
  }
}
    ?>
    

    <div id="content-wrapper">

      <div class="container-fluid">
       <?php 
        
            if(isset($success) && $success == true){

            success_info("Candidate deleted successfully", "candidate");

            }
        
        ?>

        <h1 class="display-4 font-weight-bold text-lg-center">View Candidates</h1>
        <hr>

        <!-- Body goes heree.... -->
          
       <?php
          $url = "";
          if($_SERVER['REQUEST_METHOD'] == 'GET'){
            
              if(isset($_GET['url'])){
                  $url = $_GET['url'];
                
              }
                  
              switch($url){
                  case 'edit_candidate':
                      include 'includes/pages/edit_candidate.php';
                      break;
                  case 'view_candidate':
                      include 'includes/tables/table_candidate.php';
                      break;
                  default:
                      include 'includes/tables/table_candidate.php';
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
<script>
   
   $(document).ready(function(){
     $('#organization').change(function(){
       let org_id = this.value;
       $('#position').load('get_position.php',{id: org_id, type: 'position_dep'});
     });
     
     
     $('#index_no').change(function(){
        let std_no = document.getElementById('stud_no').value;
        let index_no = this.value;
//       console.log(index_no, std_no);
       $.post('get_position.php',{number: std_no, index: index_no ,type: 'validate_index'},function(data, status){
       let match =  document.getElementById('match');       
           
           
         if(data == 1){
           
          match.setAttribute('checked', true);
          match.setAttribute('value', 'true');
         console.log(data);
         }else{
           match.setAttribute('checked', true);
           match.setAttribute('value', 'false');
           $('#match_info').html('Student number does\'n match with the index number');
          $('#match_info').css({color: 'red'});
           
         }
       });
     })
   });
</script>
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
