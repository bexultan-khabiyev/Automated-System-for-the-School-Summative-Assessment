<!DOCTYPE html>
<html>
  <head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

      body 
      {
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f1f1f1;
        border: solid 1px;
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
      }

      /* Full-width input fields */
      input[type=text], input[type=password] 
      {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
      }

      input[type=text]:focus, input[type=password]:focus 
      {
        background-color: #ddd;
        outline: none;
      }

      /* Overwrite default styles of hr */
      hr 
      {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
      }

      /* Set a style for the submit button */
      .registerbtn 
      {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
      }

      .registerbtn:hover 
      {
        opacity: 1;
      }

      /* Add a blue text color to links */
      a 
      {
        color: dodgerblue;
      }

      /* Set a grey background color and center the text of the "sign in" section */
      .signin 
      {
        background-color: white;
        text-align: center;
      }

      /*the container must be positioned relative:*/
      .custom-select 
      {
        position: relative;
        font-family: Arial;
      }

      .custom-select select 
      {
        display: none; /*hide original SELECT element:*/
      }

      .select-selected 
      {
        background-color: DodgerBlue;
      }

      /*style the arrow inside the select element:*/
      .select-selected:after 
      {
        position: absolute;
        content: "";
        top: 14px;
        right: 10px;
        width: 0;
        height: 0;
        border: 6px solid transparent;
        border-color: #fff transparent transparent transparent;
      }

      /*point the arrow upwards when the select box is open (active):*/
      .select-selected.select-arrow-active:after 
      {
        border-color: transparent transparent #fff transparent;
        top: 7px;
      }

      /*style the items (options), including the selected item:*/
      .select-items div,.select-selected 
      {
        color: #ffffff;
        padding: 8px 16px;
        border: 1px solid transparent;
        border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
        cursor: pointer;
        user-select: none;
      }

      /*style items (options):*/
      .select-items 
      {
        position: absolute;
        background-color: DodgerBlue;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 99;
      }

      /*hide the items when the select box is closed:*/
      .select-hide 
      {
        display: none;
      }

      .select-items div:hover, .same-as-selected 
      {
        background-color: rgba(0, 0, 0, 0.1);
      }

    </style>
  </head>
  <body>

    <form action ="handler.php" method ="POST">
      
      <div class="container">

        <h1 align="center">Registration</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" required>

        <label for="surname"><b>Surname</b></label>
        <input type="text" placeholder="Enter Surname" name="surname" required>

        <label for="login"><b>Login</b></label>
        <input type="text" placeholder="Enter Login" name="login" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="psw" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>

        <label for="class"><b>Class</b></label>
        <br>
        <input type="text" style="width: 150px;" placeholder="Enter Class" name="class" id="class">

        <div class="custom-select" style="width: 150px;">
        <label for="status"><b>Status</b></label>
        <select name="status">
        <option value="0">Selected status:</option>
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>
        </select>
        </div>
        <hr>

        <button type="submit" class="registerbtn">Register</button>
        <button type="reset" class="registerbtn">Reset</button>

      </div>
    
      <div class="container signin">
          <p>Already have an account? <a href="login.php">Log in</a>.</p>
      </div>

    </form>

    <script>
      var x, i, j, l, ll, selElmnt, a, b, c;
      /*look for any elements with the class "custom-select":*/
      x = document.getElementsByClassName("custom-select");
      l = x.length;
      for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {
          /*for each option in the original select element,
          create a new DIV that will act as an option item:*/
          c = document.createElement("DIV");
          c.innerHTML = selElmnt.options[j].innerHTML;
          c.addEventListener("click", function(e) {
              /*when an item is clicked, update the original select box,
              and the selected item:*/
              var y, i, k, s, h, sl, yl;
              s = this.parentNode.parentNode.getElementsByTagName("select")[0];
              sl = s.length;
              h = this.parentNode.previousSibling;
              for (i = 0; i < sl; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                  s.selectedIndex = i;
                  h.innerHTML = this.innerHTML;
                  y = this.parentNode.getElementsByClassName("same-as-selected");
                  yl = y.length;
                  for (k = 0; k < yl; k++) {
                    y[k].removeAttribute("class");
                  }
                  this.setAttribute("class", "same-as-selected");
                  break;
                }
              }
              h.click();
          });
          b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
          });
      }
      function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        var x, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        xl = x.length;
        yl = y.length;
        for (i = 0; i < yl; i++) {
          if (elmnt == y[i]) {
            arrNo.push(i)
          } else {
            y[i].classList.remove("select-arrow-active");
          }
        }
        for (i = 0; i < xl; i++) {
          if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
          }
        }
      }
      /*if the user clicks anywhere outside the select box,
      then close all select boxes:*/
      document.addEventListener("click", closeAllSelect);
    </script>

  </body>
</html>
