<?php
    //index
	include('connection.php');
	include('server.php');
	if(!isset($_SESSION['role'])){
		header("location:login.php");
	}
	
	include('header.php');
	$mysqli = NEW MYSQLI('localhost', 'root', '', 'm39537862');
	
	$result = $mysqli->query("SELECT students.StudentNumber, exam.ModuleCode, exam.ExamId FROM students INNER JOIN exam  ON students.StudentNumber = exam.StudentNumber AND exam.StudentNumber =".$_SESSION['username']);
?>
<div class="container">
    <div class="panel-default">
	   <div class="panel-heading">
	       <h2>Students</h2>
	   </div>
	   
	   <div class="panel-body">
	   <a href="" download></a>
	       <form action="student_exam.php" method="post">
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
			  </br>
			  <div class="form-group">
			  <input type="submit" name="submit" class="btn btn-primary" value="SUBMIT">
			  </div>
		   </form>
	   </div>
	</div>
</div>