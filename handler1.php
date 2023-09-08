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
            // Database connection
            include('connect.php');

            if (isset($_POST['submit'])) 
            {   
                // Transfer data from the form and define variables for it
                $user_login = $_POST['login'];
                $user_password = $_POST['password'];

                // We select a record from the database in which the login is equal to the login entered by the user
                $query = mysqli_query($conn,"SELECT * FROM users WHERE user_login='$user_login'");
                $data = mysqli_fetch_assoc($query);
                // 
                if (!empty($data['userID']))
                {
                    // This array is needed to store user data while he is on the site
                    $_SESSION['data'] = 
                    [
                        "userID" => $data['userID'],
                        "user_name" => $data['user_name'],
                        "user_surname" => $data['user_surname'],
                        "user_login" => $data['user_login'],
                        "user_status" => $data['user_status'],
                    ];

                    // The condition compares the password from the database and the password entered by the user. If the passwords do not match, then the programs will give an error
                    if($data['user_password'] === ($_POST['password']))
                    {   
                        print '<div class="alert alert-success"><strong>You have successfully entered!</strong> Go to <a href="index.php" class="alert-link">home page</a>.</div>';
                    }
                    else
                    {
                        print '<div class="alert alert-danger"><strong>Your login or password was entered incorrectly!</strong> You should <a href="login.php" class="alert-link">try again</a>.</div>';
                        exit();
                    }
                }
                else 
                {
                    print '<div class="alert alert-danger"><strong>Your login or password was entered incorrectly!</strong> You should <a href="login.php" class="alert-link">try again</a>.</div>';
                    exit(); 
                }    
            }
        ?>
    </body>
</html>