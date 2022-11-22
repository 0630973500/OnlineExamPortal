<?php
  include('database_connection.php');
  if(isset($_SESSION['username'])){
	  if($_POST['new_password'] != ''){
		  $query = "UPDATE users SET Username = '".$_POST['username']."', Email = '".$_POST['email']."', Password = '".$_POST['new_password']."' 
		  WHERE id = '".$_SESSION['user_id']."'";
	  }else{
		  $query = "UPDATE users SET Username = '".$_POST['username']."', Email = '".$_POST['email']."' 
		  WHERE id = '".$_SESSION['user_id']."'";
	  }
	  $statement = $connect->prepare($query);
	  $statement->execute();
	  $result = $statement->fetchAll();
	  if(isset($result)){
		  echo "<div class='alert alert-success'>Profile edited</div>";
	  }
  }
?>