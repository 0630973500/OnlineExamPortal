<?php
    include('connection.php');
	if(isset($_SESSION['role'])){
		header("location:index.php");
	}
	$message = "";
	if(isset($_POST['login'])){
		$query = "SELECT * FROM users WHERE Email = :email";
		$stmt = $connect->prepare($query);
		$stmt->execute(
		      array('email' => $_POST['uname'])
		);
		$count = $stmt->rowCount();
		if($count > 0){
			$results = $stmt->fetchAll();
			foreach($results as $result){
				if($result['Password'] == $_POST['password']){
					$_SESSION['role'] = $result["Role"];
					$_SESSION['username'] = $result["Username"];
					$_SESSION['user_id'] = $result["id"];
					header("location: index.php");
				}else{
					$message = "<label>Wrong Password</label>";
				}
			}
		}else{
			$message = "<label>Wrong email address</label>";
		}
		
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	  <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Login</title>
      <link rel="stylesheet" href="indestyle.css">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
      <script src="jquery-3.5.1.min.js"></script>
      <script src="bootstrap.min.js"></script>
  </head>
  <body>
    
	<div class="container">
	   <h2 align="center">
		 ONLINE EXAM PORTAL
	   </h2>
	   <div class="panel-default">
		     <div class="panel-heading">
		      <h2>
			    LOGIN
			  </h2>
			 </div>
			 <div>
			 
			 </div>
	   <div class="panel-body">
	       <form action="login.php" method="post">
		    <?php echo $message; ?>
		   <div class="form-group">
			  <label for="c_id">Enter Email</label>
			  <input type="text" name="uname"  class="form-control"></br>
			  </div>
			  <div class="form-group">
			  <label for="c_name">Enter Password</label>
			  <input type="password" name="password" class="form-control" ></br>
			  </div>
			  <div class="form-group">
			  <input type="submit" name="login" class="btn btn-primary" value="LOGIN">
			  </div>
			  <p>
			    Not yet a member? <a href="register.php">Register</a>
			  </p>
		   </form>
		   </div>
	   </div>
	</div>
  </body>
