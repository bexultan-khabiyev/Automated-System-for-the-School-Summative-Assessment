<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css"/>
  </head>
  <body>
	<?php
		// Database connection
		include('connect.php');
		// Creating a session to store data that will be used on several pages of the site
		session_start();
		// Transfer data from the form and define variables for it
		$userID = $_SESSION['data']['userID'];
		$workID = $_POST['workID'];
		$name = $_FILES['file']['name'];
		$tmp_name = $_FILES['file']['tmp_name'];
		$submitbutton = $_POST['submit'];
		$position = strpos($name, "."); 
		$fileextension = substr($name, $position + 1);
		$fileextension = strtolower($fileextension);
		$add = mysqli_query($conn, "SELECT * FROM work WHERE userID = '$userID' AND work_check ='0'");
		while ($row = mysqli_fetch_array($add))
		{
			$ar[] = $row['workID'];
		}
		// This condition checks if the work that the user wants to edit belongs to the same user. If the user enters the ID of a work that was not uploaded by him, the program will notify him of this
		if (in_array($workID, $ar, FALSE))
		{
			// If a file name exists, then the path is set for it
			$path= 'files/';
			if (!empty($name))
			{	
				// Move the downloaded file to the location specified in the variable $path. If the file has been moved, a corresponding notification will be issued
				if (move_uploaded_file($tmp_name, $path.$name)) 
				{
					print '<div class="alert alert-success"><strong>Your file was successfully uploaded!</strong> Go back to <a href="main1.php" class="alert-link">home page</a>.</div>'; 
				}
				else
				{
					print '<div class="alert alert-danger"><strong>Error!</strong> You should <a href="edit.php" class="alert-link">try again</a>.</div>';
					exit();
				}
			}
			else 
			{
				print '<div class="alert alert-danger"><strong>You have not uploaded your file!</strong> You should <a href="edit.php" class="alert-link">try again</a>.</div>';
				exit();
			}
		}
		else
		{
			print '<div class="alert alert-danger"><strong>You are trying to edit another students work!</strong> You should <a href="edit.php" class="alert-link">try again</a>.</div>';
			exit();
		}
		// Insertion of the data entered by the user into one of the database tables
		$myrow = mysqli_query($conn, "UPDATE work SET work_name = '$name' WHERE workID = '$workID'");
		mysqli_close($conn);
	?>
  </body>
</html>