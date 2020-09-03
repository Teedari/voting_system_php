<?php



      if(isset($_GET['url']) && $_GET['url'] == 'edit_organization'){
         echo $id = $_SESSION['org_id'] = $_GET['id'];
         $row = Organization::find_organization_by_id($id);
        $data = mysqli_fetch_array($row);
        $name = $data['name'];
        $founder = $data['founder'];
        $slogan = $data['slogan'];
        $year = $data['ext_year'];

        }
?>
          

<div class="row">
           <div class="col-md-12 col-lg-6 m-auto">
               <form action="" method="post" class="form">
                   <div class="form-group">
                       <label for="">Name</label>
                       <input name="name" value="<?php echo isset($name) ? $name : ''; ?>" type="text" class="form-control">
                   </div>
                   <div class="form-group">
                       <label for="">Founder</label>
                       <input name="founder" value="<?php echo isset($founder) ? $founder : ''; ?>" type="text" class="form-control">
                   </div>
                   <div class="form-group">
                       <label for="">Year</label>
                       <input name="year" type="text" class="form-control" value="<?php echo isset($year) ? $year : ''; ?>">
                   </div>
                   <div class="form-group">
                       <label for="">Slogan</label>
                       <input name="slogan" type="text" class="form-control" value="<?php echo isset($slogan) ? $slogan : ''; ?>">
                   </div>
                   <div class="form-group">
                       <button type="submit" name="org_update" class="btn btn-info">update</button>
                   </div>
               </form>
           </div>
       </div> 