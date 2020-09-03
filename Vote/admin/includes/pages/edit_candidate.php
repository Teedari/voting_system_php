<?php



      if(isset($_GET['url']) && $_GET['url'] == 'edit_candidate'){
        $id = $_SESSION['candidate_id'] = $_GET['id'];
        $row = Candidate::find_candidate_by_id($id);
        $data = mysqli_fetch_array($row);
        $name = $data['name'];
        $email = $data['email'];
        $profile = $_SESSION['picture'] = $data['profile_picture'];
        $phone = $data['phone'];
        $level = $data['level'];
        $std_num = $data['std_no'];
        $index_num = $data['std_index_no'];
        $program = $data['program'];
        $org_id = $_SESSION['org_id'] = $data['organization_id'];
        $pos = $_SESSION['pos'] = $data['position'];
        }
?>
         

        <div class="row">
          <div class="col-md-12">
           <form action="" method="post" enctype="multipart/form-data" class="form px-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input name="name" type="text" class="form-control" value="<?php echo $name = isset($name) ? $name : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input name="email" type="email" class="form-control" value="<?php echo $email = isset($email) ? $email : ''; ?>">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="">Phone</label>
                                    <input name="phone" value="<?php echo $phone = isset($phone) ? $phone : ''; ?>" type="number" class="form-control">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Upload Profile Picture</label>
                                        <input type="file" name="fileToUpload" value="<?php echo $profile = isset($profile) ? $profile : ''; ?>" id="file" class="form-control-file"/>
                                       <?php echo $not_image == true ? '<small id="fileHelp" class="text-danger">'.$err.'</small>' : ''; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                           <label for="">Level</label>
                            <select name="level" id="" required class="form-control">
                                <option value="<?php echo $level = isset($level) ? $level : ''; ?>">Select level</option>
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
                            <input id="stud_no" name="stud_no" type="text" class="form-control" value="<?php echo $std_num = isset($std_num) ? $std_num : ''; ?>">
                        </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Index number</label>
                            <input id="index_no" name="index_no" type="text" class="form-control" value="<?php echo $index_num = isset($index_num) ? $index_num : ''; ?>">
                            <p id="match_info" class=""></p>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                           <label for="">Program of study</label>
                            <select name="prog_study" id="" required class="form-control" >
                                <option value="<?php echo $program = isset($program) ? $program : ''; ?>">Select Program of  Study</option>
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
                            <select name="organization" id="organization" required class="form-control">
                                <option value="value="">Select organization</option>
                         <?php
                         Organization::select_orginazation_element();
                         ?>
                            </select>
                        </div>
                        <div class="form-group">
                           <label for="">Position</label>
                            <select id="position" required name="position"  class="form-control">
                                <option value="value="">Select position</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input hidden type="checkbox" checked id="match" value=""  name="match">
                        </div>
                    </div>
                </div>

                <div class="form-group d-flex">
                   <button type="submit" name="update_candidate" id="button" class="btn btn-info px-4">Update</button>
                 
               </div>
           </form>
        </div>
      </div>