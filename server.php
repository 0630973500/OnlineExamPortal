<?php
    //database connection
	$conn = mysqli_connect('localhost', 'root', '', 'm39537862')or die('Connection failed'. mysql_error());
	$files = '';
	//retrieve all information from questions table
	if(isset($_POST['submit'])){
		$examId = $_POST['module'];
		$stuNum = $_SESSION['username'];
		$sql = "SELECT * FROM questions WHERE ExamId =".$examId;
	    $results = mysqli_query($conn,$sql);
	    $files = mysqli_fetch_all($results,MYSQLI_ASSOC);
	}
	
	if(isset($_POST['submit'])){
		$examId = $_POST['module'];
		if(isset($_FILES['my_file']['name']) && !empty($_FILES['my_file']['name'])){
			$name = $_POST['file_name'];
			$pname = rand(1000,10000)."-".$_FILES['my_file']['name'];
		    $filename = $_FILES['my_file']['name'];
			$destination = 'uploads/';
		    $tname = $_FILES['my_file']['tmp_name'];
		    //$upload_dir = "/ty";
		    move_uploaded_file($tname,$destination.'/'.$pname);
		    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
		        
		    //save the uploaded file to database
		    $sql = "INSERT INTO `Questions`(`ExamId`, `File_name`, `Question_paper`, `Downloads`) VALUES ($examId,'$name','$pname',0)";
            if(mysqli_query($conn,$sql)){
                $message = "File uploaded successfully";
		    }else{
                $message = "There was an error uploading the file";
		    }
		}
	}
	
	if(isset($_GET['file_id'])){
		$id = $_GET['file_id'];
		$sql = "SELECT * FROM questions WHERE Id = $id";
		$result = mysqli_query($conn,$sql);
		$file = mysqli_fetch_assoc($result);
		$file_path = "uploads/".$file['Question_paper'];
		
		if(file_exists($file_path)){
			header('Content-Type: application/octet-stream');
			header('Content-Description: File Transfer');
			header('Content-Disposition: attachment; filename='.basename($file_path));
			header('Expires:0');
			header('Cache-control: must-revalidate');
			header('Pragma: public');
			header('Content-length:'.filesize('uploads/'.$file['Question_paper']));
			readfile('uploads/'.$file['Question_paper']);
			
			$newCount = $file['Downloads']+1;
			$updateQuery = "UPDATE questions SET Downloads = $newCount WHERE Id = $id";
			mysqli_query($conn,$updateQuery);
			exit();
		}else{
			echo "file does not exist ".$file_path;
		}
	}
?>