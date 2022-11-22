<?php
  //for displaying full info and edit data
  $conn = mysqli_connect('localhost', 'root', '', 'm39537862')or die('Connection failed'. mysql_error());
  
  $result = $conn->query("SELECT * FROM exam");
  
  if(isset($_REQUEST['id'])){
	 $id = intval($_REQUEST['id']); 
	 $sql = "SELECT q.id, q.ExamId, q.File_name, q.Question_paper, e.ExamId, e.ModuleCode
	 FROM questions q JOIN exam e USING(ExamId) WHERE q.ExamId = e.ExamId AND Id=$id";
	 $run = mysqli_query($conn, $sql);
	 while($row=mysqli_fetch_array($run)){
		$per_id=$row[0];
        $per_module=$row[1]; 
        $per_name=$row[2]; 
        $per_paper=$row[3];
        $per_code=$row[5];		
	 }
	 ?>
	 <form class="form-horizontal" method="post">
	     <div class="modal-content">
		    <div class="modal-head">
			   <button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h4 class="modal-title">Update Exam Questions</h4>
			   <div class="modal-body">
			      <form class="form-horizontal">
				     <div class="box-body">
					    <div class="form-group">
						  <label class="clo-sm-4 control-label" for="txtid"></label>
						   <div class="col-sm-6">
						      <input type="text" class="form-control" id="qid" name="qid" value="<?php echo $per_id; ?>" readonly>
						   </div>
						</div>
						<div class="form-group">
						  <label class="clo-sm-4 control-label" for="module">Choose Module</label>
						   <div class="col-sm-6">
						      <select class="form-control" name="module" id="module">
			                      <option value="<?php echo $per_module; ?>"><?php echo $per_code; ?></option>
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
						  <label class="clo-sm-4 control-label" for="file_name">Enter Module Code</label>
						   <div class="col-sm-6">
						      <input type="text" class="form-control" id="file_name" name="file_name" value="<?php echo $per_name; ?>">
						   </div>
						</div>
						<div class="form-group">
						   <div class="col-sm-6">
						      <input type="file" class="form-control" id="my_file" name="my_file" value="<?php echo $per_paper; ?>" >
						   </div>
						</div>
					 </div>
				  </form>
			   </div>
			</div>
			<div class="modal-footer">
			    <a href="exam_list.php"><button type="button" class="btn btn-danger">Cancel</button></a>
			    <button type="submit" class="btn btn-primary" name="btnEdit">Update</button>
			</div>
		 </div>
	 </form>
	 <?php
  }
?>