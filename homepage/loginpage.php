<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Homepage</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

  <style type="text/css">

  html,body{
    height: 100%;
    margin: 0;
    overflow: hidden;
  }

  select{
    text-align-last:center;
    padding-right: 29px;
    direction: ltr;
  }

  .bg {
    /* The image used */
    background-image: url("uniten.png");

    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
  }

  .container-fluid{
    height: 100%;
  }

  .span12{
    text-align: center;

  }

  </style>
  <script>
      $(document).ready(function() {

    $('#user_type').change(function() {
      if( $(this).val() == "parent") {
            $('#password').hide();
      } else {
        $('#password').show();
      }
    });

    });
  </script>
</head>

<body class="bg">

  <BR><BR>
    <div class="row">
      <div class="col-md-4 offset-md-4">

        <div class="p-3 mb-2 bg-light text-dark rounded">
          <div class="container-fluid">
            <form id="loginform" name="loginform"  action="../homepage/login.php" method="post">
              <center><h1><span>Welcome to<BR>Hafazan Monitoring<BR>System</span></h1>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <select class="custom-select col-md-12" name="user_type" id="user_type" required>

                      <?php
                      if (ISSET($_POST['role'])){
                        $role = $_POST['role'];
                        if ($role == 'student'){
                          echo "<option value='student' selected>Student</option>";
                          echo "<option value='lecturer'>Lecturer</option>";
                          echo "<option value='parent'>Parent</option>";
                        }
                        elseif ($role == 'lecturer') {
                          echo "<option value='student'>Student</option>";
                          echo "<option value='lecturer' selected>Lecturer</option>";
                          echo "<option value='parent'>Parent</option>";
                        }
                        elseif ($role == 'parent') {
                          echo "<option value='student'>Student</option>";
                          echo "<option value='lecturer'>Lecturer</option>";
                          echo "<option value='parent' selected>Parent</option>";
                        }

                      }

                      else {
                        echo "<option value=''>Choose Role</option>";
                        echo "<option value='student'>Student</option>";
                        echo "<option value='lecturer'>Lecturer</option>";
                        echo "<option value='parent'>Parent</option>";
                      }
                       ?>

                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                      <input type="text" name="username" class="form-control" id="username" placeholder="Username" maxlength="14">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-light btn-sm btn-block border-dark" name="button" id="button">Submit</button>
                  </div>
                  <div class="form-group col-md-6">
                    <button type="reset" class="btn btn-light btn-sm ml-0 btn-block border-dark" name="button" id="button">Clear</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>

    </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </html>
