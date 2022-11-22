<?php
  $conn = mysqli_connect('localhost', 'root', '', 'm39537862')or die('Connection failed'. mysql_error());
  
  $request = $_REQUEST;
  $col = array(
       0 => 'Id',
	   1 => 'ExamId',
	   2 => 'File_name',
	   3 => 'Question_paper',
	   4 => 'Downloads'
  ); //create column
  $sql = "SELECT * FROM questions";
  $query = mysqli_query($conn, $sql);
  $totData = mysqli_num_rows($query);
  $totalFilter = $totData;
  $sql = "SELECT * FROM questions WHERE 1=1";
  
  if(!empty($request['search']['value'])){
	  $sql.=" AND (File_name Like'".$request['search']['value']."%' ";
	  $sql.=" OR Question_paper Like'".$request['search']['value']."%' )";
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
	  $subData[]=$row[2];
	  $subData[]=$row[3];
	  $subData[]=$row[4];
	  //$subData[]=$row[4];
	 
	  //$subData[]=$status;
	  $subData[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'"><i class="fa-pencil-square-o" aria-hidden="true"></i>Edit</button>';
	  //$subData[]='<a href="exam_list.php?file_id="'.$row[0].'" id="getEdi" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModa" data-id="'.$row[0].'"><i class="fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
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