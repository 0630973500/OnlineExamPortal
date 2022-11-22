
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	  <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Online Examination Portal</title>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  
	  <!--Database-->
	  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	  <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	  <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
	   <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	   <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	  <script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
	  <!--<script type="text/javascript" src="order.js"></script>-->
  </head>
  <body>
    
	<div class="container">
	   <h2 align="center">
		 ONLINE EXAM PORTAL
	   </h2>
	   <nav class="navbar navbar-inverse">
	       <div class="container-fluid">
		      <div class="navbar-header">
			  </div>
			  <ul class="nav navbar-nav">
			    <?php
				   if($_SESSION['role'] == "Admin"){
					  
                 ?>
				    <a href="index.php" class="navbar-brand">Home</a>
					<li><a href="examination.php"><i class="fa fa-desktop" aria-hidden="true"></i><span>Exam List</span></a></li>
                   <li><a href="exam_list.php"><i class="fa-question" aria-hidden="true"></i><span>Question</span></a></li>
			       <li><a href="exam.php"><i class="fa fa-plus" aria-hidden="true"></i><span>Add Question</span></a></li>
			       <li><a href="summary_report.php"><i class="fa fa-plus" aria-hidden="true"></i><span>Reports</span></a></li>
                 <?php				 
				   }
				?>
                                 <?php
				   if($_SESSION['role'] == "Student"){
					  
                 ?>
				<li><a href="student_site.php"><i class="fa fa-home" aria-hidden="true"></i><span>Student Site</span></a></li>
				<li><a href="student_exam.php"><i class="fa fa-eye" aria-hidden="true"></i><span>Exam</span></a></li>
                               <?php				 
				   }
				?>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
					   <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><span class="label label-pill label-danger count"><?php echo $_SESSION['username']; ?></span></a>
					   <ul class="dropdown-menu">
					     <li><a href="profile.php">Profile</a></li>
			             <li><a href="logout.php">Logout</a></li>
					   </ul>
					</li>
					
			  </ul>
		   </div>
	   </nav>
	</div>
  
  </body>
