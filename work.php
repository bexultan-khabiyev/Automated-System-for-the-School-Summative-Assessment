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

    <div class="container mt-3">
      <h2>Post work</h2>
      <form enctype="multipart/form-data" action="handler2.php" method="POST">
        <p>Custom file:</p>

        <div class="custom-file mb-3">
          <input type="file" class="custom-file-input" name="file">
          <label class="custom-file-label" for="file">Choose file</label>
        </div>
      
        <div class="mt-3">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>
    </div>

    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>

  </body>
</html>