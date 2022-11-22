<?php
     include('user_server.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	  <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Register</title>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="indestyle.css">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
	<div class="container">
	   <div class="panel-default">
		     <div class="panel-heading">
		      <h2>
			    CREATE ACCOUNT
			  </h2>
			 </div>
			 <div>
			 
			 </div>
	   <div class="panel-body">
	       <form action="register.php" method="post">
		   <div class="form-group">
			  <label for="c_id">Enter Username</label>
			  <input type="text" name="username"  class="form-control"></br>
			  </div>
			   <div class="form-group">
			  <label for="c_id">Enter Email Address</label>
			  <input type="text" name="email"  class="form-control"></br>
			  </div>
			   <div class="form-group">
			  <select class="form-control" name="role" id="reference" value="<?php echo $reference;?>">
			     <option value="">Choose Role</option>
				 <option value="Admin">Admin</option>
				 <option value="Student">Student</option>
				 <option value="Lecture">Lecture</option>
				 </select>
			  </br>
			  <div class="form-group">
			  <label for="c_name">Enter Password</label>
			  <input type="password" name="pwd" class="form-control" ></br>
			  </div>
			  <div class="form-group">
			  <label for="c_name">Confirm Password</label>
			  <input type="password" name="pwd2" class="form-control" ></br>
			  </div>
			  </div>
			  <div class="form-group">
			  <input type="submit" name="submit" class="btn btn-primary" value="CREATE ACCOUNT">
			  </div>
			  <p>
			    Already a member? <a href="login.php">Login</a>
			  </p>
		   </form>
		   </div>
	   </div>
	</div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
