<!DOCTYPE html>
<html>
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>

      body 
      {
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f1f1f1;
        margin: 20px;
      }

      * 
      {
        box-sizing: border-box;
      }

      /* Add padding to containers */
      .container 
      {
        padding: 16px;
        background-color: white;
        border: solid 1px;
      }

    </style>

  </head>
  <body>

    <div class="container mt-3">
      <h2>Results and comment</h2>
      <form action="handler3.php" method="POST">   
        <table>
        <tr>
        <td>  
        <div class="form-group" style="width: 90%;">
          <label for="workID">WorkID:</label>
          <input type="number" class="form-control" name="workID" required>
        </div>
        </td>
        <td>
        <div class="form-group">
          <label for="fullname">Select student:</label>
          <select name="fullname" class="form-control">
          <?php
            include('connect.php');
            $myrow = mysqli_query($conn, "SELECT * FROM users WHERE user_status ='student'");
            while ($row = mysqli_fetch_array($myrow)) 
            {
              echo "<option>". $row['user_surname'], ' ', $row['user_name'] ."</option>";
            }
          ?>
          </select>
        </div>
        </td>
        </tr>
        </table>

        <table>
        <tr>
        <td>
        <div class="form-group" style="width: 90%;">
          <label for="grade">Number of points:</label>
          <input type="number" class="form-control" name="grade" required>
        </div>
        </td>
        <td>
        <div class="form-group" style="width: 90%;">
          <label for="maxgrade">Total score:</label>
          <input type="number" class="form-control" name="maxgrade" required>
        </td>
        </tr>
        </table>

        <div class="form-group" style="width: 50%;">
          <label for="comment">Comment:</label>
          <textarea class="form-control" rows="5" name="comment" required></textarea>
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>

  </body>
</html>