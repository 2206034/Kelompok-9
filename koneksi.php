<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "akademik";
	
	$connect = mysqli_connect($host,$user,$password,$database) or die (mysqli_error($connect));
?>