<?php
	// Database connection
	include ("connect.php");
	// Transfer data from the form and define variables for it
	$resultsID = $_POST["resultsID"];
	$add = mysqli_query($conn,"SELECT * FROM results WHERE resultsID = '$resultsID'");
	$ar = mysqli_fetch_array($add);
	// Delete selected row from two linked tables: results and work
	$wreckingcrew = mysqli_query($conn,"DELETE FROM results WHERE resultsID = '$resultsID'");
	$wreckingcrew1 = mysqli_query($conn,"DELETE FROM work WHERE workID = ".$ar["workID"]."");
	header('Location: main2.php');
?>