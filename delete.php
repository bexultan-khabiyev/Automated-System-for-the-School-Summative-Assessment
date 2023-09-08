<!DOCTYPE html>
<html>
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Example</title>
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

    <div class="container mt-3" style="width: 10%; text-align: center">
      <h2>Delete row</h2>
      <form action="deletehandler.php" method="POST">

        <div class="form-group">
          <label for="workID">ResultsID:</label>
          <input type="number" class="form-control" name="resultsID" required>
        </div>
      
        <div class="mt-3">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>
    </div>

  </body>
</html>