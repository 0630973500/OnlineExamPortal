<?php
    //index
	include('connection.php');
	include('register_server.php');
	if(!isset($_SESSION['role'])){
		header("location:login.php");
	}
	include('header.php');
	$mysqli = NEW MYSQLI('localhost', 'root', '', 'm39537862');
	
	$result = $mysqli->query("SELECT * FROM exam");
?>
<div class="container">
    <div class="panel-default">
	   <div class="panel-heading">
	       <h2>Student Register</h2>
	   </div>
	   
	   <div class="panel-body">
	   <a href="" download></a>
	       <form method="post" action="student_register.php">
		      <div class="form-group">
			  <label for="student_number">Student Number</label>
			  <input type="number" name="student_number" class="form-control" id="student_number"></br>
			  </div>
			  <div class="form-group">
			  <label for="student_name">Student Name</label>
			  <input type="text" name="student_name" class="form-control"></br>
			  </div>
			  <div class="form-group">
			  <label for="student_surname">Student Surname</label>
			  <input type="text" name="student_surname" class="form-control"></br>
			  </div>
			  <div class="form-group">
			  <label for="email">Email(mylife email)</label>
			  <input type="text" name="email" class="form-control"></br>
			  </div>
			  <div class="form-group">
			  <div class="form-group">
			  <select class="form-control" name="module" id="reference">
			     <option value="">Select Module</option>
				 <?php
					   while($row = $result->fetch_assoc()){
						  $module = $row['ModuleCode'];
						  $examId = $row['ExamId'];
						  echo "<option value='$examId'>$module</option>";
					  }
				?>
				 </select>
				 </div>
			  </div>
			  <div class="form-group">
			  <input type="submit" name="submit" class="btn btn-primary" value="SUBMIT">
			  </div>
		   </form>
	   </div>
	</div>
</div>