<?php
	// Database connection
	include('connect.php');
	// We set the path to the file as a variable to shorten the length of the program code
	$currentfile = 'http://localhost/info/files/';
	// Setting variables for user data stored in the session
	$user_status = $_SESSION['data']['user_status'];
	$userID = $_SESSION['data']['userID'];

	// These conditions check the status of the current user. This is necessary so that the student cannot see the work of other students. Only a user with the status "teacher" has access to all files
	if ($user_status == 'teacher')
	{	
		// This request contains the data of the work that the teacher uploaded
		$search = mysqli_query($conn, "SELECT userID FROM users WHERE user_status = 'teacher'");
		$userID1 = mysqli_fetch_array($search);
		$myrow1 = mysqli_query($conn, "SELECT * FROM work WHERE work_check = 0 AND userID = ".$userID1["userID"]."");
		// These loops form a table that contains the files that the teacher has uploaded. This is done so that the student can quickly find the assignment
		echo '<h2 align="center">Assignments</h2>';
		echo '<table class="table table-hover">';
		echo '<thead><tr><th>WorkID</th><th>UserID</th><th>Work name</th><th>Work path</th></tr></thead>';
		echo '<tbody>';
		// These loops display all records that contain the data specified in mysqli request. The loops run as long as there is data to be output in the variable. They allow programmist to shorten and automate the program code, since there is no need to regularly enter each row of the table
		while($row = mysqli_fetch_array($myrow1))
		{
			echo '<tr>';
			echo '<td>'. $row['workID'] .'</td>';
			echo '<td>'. $row['userID'] .'</td>';
			echo '<td><a href="'. $currentfile.$row['work_name'] .'">Download '.$row['work_name'].'</a></td>';
			echo '<td>'. $currentfile.$row['work_name'] .'</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
		echo '<br>'; 
		// This request contains data intended for teacher. The request includes only works without grades
		$myrow = mysqli_query($conn, "SELECT *, users.user_name, users.user_surname, users.user_class FROM work LEFT JOIN users ON work.userID = users.userID WHERE work_check = 0 AND work.userID != ".$userID1["userID"]."");
		echo '<h2 align="center">Student work</h2>';
		echo '<table class="table table-hover">';
		echo '<thead><tr><th>WorkID</th><th>Full name</th><th>Class</th><th>Work name</th><th>Work path</th></tr></thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_array($myrow))
		{
			echo '<tr>';
			echo '<td>'. $row['workID'] .'</td>';
			echo '<td>'. $row['user_surname'], ' ', $row['user_name'] .'</td>';
			echo '<td>'. $row['user_class'] .'</td>';
			echo '<td><a href="'. $currentfile.$row['work_name'] .'">Download '.$row['work_name'].'</a></td>';
			echo '<td>'. $currentfile.$row['work_name'] .'</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
	}
	elseif ($user_status == 'student') 
	{
		$search = mysqli_query($conn, "SELECT userID FROM users WHERE user_status = 'teacher'");
		$userID1 = mysqli_fetch_array($search);
		$myrow = mysqli_query($conn, "SELECT * FROM work WHERE work_check = 0 AND userID = ".$userID1["userID"]."");
		echo '<h2 align="center">Assignments</h2>';
		echo '<table class="table table-hover">';
		echo '<thead><tr><th>WorkID</th><th>UserID</th><th>Work name</th><th>Work path</th></tr></thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_array($myrow))
		{
			echo '<tr>';
			echo '<td>'. $row['workID'] .'</td>';
			echo '<td>'. $row['userID'] .'</td>';
			echo '<td><a href="'. $currentfile.$row['work_name'] .'">Download '.$row['work_name'].'</a></td>';
			echo '<td>'. $currentfile.$row['work_name'] .'</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
		echo '<br>';
		// This request contains data intended only for a specific user. The request includes only works without grades
		$myrow1 = mysqli_query($conn, "SELECT * FROM work WHERE work_check = 0 AND userID = '$userID'");
		echo '<h2 align="center">Student work</h2>';
		echo '<table class="table table-hover">';
		echo '<thead><tr><th>WorkID</th><th>UserID</th><th>Work name</th><th>Work path</th></tr></thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_array($myrow1))
		{
			echo '<tr>';
			echo '<td>'. $row['workID'] .'</td>';
			echo '<td>'. $row['userID'] .'</td>';
			echo '<td><a href="'. $currentfile.$row['work_name'] .'">Download '.$row['work_name'].'</a></td>';
			echo '<td>'. $currentfile.$row['work_name'] .'</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
	}
?>