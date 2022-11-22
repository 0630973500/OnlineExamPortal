<?php
  $conn = mysqli_connect('localhost', 'root', '', 'm39537862')or die('Connection failed'. mysql_error());
  
  $request = $_REQUEST;
  $col = array(
       0 => 'ExamId',
	   1 => 'ExamDate',
	   2 => 'StartTime',
	   3 => 'EndTime',
	   4 => 'StudentNumber',
	   5 => 'ModuleCode',
	   6 => 'Status'
  ); //create column
  $sql = "SELECT * FROM exam";
  $query = mysqli_query($conn, $sql);
  $totData = mysqli_num_rows($query);
  $totalFilter = $totData;
  $sql = "SELECT * FROM exam WHERE 1=1";
  
  if(!empty($request['search']['value'])){
	  $sql.=" AND (ExamDate Like'".$request['search']['value']."%' ";
	  $sql.=" OR ModuleCode Like'".$request['search']['value']."%' )";
  }
  $query = mysqli_query($conn, $sql);
  $totData = mysqli_num_rows($query);
  
  //order
  $sql.=" ORDER BY ".$col[$request['order'][0]['column']]."  ".$request['order'][0]['dir']."  LIMIT  ".$request['start']."  ,".$request['length']."  ";
   $query = mysqli_query($conn, $sql);
  
  $data = array();
  
  while($row = mysqli_fetch_array($query)){
	  $subData = array();
	  $subData[]=$row[0];
	  $subData[]=$row[1];
	  $subData[]=$row[2];
	  $subData[]=$row[3];
	  $subData[]=$row[5];
	  
	  $status = '';
	  if($row[6] == "Pending"){
		  $status = '<span class="badge badge-warning">Pending</span>';
	  }
	  
	  if($row[6] == "Completed"){
		  $status = '<span class="badge badge-dark">Completed</span>';
	  }
	  $subData[]=$status;
	  $subData[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>';
	  $data[]=$subData;
  }
  $json_data = array(
        'draw' => intval($request['draw']),
		'recordsTotal' => intval($totData),
		'recordsFilter' => intval($totalFilter),
		'data' => $data
  );
  echo json_encode($json_data);
?>