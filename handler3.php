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
					$workID = $_POST["workID"];
					// Insertion of the data entered by the user into one of the database tables
					$add = "INSERT INTO results (userID, workID, results_grade, results_maxgrade, results_comment) VALUES ('$userID', '$workID', '$results_grade', '$results_maxgrade', '$results_comment')";
					// Change the work_check value to 1 to indicate that the student's work has been graded and does not need to be displayed for grading
					$add1 = mysqli_query($conn,"UPDATE work SET work_check = 1 WHERE workID = '$workID'");
					// This condition checks if the user data was inserted successfully
					if (mysqli_query($conn, $add)) 
					{
						print '<div class="alert alert-success"><strong>This work has been evaluated successfully!</strong> Go back to <a href="main2.php" class="alert-link">home page</a>.</div>';
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