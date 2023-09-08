<?php
	// Database connection
	include('connect.php');
	// Setting variables for user data stored in the session
	$user_status = $_SESSION['data']['user_status'];
	$userID = $_SESSION['data']['userID'];
	// These conditions check the status of the current user. This is necessary so that the student cannot see the work of other students. Only a user with the status "teacher" has access to all files
	if ($user_status == 'teacher')
	{
		// This request contains data intended for teacher
		$myrow = mysqli_query($conn, "SELECT *, users.user_surname, users.user_class, users.user_name, work.work_name FROM results LEFT JOIN users ON results.userID = users.userID LEFT JOIN work ON results.workID = work.workID ORDER BY results.resultsID"); 
		echo '<table class="table table-hover">';
		echo '<thead><tr><th>ResultsID</th><th>Full name</th><th>Class</th><th>Work name</th><th>Grade</th><th>Maximum grade</th><th>Comment</th></tr></thead>';
		echo '<tbody>';
		// These loops displays all records that contain the data specified in mysqli request. The loops run as long as there is data to be output in the variable. They allow programmist to shorten and automate the program code, thus there is no need to regularly enter each row of the table
		while($row = mysqli_fetch_array($myrow))
		{
			echo '<tr>';
			echo '<td>'. $row['resultsID'] .'</td>';
			echo '<td>'. $row['user_surname'], ' ', $row['user_name'] .'</td>';
			echo '<td>'. $row['user_class'] .'</td>';
			echo '<td>'. $row['work_name'] .'</td>';
			echo '<td>'. $row['results_grade'] .'</td>';
			echo '<td>'. $row['results_maxgrade'] .'</td>';
			echo '<td>'. $row['results_comment'] .'</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
	}
	elseif ($user_status == 'student') 
	{
		// This request contains data intended only for a specific user
		$myrow1 = mysqli_query($conn, "SELECT *, work.work_name FROM results LEFT JOIN work ON results.workID = work.workID WHERE results.userID ='$userID'");
		echo '<table class="table table-hover">';
		echo '<thead><tr><th>ResultsID</th><th>Work name</th><th>Grade</th><th>Maximum grade</th><th>Comment</th></tr></thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_array($myrow1))
		{
			echo '<tr>';
			echo '<td>'. $row['resultsID'] .'</td>';
			echo '<td>'. $row['work_name'] .'</td>';
			echo '<td>'. $row['results_grade'] .'</td>';
			echo '<td>'. $row['results_maxgrade'] .'</td>';
			echo '<td>'. $row['results_comment'] .'</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
	}
?>