<?php
   include('connection.php');
   include('server.php');
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
	       <h2>Add Exam</h2>
		   <?php
		       if(isset($message)){
				   echo $message;
			   }
		   ?>
	   </div>
	   
	   <div class="panel-body">
	      <form action="exam.php" method="post" enctype='multipart/form-data'>
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
	          <div class="form-group">
	            <label for="module">Enter File Name</label></br>
		        <input type="text" class="form-control" name="file_name">
	          </div>
			  <div class="form-group">
		        <input type="file" class="form-control-file" name="my_file">
	          </div>
			  <div class="form-group">
		        <input type="submit" class="btn btn-primary" name="submit" value="SUBMIT">
	          </div>
	      </form>
	   </div>
	</div>
</div>
	<script>
	   $(document).ready(function(){
	       var dataTable = $('#example').DataTable({
		       "processing": true,
			   "serverSide": true,
			   "ajax":{
				   url:"fetch_exam.php",
				   type:"post"
			   }
		   });
		   
	   });
	</script>
	<!--Script js for editing client data-->
    <script>
	    $(document).on('click', '#getEdit', function(e){
			e.preventDefault();
			var per_id=$(this).data('id');
			$('#content-data').html('');
			$.ajax({
				url:"update_supplements.php",
				type:"post",
				data:"id="+per_id,
				dataType:"html"
			}).done(function(data){
				$('#content-data').html('');
				$('#content-data').html(data);
			}).fial(function(){
				$('#content-data').html('<p>Error</p>');
			});
		});
	</script>
<?php
    //database connection
    $conn = mysqli_connect('localhost', 'root', '', 'm39537862')or die('Connection failed'. mysql_error());
	//Check if the save button is clicked
    if(isset($_POST['btnEdit'])){
		$new_id = mysqli_real_escape_string($conn, $_POST['txtid']);
		$new_supplid = mysqli_real_escape_string($conn, $_POST['txtsuppid']);
		$new_supplierid = mysqli_real_escape_string($conn, $_POST['txtsupplierid']);
		$new_description = mysqli_real_escape_string($conn, $_POST['txtdescription']);
		$new_cost_excl = mysqli_real_escape_string($conn, $_POST['txtcostexcl']);
		$new_cost_incl = mysqli_real_escape_string($conn, $_POST['txtcostincl']);
		$new_min_level = mysqli_real_escape_string($conn, $_POST['txtminlevel']);
		$new_current_stock = mysqli_real_escape_string($conn, $_POST['txtcurrentstock']);
		$sql_update = "UPDATE tblsupplement SET Supplement_Id ='$new_supplid',Supplier_ID='$new_supplierid',Description='$new_description',Cost_excl='$new_description',Cost_incl='$new_min_level',Min_levels='$new_min_level',Current_Stock_Level='$new_current_stock' WHERE id='$new_id'";
		
		$result_update = mysqli_query($conn, $sql_update);
		if($result_update){
			echo "<script>window.location.href='supplements.php'</script>";
		}else{
			echo "<script>alert('Update failed!')</script>";
		}
	}
?>
