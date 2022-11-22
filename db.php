<?php
   define('DB_HOST','localhost');
   define('DB_USER','root');
   define('DB_PASS','');
   define('DB_NAME','m39537862');
   $connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
   
   if($connect->connect_error){
	   die('Database error:'.$conn->connect_error);
   }
?>