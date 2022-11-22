<?php
   include('connection.php');
   
   if(!isset($_SESSION['role'])){
		header("location:login.php");
	}
	include('header.php');
?>
<div class="container">
    <div class="panel panel-default">
	    <div class="panel panel-heading">
		  <h3>
		  Manage Exam
		  <a class="btn btn-success pull-right" href="schedule_exam.php">Add Exam</a>
		  </h3>
		</div>
		<div class="panel-body">
		   <div class="col-sm-12 table-responsive">
	    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
				<th>Exam Date</th>
				<th>Start Time</th>
				<th>End Date</th>
				<th>Module Code</th>
				<th>Status</th>
                <th>Action</th>		
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
				<th>Exam Date</th>
				<th>Start Time</th>
				<th>End Date</th>
				<th>Module Code</th>
				<th>Status</th>
                <th>Action</th>			
            </tr>
        </tfoot>
    </table>
	<!--Create modal for displaying detail info-->
		<div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">
			   <div id="content-data"></div>
			</div>
		</div>
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
				url:"edit_exam.php",
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
		$new_id = mysqli_real_escape_string($conn, $_POST['examid']);
		$exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
		$start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
		$end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
		$module = mysqli_real_escape_string($conn, $_POST['module_code']);
		$sql_update = "UPDATE exam SET ExamDate ='$exam_date',StartTime='$start_time',EndTime='$end_time',ModuleCode='$module' WHERE ExamId='$new_id'";
		
		$result_update = mysqli_query($conn, $sql_update);
		if($result_update){
			echo "<script>window.location.href='examination.php'</script>";
		}else{
			echo "<script>alert('Update failed!')</script>";
		}
	}
?>
