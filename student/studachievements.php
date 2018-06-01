<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Achievements</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/sidebar.css">
</head>

<body>

  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Student</a></li>
        <li><a href="studbiodata.php"><i class="fa fa-user"></i> Biodata</a></li>
        <li><a href="studrecord.php"><i class="fa fa-bar-chart"></i> Performance Record</a></li>
        <li><a style="background: yellow; color:#522184" href="studachievements.php"><i class="fa fa-graduation-cap"></i> Achievements</a></li>
        <li><a href="changepwdstud.php"><i class="fa fa-refresh"></i> Change password</a></li>
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
<div id="page-content-header" class="sticky-top">
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
        <div class="card row">
          <div class="card-body col-lg-12">

            <table class="table table-striped table-bordered col-lg-12">
              <thead>
              <tr align="center">
                <th>No</th>
                <th>Event</th>
                <th>Achievements</th>
              </tr>
            </thead>
              <tbody>
              <tr align="left">
                <td align="center">1</td>
                <td>Regional Hafazan Competition</td>
                <td align="center">Gold Medal</td>
              </tr>
            </tbody>
            </table>

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
