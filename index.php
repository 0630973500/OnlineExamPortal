<?php
    //index
	include('connection.php');
	if(!isset($_SESSION['role'])){
		header("location:login.php");
	}
	include('header.php');
?>
<div class="container">
    <div class="panel-default">
	   <div class="panel-heading">
	       <h4>Student Register</h4>
		   <div class="panel-body">
		      <ol>
			      <li>This examination is a closed book examination</li>
			  </ol>
		   </div>
	   </div>
	</div>
</div>