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
      include('header1.php') 
    ?>

    <div style="padding: 30px;height: 1000px; background-color: white; font-family: 'Poppins', sans-serif;">
      <?php
        if (!empty($_SESSION['data']['user_login'])) 
        {
          echo '<h2 style="text-align: center">Upload your work here!</h2>';
          echo '<br>';
          echo '<div align="right">';       
          include('connect.php');
          $user_status = $_SESSION['data']['user_status'];
          if ($user_status == 'teacher') 
          { 
            echo '<table>';
            echo '<tr>';
            echo '<td>';
            echo '<a href="work.php" class="btn btn-info" role="button" style="float: right">Upload work</a>';
            echo '</td>';
            echo '<td>';
            echo '<a href="edit.php" class="btn btn-info" role="button" style="float: right">Edit work</a>';
            echo '</td>';
            echo '<td>';
            echo '<a href="evaluate.php" class="btn btn-info" role="button" style="float: right">Evaluate work</a>';
            echo '</td>';
            echo '</tr>';
            echo '</table>';
          }
          else 
          { 
            echo '<table>';
            echo '<tr>';
            echo '<td>';
            echo '<a href="work.php" class="btn btn-info" role="button" style="float: right">Upload work</a>';
            echo '</td>';
            echo '<td>';
            echo '<a href="edit.php" class="btn btn-info" role="button" style="float: right">Edit work</a>';
            echo '</td>';
            echo '</tr>';
            echo '</table>';  
          }
          echo '</div>';
        }
        else 
        {
          echo '<div class="alert alert-warning" align="center"><strong>Warning!</strong> You must log in first!</div>';
        }
        echo '<br>';
        echo '<hr>';
        echo '<br>';
        include('handlermain1.php');
      ?>
    </div>

    <div style ="padding: 20px; text-align: center; background: white; margin-top: 20px;">
      <h3>Coded by Bexultan Khabiyev, 2021</h3>
    </div>

  </body>
</html>
