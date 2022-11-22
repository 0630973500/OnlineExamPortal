<?php
    //index
	include('connection.php');
	include('schedule_server.php');
	if(!isset($_SESSION['role'])){
		header("location:login.php");
	}
	include('header.php');
	$mysqli = NEW MYSQLI('localhost', 'root', '', 'm39537862');
	
	$result = $mysqli->query("SELECT * FROM students");
?>
<div class="container">
    <div class="panel-default">
	   <div class="panel-heading">
	       <h2>Schedule Exam</h2>
	   </div>
	   
	   <div class="panel-body">
	   <a href="" download></a>
	       <form action="schedule_exam.php" method="post">
		   <div class="form-group">
	            <label for="exam_date">Exam Date</label></br>
		        <input type="date" class="form-control" name="exam_date">
	          </div>
			  <div class="form-group">
	            <label for="start_time">Start Time</label></br>
		        <input type="time" class="form-control" name="start_time">
	          </div>
			  <div class="form-group">
	            <label for="complete_time">Complete Time</label></br>
		        <input type="time" class="form-control" name="complete_time">
	          </div>
			  <div class="form-group">
			  <select class="form-control" name="student" id="reference">
			     <option value="">Select Student</option>
				 <?php
					   while($row = $result->fetch_assoc()){
						  $student_name = $row['StudentName'];
						  $student_number = $row['StudentNumber'];
						  echo "<option value='$student_number'>$student_name</option>";
					  }
				?>
				 </select>
				 </div>
		   <div class="form-group">
			    <label for="module_code">Module Code</label></br>
		        <input type="text" class="form-control" name="module_code">
			</div>
			  </br>
			  <div class="form-group">
			  <input type="submit" name="submit" class="btn btn-primary" value="SUBMIT">
			  </div>
		   </form>
	   </div>
	</div>
</div>