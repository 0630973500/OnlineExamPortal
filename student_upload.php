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
	       <h4>Thank you for submitting your exam in time.</h4>
		   <h4>Contact your lecture for enquiries/more info.</h4>
	      </form>
		   </div>
	   </div>
	</div>
</div>