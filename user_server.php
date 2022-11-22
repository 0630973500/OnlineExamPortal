<?php
       require('db.php');
	   $db = mysqli_connect('localhost', 'root', '', 'm39537862');
       session_start();
       $username = "";
	   $userrole = "";
	   $email = "";
	   $password = "";
	   $id = 0;
	   $errors = array();
	   
	   $edit_state = false;
   
   if(isset($_POST['submit'])){
	   $username = $_POST['username'];
	   $userrole = $_POST['role'];
	   $email = $_POST['email'];
	   $password = $_POST['pwd'];
	   $pwd2 = $_POST['pwd2'];
	   $admin = "Admin";
	   $student = "Student";
	   $pat = "Patient";
	  //try this hlee
       if(empty($username)){
		   echo "<script>alert('Username is required');</script>";
	   }
	   if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		   echo "<script>alert('Invalid Email');</script>";
	   }
	    if(empty($email)){
		   echo "<script>alert('Email is required');</script>";
	   }
	   if(empty($userrole)){
          echo "<script>alert('User role is required');</script>";
	   }
	   if(empty($password)){
		   echo "<script>alert('Password is required');</script>";
	   }
	   if($password != $pwd2){
		   echo "<script>alert('Password do not match');</script>";
	   }
	   
	   if($userrole == $admin){
			   $pwd = md5($password);		   
		   $sql = "INSERT INTO users (Username, Email, Role, Password)
		          VALUES ('$username', '$email', '$userrole', '$password')";
	       mysqli_query($db, $sql);
	       $_SESSION['username'] = $username;
	       $_SESSION['msg'] = "Registration Successful";
		   $_SESSION['img'] = "<img src='admin-user-icon-4.jpg' align='center' style='width:300px; height:300px'>";
		   $_SESSION['Role'] = $userrole;
	       $_SESSION['success'] = "You are now logged in";
	        echo "<script>window.open('index.php','_self')</script>";
			}else if($userrole == $student){
			 $pwd = md5($password);		   
		   $sql = "INSERT INTO users (Username, Email, Role, Password)
		          VALUES ('$username', '$email', '$userrole', '$password')";
	       mysqli_query($db, $sql);
	       $_SESSION['username'] = $username;
	       $_SESSION['msg'] = "Registration Successful";
		   $_SESSION['img'] = "<img src='download.png' align='center' style='width:300px; height:300px'>";;
		   $_SESSION['Role'] = $userrole;
	       $_SESSION['success'] = "You are now logged in";
	       echo "<script>window.open('student_site.php','_self')</script>";
		   exit(); 
		   }
	}
   
    //Contact us 
   if(isset($_POST['contact'])){
	   $user = $_POST['name'];
	   $uemail = $_POST['email'];
	   $subject = $_POST['subject'];
	   $message = $_POST['message'];
       if(empty($user)){
		   array_push($errors, "Name is required");
	   }
	   if(empty($uemail)){
		   array_push($errors, "Email is required");
	   }
	   if(empty($subject)){
		   array_push($errors, "Subject is required");
	   }
	   if(empty($message)){
		   array_push($errors, "Message is required");
	   }
	    if(count($errors) == 0){
       $sql = "INSERT INTO contactus(Name, Email, Subject, Message)
		          VALUES (?, ?, ?, ?)";
	       $stmt = $conn->prepare($sql);
	       $stmt->bind_param('ssss', $user, $uemail, $subject, $message);		
	   if($stmt->execute()){
		 $_SESSION['msg'] = "Thank you for contacting us, we'll contact you as soon as we recieve your message";
	     header('location: contacted.php');
		 exit();
	   }
	}
   }
     //get messages from contact us table
   function getMessage($conn){
	   $sql = "SELECT * FROM contactus";
	   $res = mysqli_query($conn, $sql);
	   while($row = $res->fetch_assoc()){
		    echo "<div class='comments'>";
		       echo $row['Name']."<br>";
		       echo $row['Email']."<br>";
		       echo $row['Subject']."<br>";
               echo $row['Message'];
            echo "</div>";		  
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