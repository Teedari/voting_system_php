<?php require_once('includes/user_header.php');?>
 
<?php include('includes/user_nav.php'); ?>
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $submitted = false;
          $org_id = $_POST['organization'];
          $pos = $_POST['position'];
        
       
      }

    ?>
       
    <?php if(!$database->get_release_result()){
    ?>
 <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 40rem;">
   <div class="circle"></div 
  <p class="text-center display-4 result">Result will be out soon</p>
  <div>
    <div class="spinner-grow text-muted"></div>
    <div class="spinner-grow text-primary"></div>
    <div class="spinner-grow text-success"></div>
    <div class="spinner-grow text-info"></div>
    <div class="spinner-grow text-warning"></div>
    <div class="spinner-grow text-danger"></div>
    <div class="spinner-grow text-secondary"></div>
    <div class="spinner-grow text-dark"></div>
    <div class="spinner-grow text-light"></div>
  </div>
 </div>

<?php } else {
    
?>
        <!-- Body goes heree.... -->
        <h1 class="display-4 font-weight-bold text-lg-center">Results <small class="text-muted">
            <?php echo $info = isset($submitted) ? Organization::get_org_placeholder_id($org_id,'name') : ''; ?>
        </small></h1>
        <hr>
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
     Result::ds_candidate_by_id_pos_user($org_id, $pos);
  echo '</div>';
    }else{?>
   
   <h2 class="display-4 text-center">No record selected</h2>
   <?php } ?>
   
   </div>
     
     <?php } ?>
      <!-- Bootstrap core JavaScript-->
  <script src="admin/vendor/jquery/jquery.min.js"></script>
     <script>
    $(document).ready(function(){
           $('#organization').change(function(){
       let org_id = this.value;
       $('#position').load('admin/get_position.php',{id: org_id, type: 'position_dep'});
     });
     
    });
  </script>
</body>
</html>