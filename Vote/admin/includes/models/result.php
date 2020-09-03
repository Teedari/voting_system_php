<?php
class result{
    public static function ds_candidate_by_id_pos($org_id, $pos){
//        echo $org_id." => ". $pos ."<br>";
        global $database;
        $sql = "SELECT name, level, std_index_no, program, organization_id, position, profile_picture FROM candidate_tbl";
        $sql .= " WHERE organization_id = {$org_id} AND position = '{$pos}'";
        $res = $database->query_from_db($sql);
        if(!empty($res)){
            while($row = mysqli_fetch_array($res)){
              $name = $row['name'];
                $count = self::count_result($name, $org_id, $pos);
                self::display_result_card($row, $count);
            }
        }else{
            echo '<h2 class="display-4 text-center">No Data Found!!</h2>';
        }
    }
    
     public static function ds_candidate_by_id_pos_user($org_id, $pos){
//        echo $org_id." => ". $pos ."<br>";
        global $database;
        $sql = "SELECT name, level, std_index_no, program, organization_id, position, profile_picture FROM candidate_tbl";
        $sql .= " WHERE organization_id = {$org_id} AND position = '{$pos}'";
        $res = $database->query_from_db($sql);
        if(!empty($res)){
            while($row = mysqli_fetch_array($res)){
              $name = $row['name'];
                $count = self::count_result($name, $org_id, $pos);
                self::display_result_card_user($row, $count);
            }
        }else{
            echo '<h2 class="display-4 text-center">No Data Found!!</h2>';
        }
    }
    
    //Get number of votes for a particular candidate
    public static function count_result($name, $org_id, $pos){
        global $database;
        $sql = "SELECT * FROM vote_tbl ";
        $sql .= "WHERE candidate = '{$name}' AND organization_id = {$org_id} AND position = '{$pos}'";
        $res = $database->query_from_db($sql);
        
        $count = mysqli_num_rows($res);
        
        return $count;
    }
    
    public static function get_highest_candidate($org_id, $pos){
        $scores = array();
        $candidates = Candidate::find_all_candidate_by_org_id_pos($org_id, $pos);
        global $database;
        while($row = mysqli_fetch_array($candidates)){
           $name = $row['name'];
            $org_id = $row['organization_id'];
            $pos = $row['position'];
            $scores[] =  self::count_result($name, $org_id, $pos);
        }
        return $scores;
    }
    
    
    
    
    
    
    public static function display_result_card($data, $count){
        $count;
        $name = $data['name'];
        $level = $data['level'];
        $pos = $data['position'];
        $program = $data['program'];
        $index = $data['std_index_no'];
        $org_id = $data['organization_id'];
        $arr = self::get_highest_candidate($org_id, $pos);
        $highest = self::get_highest_vote($arr);
        $is_highest = $highest == $count ? true : false;
        $profile = $data['profile_picture'];
        self::card_show($name, $index, $count, $level, $program, $pos,$profile, $is_highest);
          
    }
    
    
    private static function card_show($name, $index, $count, $level, $program, $pos,$profile, $is_highest){
    $bg_color = $is_highest ? 'bg-dark' : '';   
    $text_color = $is_highest ? 'text-white' : '';   
    $card = '<div class="card text-center '.$bg_color.' mb-4" style="width: 18rem;">
              <div class="card-body shadow">
              <img style="height: 15rem; width: 15rem; object-fit: cover; border-radius: 50%;" class="card-img-top" src="../images/'.$profile.'" alt="Card image cap">
              <div class="card-block">
              ';
    $card .= $is_highest ? '<h5 class="card-title text-warning text-center h2">Winner</h5>' : '<div class="mb-4"></div>';
    $card .= '<h5 class="card-title text-info">'.$pos.'</h5>
                <p class="card-text '.$text_color.' ">I\'m '.$name.', a level '.$level.' student. <small class="text-muted text-primary ">Pursing '.$program.'</small></p>
               <p>
               <small class=" text-primary mb-4">'.$index.'</small>
               </p>
               <p><input hidden class="id_user" checked type="checkbox" value=""></p>
                ';
        
    $card .= '<h2 class="display-4 mt-2">'.$count.'</h2></div></div></div>';
            echo $card;
    }
    
    public static function display_result_card_user($data, $count){
    $count;
    $name = $data['name'];
    $level = $data['level'];
    $pos = $data['position'];
    $program = $data['program'];
    $index = $data['std_index_no'];
    $org_id = $data['organization_id'];
    $arr = self::get_highest_candidate($org_id, $pos);
    $highest = self::get_highest_vote($arr);
    $is_highest = $highest == $count ? true : false;
    $profile = $data['profile_picture'];
    self::card_show_user($name, $index, $count, $level, $program, $pos,$profile, $is_highest);

}
    private static function card_show_user($name, $index, $count, $level, $program, $pos,$profile, $is_highest){
    $bg_color = $is_highest ? 'bg-dark' : '';   
    $text_color = $is_highest ? 'text-white' : '';   
    $card = '<div class="card text-center '.$bg_color.' mb-4" style="width: 18rem;">
              <div class="card-body shadow">
              <img style="height: 15rem; width: 15rem; object-fit: cover; border-radius: 50%;" class="card-img-top" src="./images/'.$profile.'" alt="Card image cap">
              <div class="card-block">
              ';
    $card .= $is_highest ? '<h5 class="card-title text-warning text-center h2">Winner</h5>' : '';
    $card .= '<h5 class="card-title text-info">'.$pos.'</h5>
                <p class="card-text '.$text_color.' ">I\'m '.$name.', a level '.$level.' student. <small class="text-muted text-primary ">Pursing '.$program.'</small></p>
               <p>
               <small class=" text-primary mb-4">'.$index.'</small>
               </p>
               <p><input hidden class="id_user" checked type="checkbox" value=""></p>
                ';
        
    $card .= '<h2 class="display-4 mt-2">'.$count.'</h2></div></div></div>';
            echo $card;
    }
    public static function get_highest_vote($arr){
        $new_arr = array();
        $new_arr = $arr;
//        $arr = sort($arr);
        rsort($new_arr);
//        $n = count($new_arr);

        return $new_arr[0];
    }
}



?>