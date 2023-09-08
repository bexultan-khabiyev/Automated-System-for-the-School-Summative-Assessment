<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php
			// Database connection
			include ("connect.php");

			// Transfer data from the form and define variables for it
			$user_fullname = $_POST["fullname"];
			// This SQL statement looks for users with a full name similar to the full name obtained from the form
			$searchfullname = mysqli_query($conn, "SELECT userID FROM users WHERE '$user_fullname' = CONCAT(user_surname, ' ', user_name)");
			$myrow = mysqli_fetch_array($searchfullname);
			// If there is a user ID, where his full name matches the full name entered by the user, then the program will continue executing the algorithm
			if (!empty($myrow['userID']))
			{
				// Transfer data from the form and define variables for it
				$resultsID = $_POST["resultsID"];
				$userID = $myrow["userID"];
                $workID = $_POST["workID"];
                $results_grade = $_POST["grade"];
                $results_maxgrade = $_POST["maxgrade"];
                $results_comment = $_POST["comment"];

                // These conditions check the length of the entered data. If the number of characters doesn't fill in the allowed range, then the program will generate an error
                if (strlen($results_grade) > 3)
				{
					print '<div class="alert alert-danger"><strong>Your number of points is more than the three-digit number!</strong> You should <a href="evaluate.php" class="alert-link">try again</a>.</div>';
					exit();
				}
				elseif (strlen($results_maxgrade) > 3)
				{
					print '<div class="alert alert-danger"><strong>Your total score is more than the three-digit number!</strong> You should <a href="evaluate.php" class="alert-link">try again</a>.</div>';
					exit();
				}
				elseif (strlen($results_comment) > 250)
				{
					print '<div class="alert alert-danger"><strong>Your comment is longer than 250 characters!</strong> You should <a href="evaluate.php" class="alert-link">try again</a>.</div>';
					exit();
				}

                // This SQL statement looks for the work of a specific student that the teacher intends to grade
                $query = mysqli_query($conn, "SELECT * FROM work WHERE work_check = 0 AND '$userID' = userID");
                $ar = mysqli_fetch_array($query);
                // If the teacher assigned the wrong workID to the student, then the program will give an error. This condition is necessary to prevent the situation when the teacher evaluated a non-existent document or a document that belongs to another student
                if ($workID == $ar["workID"])
                {
					$searchworkID = mysqli_query($conn, "SELECT * FROM results WHERE resultsID = '$resultsID'");
					$ar1 = mysqli_fetch_array($searchworkID);
					// This condition checks if the teacher wants to change the assessment results for a particular student or assign the assessment results to another student. This is necessary in case when the teacher initially wrote the workID and the name of the wrong student when evaluating the work
					if ($workID == $ar1["workID"])
					{
						// Replacing the data that is in the table "results" with the data entered by the teacher
						$add = "UPDATE results SET userID = '$userID', workID = '$workID', results_grade = '$results_grade', results_maxgrade = '$results_maxgrade', results_comment = '$results_comment' WHERE resultsID = '$resultsID'";
					}
					else
					{
						// This line marks the work, which is replaced by another, as unassessed, so that the teacher can check it in the future
						$add0 = mysqli_query($conn,"UPDATE work SET work_check = 0 WHERE workID = ".$ar1["workID"]."");
						// Replacing the data that is in the table "results" with the data entered by the teacher
						$add = "UPDATE results SET userID = '$userID', workID = '$workID', results_grade = '$results_grade', results_maxgrade = '$results_maxgrade', results_comment = '$results_comment' WHERE resultsID = '$resultsID'";
						// This line marks new work as reviewed
						$add1 = mysqli_query($conn,"UPDATE work SET work_check = 1 WHERE workID = '$workID'");
					}

					// This condition checks if the user data was inserted successfully
					if (mysqli_query($conn, $add)) 
					{
						print '<div class="alert alert-success"><strong>This row was successfully edited!</strong> Go back to <a href="main2.php" class="alert-link">home page</a>.</div>';
					} 
					else 
					{
						print '<div class="alert alert-danger"><strong>Error!</strong> You should <a href="main1.php" class="alert-link">try again</a>.</div>';
						exit();
					} 
                }
                else
                {
                    print '<div class="alert alert-danger"><strong>Error!</strong> You have written a wrong full name or workID! You should <a href="main1.php" class="alert-link">try again</a>.</div>';
                    exit();
                }
            }
		?>
	</body>
</html>