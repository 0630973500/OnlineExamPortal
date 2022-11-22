<?php
   include('database_connection.php');
   
   if(!isset($_SESSION['role'])){
	   header("location:login.php");
   }
   include('header.php');
?>
<div class="row">
    <div class="clo-lg-12">
	   <div class="panel panel-default">
	       <div class="panel-heading">
		      <div class="col-lg-10 col-md-12 col-sm-8 col-xs-6">
			      <div class="row">
				     <h3 class="panel-title">User List</h3>
				  </div>
			  </div>
		   </div>
	   </div>
	</div>
</div>