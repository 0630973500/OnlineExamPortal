<?php
    $conn = mysqli_connect('localhost', 'root', '', 'm39537862')or die('Connection failed'. mysql_error());
	
	if(isset($_POST['submit'])){
		$stu_num = $_POST['student_number'];
	    $stu_name = $_POST['student_name'];
	    $stu_surname = $_POST['student_surname'];
	    $email = $_POST['email'];
	    $module = $_POST['module'];
	        
	    //save the uploaded file to database
	    $sql = "INSERT INTO `students`(`StudentNumber`, `StudentName`, `StudentSurname`, `Email`) VALUES ('$stu_num','$stu_name','$stu_surname','$email')";
         if(mysqli_query($conn,$sql)){
            $message = "File uploaded successfully";
	    }else{
            $message = "There was an error uploading the file";
	    }
	}
?>