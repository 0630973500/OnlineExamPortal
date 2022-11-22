<?php
    $connect = new PDO('mysql:host=localhost;dbname=m39537862', 'root', '');
    session_start();
	
	/*function get_total_records($conn, $table_name){
		$query = "SELECT * FROM $table_name";
		$statement = $conn->prepare($query);
		$statement->execute();
		return $statement->rowCount();
	}*/
?>