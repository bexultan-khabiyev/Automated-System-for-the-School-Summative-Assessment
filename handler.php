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
			$user_name = $_POST["name"];
			$user_surname = $_POST["surname"];
			$user_login = $_POST["login"];
			$user_password = $_POST["password"];
			$user_class = $_POST["class"];
			$user_status = $_POST["status"];
			$psw_repeat = $_POST["psw-repeat"];

			// This condition check for the presence of data. If the user left the input field blank, the program will generate an error
			if (empty($user_status))
			{
				print '<div class="alert alert-danger"><strong>You must enter your status!</strong> You should <a href="signup.php" class="alert-link">try again</a>.</div>';
				exit();
			}
			// These conditions check the length of the entered data. If the number of characters doesn't fill in the allowed interval, then the program will generate an error
			elseif (strlen($user_name) > 30 OR strlen($user_name) < 2)
			{

				print '<div class="alert alert-danger"><strong>Your name is longer than 30 characters or shorter than 2 characters!</strong> You should <a href="signup.php" class="alert-link">try again</a>.</div>';
				exit();
			}
			elseif (strlen($user_surname) > 30 OR strlen($user_surname) < 2)
			{
				print '<div class="alert alert-danger"><strong>Your surname is longer than 30 characters or shorter than 2 characters!</strong> You should <a href="signup.php" class="alert-link">try again</a>.</div>';
				exit();
			}
			elseif (strlen($user_login) > 30 OR strlen($user_login) < 8)
			{
				print '<div class="alert alert-danger"><strong>Your login is longer than 30 characters or shorter than 8 characters!</strong> You should <a href="signup.php" class="alert-link">try again</a>.</div>';
				exit();
			}
			elseif (strlen($user_password) > 30 OR strlen($user_password) < 8)
			{	
				print '<div class="alert alert-danger"><strong>Your password is longer than 30 characters or shorter than 8 characters!</strong> You should <a href="signup.php" class="alert-link">try again</a>.</div>';
				exit();
			}
			elseif ($user_status == 'student')
			{
				if (!empty($user_class))
				{
					if (strlen($user_class) > 3)
					{

						print '<div class="alert alert-danger"><strong>Your class name is longer than 3 characters!</strong> You should <a href="signup.php" class="alert-link">try again</a>.</div>';
						exit();
					}
				}
				else
				{
					print '<div class="alert alert-danger"><strong>You must enter your class name!</strong> You should <a href="signup.php" class="alert-link">try again</a>.</div>';
					exit();
				}
			}
			
			// Database connection
			include ("connect.php");

			// Presented code searches in database for an ID whose login matches the login from the form	
			$searchlogin = mysqli_query($conn, "SELECT userID FROM users WHERE user_login = '$user_login'");
			$myrow = mysqli_fetch_array($searchlogin);

			// If there is a user with the same login, then the program will give an error. This is necessary to check the uniqueness of the login
			if (!empty($myrow['userID'])) 
			{
				print '<div class="alert alert-danger"><strong>Your login already exists!</strong> You should <a href="signup.php" class="alert-link">try again</a>.</div>';
				exit();
			}
			// If the user incorrectly repeated his own password, the program will generate an error. This condition eliminates the possibility that the user's password was initially entered incorrectly
			elseif ($user_password !== $psw_repeat) 
			{	
				print '<div class="alert alert-danger"><strong>Passwords do not match!</strong> You should <a href="signup.php" class="alert-link">try again</a>.</div>';
				exit(); 
			}
			
			// Insertion of the data entered by the user into one of the database tables
			$add = "INSERT INTO users (user_name, user_surname, user_login, user_password, user_class, user_status) VALUES ('$user_name', '$user_surname', '$user_login', '$user_password', '$user_class', '$user_status')";

			set_time_limit(0);

			// This condition checks if the user data was inserted successfully
			if (mysqli_query($conn, $add)) 
			{	
				// We select a record from the database in which the login is equal to the login entered by the user
				$query = mysqli_query($conn,"SELECT * FROM users WHERE user_login ='$user_login'");
                $data = mysqli_fetch_assoc($query);
                // This array is needed to store user data while he is on the site
				$_SESSION['data'] =
				[
					"userID" => $data['userID'],
                    "user_name" => $data['user_name'],
                    "user_surname" => $data['user_surname'],
                    "user_login" => $data['user_login'],
                    "user_class" => $data['user_class'],
                    "user_status" => $data['user_status']
				];
		    	print '<div class="alert alert-success"><strong>You have successfully registered!</strong> Go to <a href="index.php" class="alert-link">home page</a>.</div>';
			} 
			else 
			{
		    	print '<div class="alert alert-danger"><strong>Error!</strong> You should <a href="signup.php" class="alert-link">try again</a>.</div>';
				exit();
			}
		?>
	</body>
</html>
