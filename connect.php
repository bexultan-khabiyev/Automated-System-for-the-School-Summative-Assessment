<?php
	$servername = "localhost";
	$name1 = "root";
	$password = "";
	$database = "project";
	
	// This line establishes connection with the database
	$conn = mysqli_connect($servername, $name1, $password, $database); 

	// If the connection is not established, then the program will give an error
	if (!$conn) 
	{
    	die("Connection failed: " . mysqli_connect_error());
	}
?>