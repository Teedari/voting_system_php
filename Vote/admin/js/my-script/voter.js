$('document').ready(function(){
  
$('#email').change(function(e){
const name = $('#email').val();
  
 $.post('get_position.php',{name: name, type: 'email_check_exist'}, function(data, status){
   const value = data;
   if(value == 1){
     $('#btnHide').hide();
     $('#email_alert').html('This email already exist');
     console.log(value);
   }else{
     
   $('#btnHide').show();
   $('#email_alert').html('');
   }
 });
//  <p id="email_alert" class="text-danger text-mute">This email already exist</p>
});

});

  