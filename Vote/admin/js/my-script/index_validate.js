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
           
           console.log(data);
           
           
           
           
           
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