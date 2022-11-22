<?php
   include('connection.php');
   $statement = $conn->prepare("SELECT c.Client_ID, c.C_name, C_surname, i.Inv_Num, i.Inv_Date
   FROM tblclientinfo c JOIN tblinv_info i USING(Client_ID)
   WHERE Inv_Paid_Date = 'N' AND YEAR(Inv_Date) != 2020
   GROUP BY c.C_name");
   $statement->execute();
   $results = $statement->fetchAll();
   $totRows = $statement->rowCount();
   
   //birthdays
   $statement1 = $conn->prepare("SELECT Client_ID, C_name FROM tblclientinfo
   WHERE SUBSTR(DATE(SUBSTR(Client_ID, 1, 6)), 6, 10) = SUBSTR(CURRENT_DATE, 6, 10);");
   $statement1->execute();
   $results1 = $statement1->fetchAll();
   $totRows1 = $statement1->rowCount();
   
   //Day-to-day report - Minimum stock levels
   $statement2 = $conn->prepare("SELECT s.Supplement_Id, su.Supplier_ID, su.Contact_Person, su.Supplier_tel, s.Min_Levels,
   s.Current_Stock_Level FROM tblsupplements s JOIN tblsupplier_info su USING (Supplier_ID) WHERE
   s.Min_Levels < s.Current_Stock_Level");
   $statement2->execute();
   $results2 = $statement2->fetchAll();
   $totRows2 = $statement2->rowCount();
   
   //Mis reports
   $statement3 = $conn->prepare("SELECT CONCAT(c.Client_ID, ' ', c.C_name, ' ', c.C_surname) As CLIENT, COUNT(*) AS FREQUENCY
   FROM tblclientinfo c JOIN tblinv_info i USING(Client_ID)
   JOIN tblinv_items USING(Inv_num)
   GROUP BY Client_ID");
   $statement3->execute();
   $results3 = $statement3->fetchAll();
   $totRows3 = $statement3->rowCount();
   
   //purchase statistics
   $statement4 = $conn->prepare("SELECT COUNT(*) AS Num_of_purchase, MONTHNAME(Inv_Date) AS Month FROM `tblinv_info` WHERE YEAR(Inv_Date) >= 2012 GROUP BY MONTH(Inv_Date);");
   $statement4->execute();
   $results4 = $statement4->fetchAll();
   $totRows4 = $statement4->rowCount();
   
   //client information query
   $statement5 = $conn->prepare("SELECT Client_ID as CLIENT, C_Tel_H as HOME, C_Tel_W as WORK, C_Tel_Cell as CELL, C_Email as EMAIL
   FROM `tblclientinfo`
   WHERE C_Tel_Cell = ' ' AND C_Email = ' '");
   $statement5->execute();
   $results5 = $statement5->fetchAll();
   $totRows5 = $statement5->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
       <title></title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="robots" content="noindex, nofollow">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
		<script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>

   </head>
   <body>
   <header><h1>Day-to-day Reports</h1></header>
      <h2>Unpaid Invoices</h2>
       <table id="data-table" class="table table-bordered table-striped">
	       <thead>
		     <tr>
			 <th>Client_ID</th>
			 <th>Client</th>
			 <th>Inv_Num</th>
			 <th>Inv_Date</th>
			 </tr>
		   </thead>
		   <?php
		      if($totRows > 0){
				  foreach($results as $result){
					  echo '
					     <tr>
						    <td>'.$result["Client_ID"].'</td>
							<td>'.$result["C_name"]." ".$result["C_surname"].'</td>
							<td>'.$result["Inv_Num"].'</td>
							<td>'.$result["Inv_Date"].'</td>
						 </tr>
					  ';
				  }
			  }
		   ?>
	   </table>
	   
	   <h2>Birthday reports</h2>
	   <table id="data-table" class="table table-bordered table-striped">
	       <thead>
		     <tr>
			 <th>Client_ID</th>
			 <th>Client</th>
			 </tr>
		   </thead>
		   <?php
		      if($totRows1 > 0){
				  foreach($results1 as $result1){
					  echo '
					     <tr>
						    <td>'.$result1["Client_ID"].'</td>
							<td>'.$result1["C_name"].'</td>	
						 </tr>
					  ';
				  }
			  }
		   ?>
	   </table>
	   
	   <h2>Day-to-day report - Minimum stock levels</h2>
	    <table id="data-table" class="table table-bordered table-striped">
	       <thead>
		     <tr>
			 <th>Supplement_Id</th>
			 <th>Supplier_ID</th>
			 <th>Contact_Person</th>
			 <th>Supplier_tel</th>
			 <th>Min_Levels</th>
			 <th>Current_Stock_Level</th>
			 </tr>
		   </thead>
		   <?php
		      if($totRows2 > 0){
				  foreach($results2 as $result2){
					  echo '
					     <tr>
						    <td>'.$result2["Supplement_Id"].'</td>
							<td>'.$result2["Supplier_ID"].'</td>
							<td>'.$result2["Contact_Person"].'</td>
							<td>'.$result2["Supplier_tel"].'</td>
							<td>'.$result2["Min_Levels"].'</td>
							<td>'.$result2["Current_Stock_Level"].'</td>
						 </tr>
					  ';
				  }
			  }
		   ?>
	   </table>
	   <h1>Mis Reports</h1>
	   <h2>MIS report - Top 10 clients for 2018 and 2019</h2>
	   <table id="data-table" class="table table-bordered table-striped">
	       <thead>
		     <tr>
			 <th>Client</th>
			 <th>Frequency</th>
			 </tr>
		   </thead>
		   <?php
		      if($totRows3 > 0){
				  foreach($results3 as $result3){
					  echo '
					     <tr>
						    <td>'.$result3["CLIENT"].'</td>
							<td>'.$result3["FREQUENCY"].'</td>
						 </tr>
					  ';
				  }
			  }
		   ?>
	   </table>
	   <h2>Purchases statistics</h2>
	   <table id="data-table" class="table table-bordered table-striped">
	       <thead>
		     <tr>
			 <th>Num_of_purchase</th>
			 <th>MONTH</th>
			 </tr>
		   </thead>
		   <?php
		      if($totRows4 > 0){
				  foreach($results4 as $result4){
					  echo '
					     <tr>
						    <td>'.$result4["Num_of_purchase"].'</td>
							<td>'.$result4["Month"].'</td>
						 </tr>
					  ';
				  }
			  }
		   ?>
	   </table>
	   <h2>Client Information Query</h2>
	   <table id="data-table" class="table table-bordered table-striped">
	       <thead>
		     <tr>
			 <th>CLIENT</th>
			 <th>HOME</th>
			 <th>WORK</th>
			 <th>CELL</th>
			 <th>EMAIL</th>
			 </tr>
		   </thead>
		   <?php
		      if($totRows5 > 0){
				  foreach($results5 as $result5){
					  echo '
					     <tr>
						    <td>'.$result5["CLIENT"].'</td>
							<td>'.$result5["HOME"].'</td>
							<td>'.$result5["WORK"].'</td>
							<td>'.$result5["CELL"].'</td>
							<td>'.$result5["EMAIL"].'</td>
						 </tr>
					  ';
				  }
			  }
		   ?>
	   </table>
   </body>
</html>