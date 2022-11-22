<?php
       //require('db.php');
	   $db = mysqli_connect('localhost', 'root', '', 'm39537862');
       //session_start();
       $exam_date = "";
	   $start_time = "";
	   $complete_time = "";
	   $student_number = "";
	   $module_code = "";
	   $id = 0;
	   $errors = array();
	   
	   $edit_state = false;
   
   if(isset($_POST['submit'])){
	   $exam_date = $_POST['exam_date'];
	   $start_time = $_POST['start_time'];
	   $complete_time = $_POST['complete_time'];
	   $student_number = $_POST['student'];
	   $module_code = $_POST['module_code'];
	   
	   if($exam_date != null){		   
		   $sql = "INSERT INTO exam (`ExamDate`, `StartTime`, `EndTime`, `StudentNumber`, `ModuleCode`, `Status`)
		          VALUES ('$exam_date', '$start_time', '$complete_time', '$student_number', '$module_code', 'Pending')";
	       mysqli_query($db, $sql);
	       $_SESSION['username'] = $username;
	       $_SESSION['msg'] = "Registration Successful";
		   $_SESSION['img'] = "<img src='admin-user-icon-4.jpg' align='center' style='width:300px; height:300px'>";
		   $_SESSION['Role'] = $userrole;
	       $_SESSION['success'] = "You are now logged in";
	        echo "<script>window.open('index.php','_self')</script>";
			exit(); 
		}
   }	  

   if(isset($_POST['login'])){
	   $username = $_POST['uname'];
	   $password = $_POST['password'];
	   $hcp = "Health Care Practitioner(HCP)";
	   $ga = "General Assistant(GP)";
	   $pat = "Patient";
       if(empty($username)){
		   echo "<script>alert('Username is required');</script>";
	   }
	   if(empty($password)){
		   echo "<script>alert('Password is required');</script>";
	   }
	   if(count($errors) === 0){
		   $p = md5($password);
	       $query_hcp = "select * from users where Username='$username' And Password='$password' And Role='$hcp'";
	       $run_hcp = mysqli_query($db, $query_hcp);
		   
		   $query_ga = "select * from users where Username='$username' And Password='$password' And Role='$ga'";
	       $run_ga = mysqli_query($db, $query_ga);
	  
	       $query_pat = "select * from users where Username='$username' And Password='$password' And Role='$pat'";
	       $run_pat = mysqli_query($db, $query_pat);
	   
	    if(mysqli_num_rows($run_hcp)==1){
			      $_SESSION['username'] = $username;
	              $_SESSION['msg'] = "Login is Successful";
		          $_SESSION['img'] = "<img src='admin-user-icon-4.jpg' align='center' style='width:300px; height:300px'>";
		          $_SESSION['Role'] = $userrole;
	              $_SESSION['success'] = "You are now logged in";
		          echo "<script>window.open('home.php','_self')</script>"; 
	          }else if(mysqli_num_rows($run_ga)==1){
				  $_SESSION['username'] = $username;
	              $_SESSION['msg'] = "Registration Successful";
		          $_SESSION['img'] = "<img src='download.png' align='center' style='width:300px; height:300px'>";;
		          $_SESSION['Role'] = $userrole;
	              $_SESSION['success'] = "You are now logged in";
		          echo "<script>window.open('ga_clients.php','_self')</script>";
	          }else if(mysqli_num_rows($run_pat)==1){
		         echo "<script>window.open('appointments.php','_self')</script>";
	          }else{
		         echo "<script>alert('Username or password is invalid')</script>";
	         }
	   
	  }
   }
   
   //logout
   if(isset($_GET['logout'])){
	   session_destroy();
	   unset($_SESSION['username']);
	   header('location: login.php');
   }
   ?>