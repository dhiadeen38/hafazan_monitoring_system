<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Generate record</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/sidebar.css">
  <style>
  table {
    border-spacing: 0;
  }

  th {
    cursor: pointer;
  }
  </style>
  <script type="text/javascript" src="../script/sort.js"></script>
  <script type="text/javascript" src="../script/print.js"></script>
  <script type="text/javascript" src="../jquery.tablesorter/jquery-latest.js"></script>
<script type="text/javascript" src="../jquery.tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // call the tablesorter plugin
    $("table").tablesorter({
        // sort on the first column and third column, order asc
        sortList: [[0,0],[2,0]]
    });
});
</script>
</head>

<body>

  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Admin</a></li>
        <li><a href="createuser.php"><i class="fa fa-users"></i> Dashboard</a></li>
        <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><i class="fa fa-list-alt"></i> Generate record</a>
          <ul class="sidebar-nav" id="submenu1" role="menu" aria-labelledby="btn-1">
            <li style="text-indent: 30px"><a style="background: yellow; color:#522184"href="overview.php"><i class="fa fa-file-o"></i> Overview</a></li>
            <li style="text-indent: 30px"><a href="generaterecord.php"><i class="fa fa-search"></i> Search</a></li>
            <li style="text-indent: 30px"><a href="allrecords.php"><i class="fa fa-th-list"></i> All Records</a></li>

          </ul>
        </li>
        <li><a href="changepwdadmin.php"><i class="fa fa-refresh"></i> Change password</a></li>
        <li><a href="../homepage/logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
      </ul>
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
          <div class="row">
            <div class="col-lg-12">

                  <div class="container-fluid">

                    <table id="myTable" class="tablesorter">
<thead>
<tr>
    <th>Last Name</th>
    <th>First Name</th>
    <th>Email</th>
    <th>Due</th>
    <th>Web Site</th>
</tr>
</thead>
<tbody>
<tr>
    <td>Smith</td>
    <td>John</td>
    <td>jsmith@gmail.com</td>
    <td>$50.00</td>
    <td>http://www.jsmith.com</td>
</tr>
<tr>
    <td>Bach</td>
    <td>Frank</td>
    <td>fbach@yahoo.com</td>
    <td>$50.00</td>
    <td>http://www.frank.com</td>
</tr>
<tr>
    <td>Doe</td>
    <td>Jason</td>
    <td>jdoe@hotmail.com</td>
    <td>$100.00</td>
    <td>http://www.jdoe.com</td>
</tr>
<tr>
    <td>Conway</td>
    <td>Tim</td>
    <td>tconway@earthlink.net</td>
    <td>$50.00</td>
    <td>http://www.timconway.com</td>
</tr>
</tbody>
</table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        </html>
