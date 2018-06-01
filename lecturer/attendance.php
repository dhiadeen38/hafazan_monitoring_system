<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Attendance</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
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
</head>

<body>
  <?php
  session_start();
  $id=$_SESSION["username"];
  $con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());


  $sql2="SELECT student.stud_name, student.page_memorized, programme.curr_syllabus
  FROM student
  INNER JOIN programme
  ON student.programme_id=programme.programme_id
  INNER JOIN halaqah
  ON student.halaqah_id=halaqah.halaqah_id
  WHERE halaqah.lect_id='$id'
  ORDER BY student.page_memorized DESC";
  $result2=mysqli_query($con,$sql2);

  $sql3="SELECT student.stud_name, student.stud_id, student.page_memorized, programme.curr_syllabus
  FROM student
  INNER JOIN programme
  ON student.programme_id=programme.programme_id
  INNER JOIN halaqah
  ON student.halaqah_id=halaqah.halaqah_id
  WHERE halaqah.lect_id='$id'
  ORDER BY student.page_memorized DESC";
  $result3=mysqli_query($con,$sql3);
  ?>
  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Lecturer</a></li>
        <li><a href="lectbiodata.php"><i class="fa fa-user"></i> Biodata</a></li>
        <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><i class="fa fa-spinner"></i> My Halaqah</a>
          <ul class="sidebar-nav" id="submenu1" role="menu" aria-labelledby="btn-1">
            <li style="text-indent: 30px"><a href="myhalaqah.php"><i class="fa fa-bar-chart"></i> Records</a></li>
            <li style="text-indent: 30px"><a style="background: yellow; color:#522184" href="attendance.php"><i class="fa fa-pencil"></i> Attendance</a></li>

          </ul>
        </li>
        <li><a href="changepwdlect.php"><i class="fa fa-refresh"></i> Change password</a></li>
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

            <?php

            $ddate = date("d-m-Y");
            $date = new DateTime($ddate);
            $week = $date->format("W");
            echo "<h3>"."Week: $week"."</h3>";
            ?>
            <div class="row">
            <div class="card col-lg-12">
            <div class="card-body">
            <table class="table table-striped table-bordered" id="myTable">

              <thead>
                <tr align="center">
                  <th scope="col">No</th>
                  <th class"w-50" scope="col" onclick="sortTable(1)">Name</th>
                  <th scope="col" onclick="sortTable(2)">Monday</th>
                  <th scope="col" onclick="sortTable(3)">Tuesday</th>
                  <th scope="col" onclick="sortTable(4)">Wednesday</th>
                  <th scope="col" onclick="sortTable(5)">Thursday</th>
                  <th scope="col" onclick="sortTable(6)">Friday</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=1;
                $loop=1;

                while($row=mysqli_fetch_array($result2)){

                  echo "<tr>";
                  echo "<th scope='row' align='center'>".$no."</th>";
                  echo "<td>".$row['stud_name']."</td>";

                  echo "<td>";
                  echo '<div class="block text-center">';
                  echo '<select class="custom-select-sm">';
                  echo  '<option value="-1" selected>Absented</option>';
                  echo  '<option value="0">Attended</option>';
                  echo  '<option value="0">Absented with Consent</option>';
                  echo  '<option value="0">No Classes</option>';
                  echo '</select>';
                  echo '</div>';
                  echo "</td>";

                  echo "<td>";
                  echo '<div class="block text-center">';
                  echo '<select class="custom-select-sm">';
                  echo  '<option value="-1" selected>Absented</option>';
                  echo  '<option value="0">Attended</option>';
                  echo  '<option value="0">Absented with Consent</option>';
                  echo  '<option value="0">No Classes</option>';
                  echo '</select>';
                  echo '</div>';
                  echo "</td>";

                  echo "<td>";
                  echo '<div class="block text-center">';
                  echo '<select class="custom-select-sm">';
                  echo  '<option value="-1" selected>Absented</option>';
                  echo  '<option value="0">Attended</option>';
                  echo  '<option value="0">Absented with Consent</option>';
                  echo  '<option value="0">No Classes</option>';
                  echo '</select>';
                  echo '</div>';
                  echo "</td>";

                  echo "<td>";
                  echo '<div class="block center">';
                  echo '<select class="custom-select-sm">';
                  echo  '<option value="-1" selected>Absented</option>';
                  echo  '<option value="0">Attended</option>';
                  echo  '<option value="0">Absented with Consent</option>';
                  echo  '<option value="0">No Classes</option>';
                  echo '</select>';
                  echo '</div>';
                  echo "</td>";

                  echo "<td>";
                  echo '<div class="block text-center">';
                  echo '<select class="custom-select-sm">';
                  echo  '<option value="-1" selected>Absented</option>';
                  echo  '<option value="0">Attended</option>';
                  echo  '<option value="0">Absented with Consent</option>';
                  echo  '<option value="0">No Classes</option>';
                  echo '</select>';
                  echo '</div>';
                  echo "</td>";

                  echo "</tr>";
                  $no=($no + 1);
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
            <BR>

              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#">Update</button>

              <BR><BR>
                <button class="btn btn-light btn-sm hidden-print" onclick="myFunction()"><i class="fa fa-print"></i> Print Record</button>
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
