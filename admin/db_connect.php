<?php
	
	$servername = 'localhost';
	$username = 'root';
	$pass = '';

	//creat connection
	$conn = new mysqli($servername,$username,$pass);
	//check connection

	if($conn->connect_error){
		die("Connection failed".$conn->connect_error);
	}else{
		$conn->select_db(`ecom`);
	}
?>