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
			// Creating a session to store data that will be used on several pages of the site
			session_start();
			// Transfer data from the form and define variables for it
			$userID = $_SESSION['data']['userID'];
			$name = $_FILES['file']['name'];
			$tmp_name = $_FILES['file']['tmp_name'];
			$submitbutton = $_POST['submit'];
			$position = strpos($name, "."); 
			$fileextension= substr($name, $position + 1);
			$fileextension= strtolower($fileextension);

			// If a file name exists, then the path is set for it
			if (isset($name)) 
			{
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
						print '<div class="alert alert-danger"><strong>Error!</strong> You should <a href="work.php" class="alert-link">try again</a>.</div>';
						exit();
					}
				}
				else 
				{
					print '<div class="alert alert-danger"><strong>You have not uploaded your file!</strong> You should <a href="work.php" class="alert-link">try again</a>.</div>';
					exit();
				}
			}
			// Database connection
			include('connect.php');
			// Insertion of the data entered by the user into one of the database tables
			$myrow = mysqli_query($conn, "INSERT INTO work (userID, work_name) VALUES ('$userID', '$name')");
			mysqli_close($conn);
		?>
	</body>
</html>