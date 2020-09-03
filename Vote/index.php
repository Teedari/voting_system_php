<?php require_once('includes/user_header.php');?>
 
<?php include('includes/user_nav.php'); ?>
    <?php 

if($_SESSION['activate'] <1 && $session->is_signed_in()){redirect('./verification.php');}

?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $submitted = false;
  $org_id = $_POST['organization'];
  $pos = $_POST['position'];
}
?>
 
 <?php

if(isset($_GET['vote'])){
  $alert = '';
  $user_id=$_SESSION['user_id'];
  $voter_name = $_GET['name'];
  $position = $_GET['pos'];
  $org_id = $_GET['org_id'];
   $res = Candidate::vote($user_id, $voter_name, $org_id, $position, 1);
  if($res){
    $success = true;
    $alert ='<div class="alert alert-info mt-4" role="alert">You voted for
  '.$voter_name.' as '.$position.'
</div>';
  }else{
    $alert ='<div class="alert alert-danger mt-4" role="alert">
  Please you\'ve already voted for this section. <a href="index.php" class="alert-link">Kindly select another section</a>.
</div>';
  }

}

?>
  <div class="d-flex justify-content-center">
     <?php if(isset($alert) ){
  echo $alert;
}
    ?>
  </div>
  <div class="row">
    <div class="col-lg-6 col-md-12 ml-auto">
      <form class="form-inline my-4" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div class="form-group mx-sm-3">
            <select name="organization" id="organization" class="form-control">
                <option value="">Select organization</option>
         <?php
         Organization::select_orginazation_element();
         ?>
            </select>
        </div>
        <div class="form-group mx-sm-3">
            <select id="position" name="position"  class="form-control">
                <option value="">Select position</option>
            </select>
        </div>
      
          <button type="submit" class="btn btn-primary ">Display Candidates</button>
        
      </form>
    </div>
    </div>
  <div class="text-center my-4">
    <h2 class="display-4">Make Your Vote Count.!</h2>
  </div>
     <?php 
      if(isset($submitted)){
   echo ' <div class="container">
      <div class="d-flex justify-content-between flex-wrap">';

        Candidate::display_voters_card($_SESSION['user_id'], $org_id, $pos);}  else{?>
        <h1 class="display-5 text-center">No record found</h1>
     <?php }
      ?>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
  <script src="admin/vendor/jquery/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
     $('#organization').change(function(){
       let org_id = this.value;
        $('#position').load('admin/get_position.php',{id: org_id, type: 'position_dep'});
     });
   $vote_btn = document.querySelectorAll('#vote_btn');
    
    
    setTimeout(function(){
    let btn_id = $('.id_user').val();
    let org = $('#organization').val();
    let pos = $('#position').val();

    console.log( btn_id);
    console.log( org);
    console.log( pos);
          $.post('vote_sync.php',{
            uid: btn_id, 
            org_id: org ,
            pos: pos
          },function(data, status){
       let match =  document.getElementById('match');
         if(data == '\r\ntrue'){
           console.log(data);
         }else{

           console.log(data);
         }
       });
    }, 5000);

  });
</script>
  <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>