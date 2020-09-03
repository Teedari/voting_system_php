<?php include("includes/admin_header.php") ?>
<!-- Nav Bar -->
  <?php include("includes/admin_navbar.php") ?>
  
  <?php
    $not_image = false;
    $check = false;
  if(isset($_POST['addCandi'])){
    
    $target_dir = "../images/";
    $image_title = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $image_title;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(!empty($_FILES["fileToUpload"]["tmp_name"])){
      
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    $name = $database->escape_string($_POST['name']);
    $email = $database->escape_string($_POST['email']);
    $phone = $database->escape_string($_POST['phone']);
    $level = $database->escape_string($_POST['level']);
    $std_no = $database->escape_string($_POST['stud_no']);
    $index_no = $database->escape_string($_POST['index_no']);
    $program = $database->escape_string($_POST['prog_study']);
    $match = $database->escape_string($_POST['match']);
    
    if(!empty($match) && $match != 'false'){
    $organization = $database->escape_string($_POST['organization']);
    $position = $database->escape_string($_POST['position']);
    $success = Candidate::insert_candidate($name, $email, $phone, $level, $std_no, $index_no, $program, $organization, $position, $image_title);
    redirect($_SERVER['PHP_SELF']);
    }
  } else {
    $err = "Sorry, there was an error uploading your file.";
  }
}
      
      
  }

  
  ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php
      include("includes/admin_sidebar.php");
//    echo $database->validate_index_no(10000001);
    ?>

    <div id="content-wrapper">

      <div class="container-fluid">

       <?php 
        
        if(isset($success) && $success == true){
          
        success_info("Candidate added successfully", "candidate table");
          
        }
        
        ?>
        <h1 class="display-4 font-weight-bold text-lg-center">Register Candidate</h1>
        <hr>

        <!-- Body goes heree.... -->
        <div class="row">
          <div class="col-md-12">
           <form action="" method="post" enctype="multipart/form-data" class="form px-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input name="name" value="<?php echo isset($name) ? $name : ''; ?>" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input name="email" value="<?php echo isset($email) ? $email : ''; ?>" type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="">Phone</label>
                                    <input name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" type="number" class="form-control">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Upload Profile Picture</label>
                                        <input type="file" name="fileToUpload" id="file" class="form-control-file"/>
                                       <?php echo $not_image == true ? '<small id="fileHelp" class="text-danger">'.$err.'</small>' : ''; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                           <label for="">Level</label>
                            <select name="level" id="" class="form-control">
                                <option value="">Select level</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Student number</label>
                            <input id="stud_no" name="stud_no" value="<?php echo isset($std_no) ? $std_no : ''; ?>" type="text" class="form-control">
                        </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Index number</label>
                            <input id="index_no" name="index_no" value="<?php echo isset($index_no) ? $index_no : ''; ?>" type="text" class="form-control">
                            <p id="match_info" class=""></p>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                           <label for="">Program of study</label>
                            <select name="prog_study" id="" class="form-control">
                                <option value="">Select Program of  Study</option>
                                 <option value="BSC. ELECTRICAL AND ELECTRONIC ENGINEERING">BSC. ELECTRICAL AND ELECTRONIC ENGINEERING</option>
                                 <option value="BSC. COMPUTER ENGINEERING">BSC. COMPUTER ENGINEERING</option>
                                 <option value="BSC. MECHANICAL ENGINEERING">BSC. MECHANICAL ENGINEERING</option>
                                 <option value="BSC. AGRICULTURAL ENGINEERING">BSC. AGRICULTURAL ENGINEERING</option>
                                 <option value="BSC. ENVIRONMENTAL ENGINEERING">BSC. ENVIRONMENTAL ENGINEERING</option>
                                 <option value="BSC. RENEWABLE ENERGY ENGINEERING">BSC. RENEWABLE ENERGY ENGINEERING</option>
                                 <option value="BSC. PETROLEUM ENGINEERING">BSC. PETROLEUM ENGINEERING</option>
                                 <option value="BSC. CIVIL ENGINEERING">BSC. CIVIL ENGINEERING</option>
                                 <option value="BSC BIOLOGICAL SCIENCE">BSC BIOLOGICAL SCIENCE</option>
                                 <option value="BSC NURSING">BSC NURSING</option>
                                 <option value="BSC. CHEMISTRY">BSC. CHEMISTRY</option>
                                 <option value="BSC. COMPUTER SCIENCE">BSC. COMPUTER SCIENCE</option>
                                 <option value="BSC. INFORMATION TECHNOLOGY">BSC. INFORMATION TECHNOLOGY</option>
                                 <option value="BSC. MATHEMATICS">BSC. MATHEMATICS</option>
                                 <option value="BSC. STATISTICS">BSC. STATISTICS</option>
                                 <option value="BSC. ACTUARIAL SCIENCE">BSC. ACTUARIAL SCIENCE</option>
                            </select>
                        </div>
                        <div class="form-group">
                           <label for="">Organization</label>
                            <select name="organization" id="organization" class="form-control">
                                <option value="">Select organization</option>
                         <?php
                         Organization::select_orginazation_element();
                         ?>
                            </select>
                        </div>
                        <div class="form-group">
                           <label for="">Position</label>
                            <select id="position" name="position"  class="form-control">
                                <option value="">Select position</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input hidden type="checkbox" checked id="match" value=""  name="match">
                        </div>
                    </div>
                </div>

                <div class="form-group d-flex">
                   <button type="submit" name="addCandi" id="button" class="btn btn-c-dark px-4">Submit</button>
                 
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
  <script>
   
   $(document).ready(function(){
     $('#organization').change(function(){
       let org_id = this.value;
       $('#position').load('get_position.php',{id: org_id, type: 'position_dep'});
     });
     
     
     $('#index_no').change(function(){
        let std_no = document.getElementById('stud_no').value;
        let index_no = this.value;
       console.log(index_no, std_no);
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
