<?php
  //for displaying full info and edit data
  $conn = mysqli_connect('localhost', 'root', '', 'm39537862')or die('Connection failed'. mysql_error());
  if(isset($_REQUEST['id'])){
	 $id = intval($_REQUEST['id']); 
	 $sql = "SELECT * FROM exam WHERE ExamId=$id";
	 $run = mysqli_query($conn, $sql);
	 while($row=mysqli_fetch_array($run)){
		$per_id=$row[0];
        $exam_date=$row[1]; 
        $start_time=$row[2]; 
        $end_time=$row[3]; 
        $module_code=$row[4]; 
        $status=$row[5];		
	 }
	 ?>
	 <form class="form-horizontal" method="post">
	     <div class="modal-content">
		    <div class="modal-head">
			   <button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h4 class="modal-title">Edit Exam Schedule</h4>
			   <div class="modal-body">
			      <form class="form-horizontal">
				     <div class="box-body">
					    <div class="form-group">
						  <label class="clo-sm-4 control-label" for="examid"></label>
						   <div class="col-sm-6">
						      <input type="text" class="form-control" id="examid" name="examid" value="<?php echo $per_id; ?>" readonly>
						   </div>
						</div>
						<div class="form-group">
						  <label class="clo-sm-4 control-label" for="exam_date">Exam Date</label>
						   <div class="col-sm-6">
						      <input type="date" class="form-control" id="exam_date" name="exam_date" value="<?php echo $exam_date; ?>">
						   </div>
						</div>
						<div class="form-group">
						  <label class="clo-sm-4 control-label" for="start_time">Start Time</label>
						   <div class="col-sm-6">
						      <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo $start_time; ?>">
						   </div>
						</div>
						<div class="form-group">
						  <label class="clo-sm-4 control-label" for="end_time">Complete Time</label>
						   <div class="col-sm-6">
						      <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo $end_time; ?>" >
						   </div>
						</div>
						<div class="form-group">
						  <label class="clo-sm-4 control-label" for="address">Module</label>
						   <div class="col-sm-6">
						      <input type="text" class="form-control" id="module_code" name="module_code" value="<?php echo $module_code; ?>">
						   </div>
						</div>
						<div class="form-group">
						  <label class="clo-sm-4 control-label" for="status">Status</label>
						   <div class="col-sm-6">
						      <input type="text" class="form-control" id="status" name="status" value="<?php echo $status; ?>" readonly>
						   </div>
						</div>
					 </div>
				  </form>
			   </div>
			</div>
			<div class="modal-footer">
			    <a href="examination.php"><button type="button" class="btn btn-danger">Cancel</button></a>
			    <button type="submit" class="btn btn-primary" name="btnEdit">Update</button>
			</div>
		 </div>
	 </form>
	 <?php
  }
?>