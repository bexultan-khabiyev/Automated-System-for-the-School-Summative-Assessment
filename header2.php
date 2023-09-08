<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      body 
      {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
      }

      .topnav 
      {
        overflow: hidden;
        background-color: #333;
      }

      .topnav a 
      {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
      }

      .topnav a:hover 
      {
        background-color: #ddd;
        color: black;
      }

      .topnav a.active 
      {
        background-color: #9ACD32;
        color: #f2f2f2;
      }

      .topnav-right 
      {
        float: right;
      }
    </style>
  </head>
  <body>

    <div class="header">
        <img src="https://testconf.nis.edu.kz/wp-content/uploads/2017/01/2-NIS.png" class="logo" alt="logo">
        <h1 style="font-family: 'Abril Fatface', cursive;">
          <?php 
            session_start();
            if (!empty($_SESSION['data']['user_login'])) 
            { 
              $user_name = $_SESSION['data']['user_name']; 
              echo "$user_name, welcome to my website!";
            }
            else 
            {
              echo "Welcome to my website!";
            }
          ?>
          </h1>
    </div>

    <div class="topnav">
      <a href="index.php">Home</a>
      <a href="main1.php">Student work</a>
      <a class="active"  href="main2.php">Results and comments</a>
      <div class="topnav-right">
        <?php
          if (!empty($_SESSION['data']['user_login']))
          {
            echo '<a href="logout.php">Log out</a>';
          }
          else 
          {
            echo '<a href="login.php">Log in</a>';
            echo '<a href="signup.php">Register</a>';
          }
        ?>
      </div>
    </div>
  </body>
</html>
