<?php require_once('includes/user_header.php');?>
 
<?php include('includes/user_nav.php'); ?>
<?php
if(isset($_GET['email_sent'])){

  $sent = false;
  
      $code = Voter::genKeyCode();
     Voter::save_gen_code($_SESSION['username'], $code);
    $sent = send_mail($_SESSION['email'], $code);
  
}


if(isset($_POST['verify_btn'])){
    $input_code = $_POST['input_key'];
    $success = Voter::retrieve_key($_SESSION['username'],$input_code);
    if($success){
        $save = Voter::email_activate($_SESSION['username']);
        if($save){
        $_SESSION['activate'] = 1;
        redirect('index.php');
        }
    }
}


?>
  <div class="text-center my-4">
    <h2 class="display-4">We need to make sure it is you</h2>
    <p class="text-muted">To protect your account we will verify your identity
      by sending you a temporary identification code.
      When you receive the code, enter it in text field below.
    </p>
  </div>
  <div class="my-4 shadow col-md-6 col-lg-4 offset-4 p-4">
    <div class="text-center p-4">
      <h2 class="h">Check your email</h2>
     <i class="fa fa-envelope-square fa-4x"></i>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <label for="">Authentication code</label>
        <input type="text" id="input_code" name="input_key" required class="form-control">
        <input type="checkbox" id="code" name="gen_key" hidden checked />
      </div>
      <div class="form-group d-flex">
        <?php echo isset($success) && $success == false ? '<button  id="resendBtn" data-target="#resendCodeModal" data-toggle="modal" class="btn btn-secondary px-4  ">Resend Code</button>' : ''; ?>
        <button id="verifyBtn" name="verify_btn" type="submit" class="btn btn-info px-4 ml-auto">Verify</button>
      </div>
    </form>
    <?php echo isset($success) && $success == false ? '<p class="text-danger font-w-6 text-center">Invalid verification code. Try again</p>' : ''; ?>
    <?php echo isset($sent) && $sent == true ? '<p class="text-success font-w-6 text-center">Kindly check your email address - '.$_SESSION['email'].'. Verification code sent. </p>' : ''; ?>
  </div>

  
 
      <!-- Bootstrap core JavaScript-->
  <script src="admin/vendor/jquery/jquery.min.js"></script>
  <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script>


      
    $(document).ready(function(){
        
    let stopTime = 1000;
    let timeTaken = 10;
    let genCode = 0; 

  
    const code = () => {
      let i = 0;
      let sum_time_total = 10;
      const resend_btn = document.getElementById("resendBtn");
    
    //Generate Codes
      const randCode = Math.floor(Math.random(0, 10) * 100000);
      genCode = randCode;
      console.log(randCode);
        
      const timer = setInterval(function(){
        console.log(timeTaken);
        resend_btn.innerText = timeTaken;
        resend_btn.setAttribute('disabled', true);
        if(timeTaken == 0){
          sum_time_total = sum_time_total + 20;
          timeTaken = sum_time_total;
          console.log(timeTaken);
          clearInterval(timer);
          resend_btn.innerText = 'Resend Code';
          resend_btn.removeAttribute('disabled', false);
        }
    
        timeTaken--;

      },stopTime);
      return save_code_gen;

    }
    
    const save_code_gen = () => {
        const save_code = document.getElementById('code');
         save_code.value = genCode;
        console.log(save_code.value);
      
    }
//      $.post('admin/send_mail.php',{send_mail: true,code: save_code},function(data, status){
//        console.info(data);
//      });
    
    
    $('#resendBtn').click(function(e){
        
      e.preventDefault();
      code()();
    $.post('includes/verify_email.php', {code: genCode},function(data, status){
        console.info(data);
    });
        
    }); 
      
        
    });
      

  </script>
</body>
</html>