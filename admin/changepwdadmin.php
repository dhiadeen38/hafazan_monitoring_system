<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Change password</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/sidebar.css">
</head>

<body>

  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Admin</a></li>
        <li><a href="createuser.php"><i class="fa fa-users"></i> Dashboard</a></li>
        <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><i class="fa fa-list-alt"></i> Generate record</a>
			       <ul class="sidebar-nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
				           <li style="text-indent: 30px"><a href="generaterecord.php"><i class="fa fa-book"></i> Hafazan</a></li>
                   <li style="text-indent: 30px"><a href="allrecords.php"><i class="fa fa-th-list"></i> All Records</a></li>

			       </ul>
		    </li>
        <li><a style="background: yellow; color:#522184" href="changepwdadmin.php"><i class="fa fa-refresh"></i> Change password</a></li>
        <li><a href="#logOutWindow" data-toggle="modal"><i class="fa fa-sign-out"></i> Logout</a></li>
      </ul>
    </div>
    <div class="modal fade" id="logOutWindow">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- body (form) -->
          <div class="modal-body">
            <div class="alert alert-primary"><p>Proceed logging out?</p></div>

            </div>

            <!-- button -->
            <div class="modal-footer">
              <a href="../homepage/logout.php" class="btn btn-primary btn-block"><i class="fa fa-check"></i></a>
              <button type="button" class="btn btn-light btn-block" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </form>
          </div>

        </div>
      </div>
    </div>

<!--Content header-->
<div id="page-content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 text-white">
        Assalamualaikum w.b.t
        </div>
        <div class="col-lg-3 text-white d-flex justify-content-end">
          <?php echo date("l ").'/'.date(" d-m-Y");?>
          </div>
      </div>
    </div>
  </div>

    <!-- Page content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <?php
        session_start();
        if (ISSET($_SESSION['message'])&& $_SESSION['message'] !=''){
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        }
         ?>
        <div class="card row">
          <div class="card-body col-lg-12">

            <form action="changingpwdadmin.php" method="post">
              <div class="form-group row">
                <label for="currPassword" class="col-sm-2 col-form-label">Current Password</label>
                <div class="col-sm-3">
                  <input type="password" name="curr_pwd" class="form-control" id="currPassword" placeholder="Password" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-3">
                  <input type="password" name="new_pwd" class="form-control" id="newPassword" placeholder="Password" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="newPassword2" class="col-sm-2 col-form-label">Re-type Password</label>
                <div class="col-sm-3">
                  <input type="password" name="new_pwd2" class="form-control" id="newPassword2" placeholder="Password" required>
                </div>
              </div>

            <input type="submit" class="btn btn-light btn-sm" name="button" id="button" value="Submit">

          	</form>
            </div>
          </div>
        </div>
      </div>

    </div>

</body>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </html>
