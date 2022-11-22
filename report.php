<?php
     //include('mainserver.php');
	 $db = mysqli_connect('localhost', 'root', '', 'althealth');
	 $date = date('Y-m-d');
	 $query = "SELECT YEAR(`Date`) AS Year, SUM(`Fee`) AS Amount FROM `payment_record` WHERE YEAR(`Date`) GROUP BY YEAR(`Date`)";
	 $res = $db->query($query);
     //payment reports
	 $pay_query = "SELECT Status, Count(id) AS Number FROM payment_record WHERE Date = '$date' GROUP BY Status";
	 $pay_res = $db->query($pay_query);
	 //unpaid invoices reports
	 $unpaid_query = "SELECT Count(Client_ID) AS Number FROM payment_record WHERE Date = '$date' GROUP BY Status";
	 $unpaid_res = $db->query($unpaid_query);
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	  <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Dashboard</title>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="style1.css">
	  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
		google.charts.setOnLoadCallback(drawChart1);

        function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Year', 'Amount'],
          <?php
		      while($row = mysqli_fetch_assoc($res)){
				 echo "['".$row['Year']."', ".$row['Amount']."],"; 
			  }
		  ?>
        ]);

        var options = {
          chart: {
            title: 'KOPLINE HEALTH CARE Payments Record',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
	  //Payment reports
	  function drawChart1() {

        var data = google.visualization.arrayToDataTable([
          ['Status', 'Number'],
          <?php
		      while($row = mysqli_fetch_assoc($pay_res)){
				 echo "['".$row['Status']."', ".$row['Number']."],"; 
			  }
		  ?>
        ]);

        var options = {
			chart: {
				title: 'KOPLINE HEALTH CARE Payments Record',
			},
		  bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material1'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
	  }
	  /*Unpaid invoices reports
	  function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['Status', 'Number'],
          <?php
		      while($row = mysqli_fetch_assoc($unpaid_query)){
				 echo "['".$row['Status']."', ".$row['Number']."],"; 
			  }
		  ?>
        ]);

        var options = {
			chart: {
				title: 'KOPLINE HEALTH CARE Unpaid Invoices Record',
			},
		  bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material1'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
	  }*/
    </script>
  </head>
  <body>
  <input type="checkbox" id="check">
  <!--header starts here-->
     <header>
	 <label for="check">
	 <i class="fa fa-bars" id="sidebar_btn"></i>
	 </label>
	     <div class="left-area">
		    <h3>Makh_Mol <span>Health Care</span></h3> 
		 </div>
		 <div class="right-area">
		    <a href="#" class="logout_btn">Logout</a>
		 </div>
	 </header>
	 <!--End header-->
	 <!--menu starts here-->
	   <div class="sidebar">
		    <center>
			  <img src="download.png"  class="profile-image" alt="">
			</center>
			<a href="index1.php"><i class="fa fa-desktop" aria-hidden="true"></i><span>DASHBOARD</span></a>
			<a href="add_client.php"><i class="fa fa-plus" aria-hidden="true"></i><span>ADD CLIENTS</span></a>
			<a href="add_appointment.php"><i class="fa fa-plus" aria-hidden="true"></i><span>ADD APPOINTMENTS</span></a>
			<a href="supplements.php"><i class="fa fa-plus" aria-hidden="true"></i><span>ADD SUPPLEMENTS</span></a>
			<a href="suppliers.php"><i class="fa fa-plus" aria-hidden="true"></i><span>ADD SUPPLIERS</span></a>
			<a href="add_notes.php"><i class="fa fa-plus" aria-hidden="true"></i><span>ADD NOTES</span></a>
			<a href="day_to_day_reports.php"><i class="fa fa-file" aria-hidden="true"></i><span>REPORTS</span></a>
	   </div>
	 <!--End menu-->
	 <div class="content">
		
		 <div class="head">
		     <h2>Day to day reports in Charts format</h2>
		  </div>
		  <div id="barchart_material" style="width: 900px; height: 500px;"></div>
		  <div id="barchart_material1" style="width: 900px; height: 500px;"></div>
	 </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>