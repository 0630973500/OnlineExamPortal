<?php
  //profile.php
  include('database_connection.php');
  
  if(!isset($_SESSION['role'])){
		header("location:login.php");
	}
  $query = "SELECT * FROM users WHERE id = '".$_SESSION["user_id"]."'";
  $stmt = $connect->prepare($query);
  $stmt->execute();
  $results = $stmt->fetchAll();
  $name = '';
  $email = '';
  $user_id = '';
  foreach($results as $result){
	  $name = $result['Username'];
	  $email = $result['Email'];
  }
  include('header.php');
?>
<div class="container">
<div class="panel panel-default">
   <div class="panel-heading">Edit Profile</div>
   <div class="panel-body">
     <form action="login.php" method="post" id="edit_profile_form">
	    <span id="message"></span>
	   <div class="form-group">
	  <label for="username">Username</label>
	  <input type="text" name="uname"  class="form-control" id="uname" value="<?php echo $name; ?>" required></br>
	  </div>
	  <div class="form-group">
	  <label for="email">Email</label>
	  <input type="text" name="email" class="form-control" id="email" value="<?php echo $email; ?>" required></br>
	  </div>
	  <hr/>
	  <label>Leave password blank if you do not want to change password</label>
	  <div class="form-group">
	  <label for="new_password">New Password</label>
	  <input type="password" name="new_password" class="form-control" id="new_password"></br>
	  </div>
	  <div class="form-group">
	  <label for="password2">Re-enter Password</label>
	  <input type="password" name="password2" class="form-control" id="password2">
	  <span id="error_password"></span></br>
	  </div>
	  <div class="form-group">
	  <input type="submit" name="edit_profile" id="edit_profile"  class="btn btn-info" value="Edit">
	  </div>
	</form>
   </div>
</div>
</div>
<script>
  $(document).ready(function(){
	  $('#edit_profile_form').on('submit', function(event){
		  event.preventDefault();
		  if($('#new_password').val() != ''){
			  if($('#new_password').val() != $('#password2').val()){
				  $('#error_password').html('<label class="text-danger">Password do not match</label>');
			  }else{
				  $('#error_password').html('');
			  }
		  }
		  $('#edit_profile').attr('disabled', 'disabled');
		  var form_data = $(this).serialize();
		  $.ajax({
			  url:"edit_profile.php",
			  method:"POST",
			  data:form_data,
			  success:function(data){
				   $('#edit_profile').attr('disabled', false);
				   $('#new_password').val('');
				   $('#password2').val('');
				   $('#message').html(data);
			  }
		  })
	  });
  });
</script>