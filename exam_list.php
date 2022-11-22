<?php
   include('connection.php');
   include('server.php');
   if(!isset($_SESSION['role'])){
		header("location:login.php");
	}
	include('header.php');
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
	      <div class="col-sm-12 table-responsive">
	    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
				<th>File Name</th>
				<th>Question Paper</th>
				<th>Downloads</th>
                <th>Action</th>		
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
				<th>File Name</th>
				<th>Question Paper</th>
				<th>Downloads</th>
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
	</div>
</div>
	<script>
	   $(document).ready(function(){
	       var dataTable = $('#example').DataTable({
		       "processing": true,
			   "serverSide": true,
			   "ajax":{
				   url:"fetch_exam_list.php",
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
				url:"edit_questions.php",
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
		$new_id = mysqli_real_escape_string($conn, $_POST['qid']);
		$module_code = mysqli_real_escape_string($conn, $_POST['module']);
		$file_name = mysqli_real_escape_string($conn, $_POST['file_name']);
		//$q_paper = mysqli_real_escape_string($conn, $_POST['my_file']);
		$sql_update = "UPDATE questions SET ExamId ='$module_code', File_name='$file_name' WHERE Id='$new_id'";
		
		$result_update = mysqli_query($conn, $sql_update);
		if($result_update){
			echo "<script>window.location.href='exam_list.php'</script>";
		}else{
			echo "<script>alert('Update failed!')</script>";
		}
	}
?>
