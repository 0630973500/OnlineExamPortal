<?php
   include('connection.php');
   include('server.php');
   if(!isset($_SESSION['role'])){
		header("location:login.php");
	}
	include('header.php');
   $files_statement = $connect->prepare("SELECT COUNT(u.Document) AS 'Number Of Files', COUNT(e.ExamId) AS
   'Number Of Students' FROM upload u JOIN exam e USING(ExamId)
   WHERE MONTH(e.ExamDate) <= 2 AND YEAR(e.ExamDate) = 2021
   ORDER BY e.ExamDate");
   $files_statement->execute();
   $files_results = $files_statement->fetchAll();
   $files_Rows = $files_statement->rowCount();
   
   //birthdays
   $sub_statement = $connect->prepare("SELECT e.ModuleCode, COUNT(u.StudentNumber) AS 'Number Of Students'
   FROM exam e JOIN upload u USING(ExamId)
   WHERE YEAR(ExamDate) = 2021
   ORDER BY ModuleCode");
   $sub_statement->execute();
   $sub_results = $sub_statement->fetchAll();
   $sub_Rows = $sub_statement->rowCount();
   
   //Day-to-day report - Minimum stock levels
   $trend_statement = $connect->prepare("SELECT Modulecode AS 'MODULE CODE', ExamDate AS 'EXAM DATE', WEEK(ExamDate)
   AS 'WEEK NUMBER' FROM `exam` WHERE ExamDate < DATE_SUB(NOW(), INTERVAL 5
   WEEK) AND YEAR(ExamDate) = 2021 GROUP BY WEEK(ExamDate) ORDER BY
   WEEK(ExamDate)");
   $trend_statement->execute();
   $trend_results = $trend_statement->fetchAll();
   $trend_Rows = $trend_statement->rowCount();
   
   //Mis reports
   $prediction_statement = $connect->prepare("SELECT DISTINCT ex.StudentNumber AS 'STUDENTS', ex.ModuleCode, (SELECT
   COUNT(u.StudentNumber) upload WHERE u.ExamId = ex.ExamId)'SUMBISSION TIMES'
   FROM exam ex JOIN upload u USING(ExamId)");
   $prediction_statement->execute();
   $prediction_results = $prediction_statement->fetchAll();
   $prediction_Rows = $prediction_statement->rowCount();
   
?>
<body>
      <div class="overlay"><div class="loader"></div></div>
	<div class="container">
    <div class="panel panel-default">
	    <div class="panel panel-default">
	    <div class="panel panel-heading">
		<h3>SUMMARY REPORT</h3>
		</div>
		<div class="panel-body">
		   <div class="col-sm-12 table-responsive">
		       <table id="data-table" class="table table-bordered table-striped">
	       <thead>
		     <tr>
			 <th>Number Of Files</th>
			 <th>Number Of Students</th>
			 </tr>
		   </thead>
		   <?php
		      if($files_Rows > 0){
				  foreach($files_results as $files_result){
					  echo '
					     <tr>
						    <td>'.$files_result["Number Of Files"].'</td>
							<td>'.$files_result["Number Of Students"].'</td>
						 </tr>
					  ';
				  }
			  }
		   ?>
	   </table>
		   </div>
	     </div>
	  </div>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel panel-default">
	    <div class="panel panel-heading">
		<h3>SUMMARY REPORT</h3>
		</div>
		<div class="panel-body">
		   <div class="col-sm-12 table-responsive">
		     <table id="data-table" class="table table-bordered table-striped">
	       <thead>
		     <tr>
			 <th>Module Code</th>
			 <th>Number Of Students</th>
			 </tr>
		   </thead>
		   <?php
		      if($sub_Rows > 0){
				  foreach($sub_results as $sub_result){
					  echo '
					     <tr>
						    <td>'.$sub_result["ModuleCode"].'</td>
							<td>'.$sub_result["Number Of Students"].'</td>	
						 </tr>
					  ';
				  }
			  }
		   ?>
	   </table>
		   </div>
	     </div>
	  </div>
	  </div>
	  
	  <div class="panel panel-default">
	    <div class="panel panel-heading">
		<h3>WEEKLY REPORT</h3>
		</div>
		<div class="panel-body">
		   <div class="col-sm-12 table-responsive">
		     <table id="min-table" class="table table-bordered table-striped">
	       <thead>
		     <tr>
			 <th>Module Code</th>
			 <th>Exam Date</th>
			 <th>Week Number</th>
			 </tr>
		   </thead>
		   <?php
		      if($trend_Rows > 0){
				  foreach($trend_results as $trend_result){
					  echo '
					     <tr>
						    <td>'.$trend_result["MODULE CODE"].'</td>
							<td>'.$trend_result["EXAM DATE"].'</td>
                            <td>'.$trend_result["WEEK NUMBER"].'</td>							
						 </tr>
					  ';
				  }
			  }
		   ?>
	   </table>
		   </div>
	     </div>
	  </div>
	  
	  <div class="panel panel-default">
	    <div class="panel panel-heading">
		<h3>MIS REPORT</h3>
		</div>
		<div class="panel-body">
		   <div class="col-sm-12 table-responsive">
		     <table id="min-table" class="table table-bordered table-striped">
	       <thead>
		     <tr>
			 <th>Student Number</th>
			 <th>Module Code</th>
			 <th>Submission Times</th>
			 </tr>
		   </thead>
		   <?php
		      if($prediction_Rows > 0){
				  foreach($prediction_results as $prediction_result){
					  echo '
					     <tr>
						    <td>'.$prediction_result["STUDENTS"].'</td>
							<td>'.$prediction_result["ModuleCode"].'</td>
                            <td>'.$prediction_result["SUMBISSION TIMES"].'</td>							
						 </tr>
					  ';
				  }
			  }
		   ?>
	   </table>
		   </div>
	     </div>
	  </div>
	</div>
	   </body>