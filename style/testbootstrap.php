<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Generate record</title>
  <?php include '../script/setStatus.php';?>
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
  <script type="text/javascript" src="../script/filterTable.js"></script>

</head>

<body>
  <?php

  $con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $sql="SET @prev_value = NULL";
  $result=mysqli_query($con,$sql);

  $sql="SET @rank_count = 0";
  $result=mysqli_query($con,$sql);

  $sql="SELECT programme.curr_syllabus, programme.programme_name, student.stud_name, student.stud_id, student.halaqah_id, student.batch_id, student.page_memorized, student.stud_status, student.sponsor, student.ic_no, student.phone_no, student.email
  FROM programme
  INNER JOIN student
  ON programme.programme_id=student.programme_id
  ORDER BY student.page_memorized DESC";
  $result=mysqli_query($con,$sql);
  ?>
  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Admin</a></li>
        <li><a href="createuser.php"><i class="fa fa-users"></i> Dashboard</a></li>
        <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><i class="fa fa-list-alt"></i> Generate record</a>
          <ul class="sidebar-nav" id="submenu1" role="menu" aria-labelledby="btn-1">
            <li style="text-indent: 30px"><a style="background: yellow; color:#522184" href="generaterecord.php"><i class="fa fa-search"></i> Search</a></li>
            <li style="text-indent: 30px"><a href="allrecords.php"><i class="fa fa-th-list"></i> All Records</a></li>

          </ul>
        </li>
        <li><a href="changepwdadmin.php"><i class="fa fa-refresh"></i> Change password</a></li>
        <li><a href="../homepage/logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
      </ul>
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
        <div class="row">
          <div class="col-lg-12">

            <div class="d-flex">
              <div class="p-2">
                <div class="btn-group" role="group" aria-label="Sorting data">
                  <button type="button" class="btn btn-primary" onclick="sortTable(1)"><i class="fa fa-sort"></i> By Name</button>
                  <button type="button" class="btn btn-success" onclick="sortTable(3)"><i class="fa fa-sort"></i> By Halaqah</button>
                  <button type="button" class="btn btn-danger" onclick="sortTable(4)"><i class="fa fa-sort"></i> By Batch</button>
                  <button type="button" class="btn btn-info" onclick="sortTable(5)"><i class="fa fa-sort"></i> By Muqarrar Completion</button>
                </div>
              </div>

              <div class="ml-auto p-2">
                <form class="form-inline justify-content-between">
                  <input class="form-control mr-sm-2 bg-light" type="text" id="myInput" onkeyup="myFunction()" placeholder="&#xF002; Search By Name" style="font-family:Arial, FontAwesome" aria-label="Search">

                </form>
              </div>

            </div>

            <div class="container-fluid">
              <div class="card">
                <div class="card-body">
                  <table class="table table-striped col-lg-12" id="myTable">


                    <thead>
                      <tr align="center">
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Halaqah</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Muqarrar Completion</th>
                        <th scope="col">Muqarrar Status</th>
                        <th scope="col">Rank In Halaqah</th>
                        <th scope="col">Rank In Batch</th>
                        <th scope="col" colspan="2">Action</th>

                      </tr>
                    </thead>

                    <tbody>

                      <?php
                      $no=1;
                      $curr_page=0;
                      $prev_page=0;
                      $temp=1;
                      while($row=mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<th scope='row' align='center'>".$no."</th>";
                        echo "<td>".'<a href="#view_bio'.$row['stud_id'].'" data-toggle="modal">'.$row['stud_name'].'</a>'."</td>";

                        echo '<div class="modal fade" id="view_bio'.$row['stud_id'].'">';
                          echo '<div class="modal-dialog">';
                            echo'<div class="modal-content">';


                              echo'<div class="modal-header">';

                                echo'<h3 class="modal-title">Student Biodata</h3>';
                                echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                              echo'</div>';


                              echo'<div class="modal-body">';


                              echo $row['stud_id'].'<BR>';
                              echo $row['stud_status'].'<BR>';
                              echo $row['programme_name'].'<BR>';
                              echo $row['sponsor'].'<BR>';
                              echo $row['ic_no'].'<BR>';
                              echo $row['phone_no'].'<BR>';
                              echo $row['email'].'<BR>';


                              echo'</div>';

                            echo'</div>';
                          echo'</div>';
                        echo'</div>';

                        echo "<td align='center'>".'<a href="#view_halaqah'.$row['halaqah_id'].'" data-toggle="modal">'.$row['halaqah_id'].'</a>'."</td>";
                        $halaqah=$row['halaqah_id'];
                        $sql2="SELECT student.stud_name
                        FROM student
                        WHERE student.halaqah_id='$halaqah'";
                        $result2=mysqli_query($con,$sql2);

                        echo '<div class="modal fade" id="view_halaqah'.$row['halaqah_id'].'">';
                          echo '<div class="modal-dialog">';
                            echo'<div class="modal-content">';


                              echo'<div class="modal-header">';

                                echo'<h3 class="modal-title">Student Biodata</h3>';
                                echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                              echo'</div>';


                              echo'<div class="modal-body">';

                              while($row=mysqli_fetch_array($result2)){


                              echo $row['stud_name'].'<BR>';


                              }
                              echo'</div>';

                            echo'</div>';
                          echo'</div>';
                        echo'</div>';

                        echo "<td align='center'>".$row['batch_id']."</td>";

                        $percent=(($row['page_memorized']/$row['curr_syllabus'])*100);

                        echo "<td align='center'>".round($percent,2).'%'."</td>";
                        echo "<td align='center'>";
                        echo (setStatus($row['page_memorized'],$row['curr_syllabus']));
                        echo "</td>";
                        $curr_page=$row['page_memorized'];
                        $prev_page=$row['page_memorized'];


                        echo "<td align='center'>".$temp."</td>";
                        echo "<td align='center'>".$temp."</td>";

                        echo '<td align=\'center\'>'.'<a href="#edit'.$row['stud_id'].'" data-toggle="modal"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popUpWindow5"><i class="fa fa-pencil"></i></button></a>'.'</td>';

                        echo '<div class="modal fade" id="edit'.$row['stud_id'].'">';
                        echo '<div class="modal-dialog">';
                        echo'<div class="modal-content">';


                        echo'<div class="modal-header">';

                        echo'<h3 class="modal-title">Edit Student</h3>';
                        echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                        echo'</div>';


                        echo'<div class="modal-body">';
                        echo'<form action="update_stud_bio.php" method="post">';

                        echo'<div class="form-group row">';
                        echo'<label for="name" class="col-sm-3 col-form-label">Name</label>';
                        echo'<div class="col-sm-9">';
                        echo'<input type="text" name="name" class="form-control" id="name" placeholder="Name" value="'.$row['stud_name'].'">';
                        echo'</div>';
                        echo'</div>';

                        echo'<div class="form-group row" style="display: none;">';
                        echo'<label for="id" class="col-sm-3 col-form-label">ID</label>';
                        echo'<div class="col-sm-9">';
                        echo'<input type="text" name="id" class="form-control" id="id" placeholder="ID" value="'.$row['stud_id'].'">';
                        echo'</div>';
                        echo'</div>';
                        echo'</div>';


                        echo'<div class="modal-footer">';
                        echo'<button type="submit" class="btn btn-warning btn-block">Submit</button>';
                        echo'</form>';
                        echo'</div>';

                        echo'</div>';
                        echo'</div>';
                        echo'</div>';


                        echo '<td align=\'center\'>'.'<a href="#delete'.$row['stud_id'].'" data-toggle="modal"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>'.'</td>';

                        echo'<div class="modal fade" id="delete'.$row['stud_id'].'">';
                        echo'<div class="modal-dialog">';
                        echo'<form action="delete_stud.php" method="post">';
                        echo'<div class="modal-content">';


                        echo'<div class="modal-header">';

                        echo'<h3 class="modal-title">Delete Student</h3>';
                        echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                        echo'</div>';


                        echo'<div class="modal-body">';
                        echo'<input type="hidden" name="id" class="form-control" id="id" placeholder="ID" value="'.$row['stud_id'].'">';

                        echo'<p>'.'<div class="alert alert-danger">'.'Are you Sure you want to delete '.'<strong>'. $row['stud_name'].'?'.'</strong>'.'</p>'.'</div>';

                        echo'<div class="modal-footer">';
                        echo'<button type="submit" class="btn btn-danger btn-block"><i class="fa fa-check"></i></button>';
                        echo'<button type="button" class="btn btn-light btn-block" data-dismiss="modal"><i class="fa fa-times"></i></button>';
                        echo'</form>';
                        echo'</div>';

                        echo'</div>';
                        echo'</div>';
                        echo'</div>';

                        echo "</tr>";
                        $no=($no + 1);
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              </div>
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
