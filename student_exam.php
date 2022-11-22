<?php
   include('connection.php');
   $db_host = "localhost";
   $db_name = "m39537862";
   $username = "root";
   $password = "";
   $mysqli = new mysqli($db_host, $username, $password, $db_name);

   //create error handler
   if($mysqli->connect_error){
	   printf("Connection failed: %s\n", $mysqli->connect_error);
	   exit();
   }
   include('server.php');
   if(!isset($_SESSION['role'])){
		header("location:login.php");
	}
	include('header.php');
	if(isset($_POST['upload'])){
		if(isset($_FILES['my_file']['name']) && !empty($_FILES['my_file']['name'])){
			$examId = $_POST['exam_id'];
			$student_number = $_SESSION['username'];
			$pname = rand(1000,10000)."-".$_FILES['my_file']['name'];
		    $filename = $_FILES['my_file']['name'];
			$destination = 'exam_uploads/';
		    $tname = $_FILES['my_file']['tmp_name'];
		    //$upload_dir = "/ty";
		    move_uploaded_file($tname,$destination.'/'.$pname);
		    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
		        
		    //save the uploaded file to database
		    $sql = "INSERT INTO `upload`(`ExamId`, `StudentNumber`, `Document`) VALUES ($examId,'$student_number','$pname')";
            if(mysqli_query($conn,$sql)){
                $message = "File uploaded successfully";
		    }else{
                $message = "There was an error uploading the file";
		    }
		}
	}
	
	//Get the module code
	$module_query = "SELECT * FROM exam WHERE ExamId = ".$examId;
	$module_results = $mysqli->query($module_query) or die($mysqli->error.__LINE__);
	$module_row = $module_results->fetch_assoc();
	$exam_date = $module_row['ExamDate'];
	$start_time = $module_row['StartTime'];
	$end_time = $module_row['EndTime'];
	list($year, $month, $day) = explode('-', $exam_date);
	
	
?>
<script>
  
</script>
<div class="container">
    <div class="panel-default">
	   <div class="panel-heading">
	       <h2>Students Exam</h2>
	   </div>
	   
	   <div class="panel-body" id="download">
	   <p id="demo"></p>
       <script>
       // Set the date we're counting down to
       var countDownDate = new Date("<?php echo $month.' '.$day; ?>, <?php echo $year.' '.$end_time;?>").getTime();
       
       // Update the count down every 1 second
       var x = setInterval(function() {
       
         // Get today's date and time
         var now = new Date("<?php echo $exam_date; ?>").getTime("<?php echo $exam_date; ?>");
           
         // Find the distance between now and the count down date
         var distance = countDownDate - now;
           
         // Time calculations for days, hours, minutes and seconds
         var days = Math.floor(distance / (1000 * 60 * 60 * 24));
         var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
         var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
         var seconds = Math.floor((distance % (1000 * 60)) / 1000);
           
         // Output the result in an element with id="demo"
         document.getElementById("demo").innerHTML = days + "d " + hours + "h "
         + minutes + "m " + seconds + "s ";
           
         // If the count down is over, write some text 
         if (distance < 0) {
           clearInterval(x);
           document.getElementById("demo").innerHTML = '<span lass="badge badge-warning">EXPIRED</span>';
         }
		 function showDiv(){
	      document.getElementById("upload").style.visibility="visible";
        }
        //setTimeout("showDiv()",3000)
		if(minutes > 33){
			showDiv();
		}
  
        function hideDiv(){
	       document.getElementById("download").style.visibility="hidden";
        }
        //setTimeout("hideDiv()",3000)
		if(minutes > 33){
			hideDiv();
		}
       }, 1000);
       </script>
	   <a href="" download></a>
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
		<tbody>
		   <?php 
		     if(is_array($files) || is_object($files)){
		       foreach($files as $file): ?>
			   <tr>
			     <td><?php echo $file['Id'];?></td>
				 <td><?php echo $file['File_name'];?></td>
				 <td><?php echo $file['Question_paper'];?></td>
				 <td><?php echo $file['Downloads'];?></td>
				 <td><a href="student_exam.php?file_id=<?php echo $file['Id'];?>" id="getEdit" class="btn btn-primary btn-xs"><i class="fa fa-download" aria-hidden="true"></i>Download</a></td>
			   </tr>
			   <?php endforeach; 
			 }?>
		</tbody>
    </table>
		</div>
		<form action="student_exam.php" method="post" enctype='multipart/form-data' id="upload" style="visibility:hidden;">
		      
			  <div class="form-group">
		        <input type="file" class="form-control-file" name="my_file">
	          </div>
			  <div class="form-group">
			    <input type="hidden" class="btn btn-primary" name="student_number" value="<?php echo $stuNum; ?>">
				<input type="hidden" class="btn btn-primary" name="exam_id" value="<?php echo $examId; ?>">
		        <input type="submit" class="btn btn-primary" name="upload" value="SUBMIT">
	          </div>
	      </form>
	   </div>
	</div>
</div>

