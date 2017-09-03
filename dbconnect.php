<?php
 	$con=new mysqli("127.0.0.1","root","root","dairy");
 		// Check connection
 		if ($con->connect_error) {
 		    die("Connection failed: " . $con->connect_error);
 		} else
 		// echo "Connected successfully";
?>