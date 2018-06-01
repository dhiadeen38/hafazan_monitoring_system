<!doctype html>

<html>

<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@1.1.2"></script>

  <link rel="stylesheet" href="../style/sidebar.css">

</head>

<body>
  <?php
  session_start();
  $id=$_SESSION["username"];
  $type=$_SESSION["type"];
  $con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  ?>
  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Coordinator</a></li>
        <li><a style="background: yellow; color:#522184" href="createuser.php"><i class="fa fa-users"></i> Dashboard</a></li>
        <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><i class="fa fa-list-alt"></i> Generate record</a>
          <ul class="sidebar-nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
            <li style="text-indent: 30px"><a href="generaterecord.php"><i class="fa fa-book"></i> Hafazan</a></li>
            <li style="text-indent: 30px"><a href="allrecords.php"><i class="fa fa-th-list"></i> All Records</a></li>

          </ul>
        </li>
        <li><a href="changepwdadmin.php"><i class="fa fa-refresh"></i> Change password</a></li>
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
        <div class="row">
          <div class="col-lg-12">

            <?php

            if (ISSET($_SESSION['message'])&& $_SESSION['message'] !=''){
              echo $_SESSION['message'];
              unset($_SESSION['message']);
            }

             ?>

            <h1>Dashboard</h1>
            <div class="row">

              <?php
              $count = "SELECT  (
                SELECT COUNT(student.stud_name)
                FROM   student
              ) AS student,
              (
                SELECT COUNT(lecturer.lect_name)
                FROM lecturer
              ) AS lecturer,
              (
                SELECT COUNT(halaqah.halaqah_name)
                FROM halaqah
              ) AS halaqah,
              (
                SELECT COUNT(batch.batch_name)
                FROM batch
              ) AS batch";

              $result=mysqli_query($con,$count);
              $row=mysqli_fetch_row($result);

              ?>
              <div class="col-lg">
                <div class="card border-primary text-center">
                  <div class="card-body bg-primary text-white">
                    <div class="row">
                      <div class="col-sm"><i class="fa fa-child fa-4x"></i></div>
                      <div class="col-sm"><a href="allrecords.php" class="text-white">
                        <?php
                        echo '<h3>'.$row[0].'</h3>';
                        echo 'Students';
                        ?>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="" class="text-primary" data-toggle="modal" data-target="#popUpWindow1">Add New <i class="fa fa-plus-circle"></i></a>
                </div>
              </div>
              <div class="modal fade" id="popUpWindow1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">

                    <!-- header -->
                    <div class="modal-header bg-primary">

                      <h3 class="modal-title text-white">Register student</h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- body (form) -->
                    <div class="modal-body">
                      <form action="registeringstud.php" method="post">

                        <div class="form-group row">
                          <label for="name" class="col-sm-3 col-form-label">Full Name</span></label>
                          <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="name" placeholder="As in NRIC" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-3">
                            <select class="custom-select" name="gender" id="gender" style="width: 300px">

                              <option value="Male">Male</option>
                              <option value="Female">Female</option>

                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="id" class="col-sm-3 col-form-label">Student ID</label>
                          <div class="col-sm-3">
                            <input type="text" name="id" class="form-control" id="id" placeholder="eg: UTNxxx/20xx" maxlength="10" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="programme" class="col-sm-3 col-form-label">Programme</label>
                          <div class="col-sm-9">
                            <select class="custom-select" name="programme" id="programme" style="width: 300px">

                              <?php
                              $filter="Select programme_id,programme_name FROM programme ";
                              $result3=mysqli_query($con,$filter);

                              while($row=mysqli_fetch_assoc($result3)){
                                echo '<option value="'.$row['programme_id'].'">'.$row['programme_name'].'</option>';
                              }

                              ?>

                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="sponsor" class="col-sm-3 col-form-label">Sponsor</label>
                          <div class="col-sm-9">
                            <input type="text" name="sponsor" class="form-control" id="sponsor" placeholder="Sponsor" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="batch" class="col-sm-3 col-form-label">Batch</label>
                          <div class="col-sm-3">
                            <select class="custom-select" name="batch" id="batch" style="width: 300px">

                              <?php
                              $filter="Select batch_id,batch_name FROM batch ";
                              $result3=mysqli_query($con,$filter);

                              while($row=mysqli_fetch_assoc($result3)){
                                echo '<option value="'.$row['batch_id'].'">'.$row['batch_name'].'</option>';
                              }

                              ?>

                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="halaqah" class="col-sm-3 col-form-label">Halaqah</label>
                          <div class="col-sm-3">
                            <select class="custom-select" name="halaqah" id="halaqah" style="width: 300px">

                              <?php
                              $filter="Select halaqah_id,halaqah_name FROM halaqah ";
                              $result3=mysqli_query($con,$filter);

                              while($row=mysqli_fetch_assoc($result3)){
                                echo '<option value="'.$row['halaqah_id'].'">'.$row['halaqah_name'].'</option>';
                              }

                              ?>

                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="ic_no" class="col-sm-3 col-form-label">IC No</label>
                          <div class="col-sm-3">
                            <input type="number" min="1" name="ic_no" class="form-control" id="ic_no" placeholder="without dash '-'" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="phone_no" class="col-sm-3 col-form-label">Phone No</label>
                          <div class="col-sm-3">
                            <input type="number" min="1" name="phone_no" class="form-control" id="phone_no" placeholder="without dash '-'" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="email" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" id="email" placeholder="eg: ahmad@yahoo.com" required>
                          </div>
                        </div>


                      </div>

                      <!-- button -->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <?php
            $result=mysqli_query($con,$count);
            $row=mysqli_fetch_row($result);
            ?>

            <div class="col-lg">
              <div class="card border-success text-center">
                <div class="card-body bg-success text-white">
                  <div class="row">
                    <div class="col-sm"><i class="fa fa-male fa-4x"></i></div>
                    <div class="col-sm"><a href="allrecords.php" class="text-white">
                      <?php
                      echo '<h3>'.$row[1].'</h3>';
                      echo 'Lecturers';
                      ?>
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="" class="text-success" data-toggle="modal" data-target="#popUpWindow2">Add New <i class="fa fa-plus-circle"></i></a>
              </div>
            </div>
            <div class="modal fade" id="popUpWindow2">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <!-- header -->
                  <div class="modal-header bg-success">

                    <h3 class="modal-title text-white">Register Lecturer</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- body (form) -->
                  <div class="modal-body">
                    <form action="registeringlect.php" method="post">

                      <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                        <div class="col-sm-9">
                          <input type="text" name="name" class="form-control" id="name" placeholder="As in NRIC" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-3">
                          <select class="custom-select" name="gender" id="gender" style="width: 300px">

                            <option value="male">Male</option>
                            <option value="female">Female</option>

                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Lecturer ID</label>
                        <div class="col-sm-3">
                          <input type="text" name="id" class="form-control" id="id" placeholder="ID" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="ic_no" class="col-sm-3 col-form-label">IC No</label>
                        <div class="col-sm-3">
                          <input type="number" min="1" name="ic_no" class="form-control" id="ic_no" placeholder="without dash '-'" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="phone_no" class="col-sm-3 col-form-label">Phone No</label>
                        <div class="col-sm-3">
                          <input type="number" min="1" name="phone_no" class="form-control" id="phone_no" placeholder="without dash '-'" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" name="email" class="form-control" id="email" placeholder="eg: ahmad@yahoo.com" required>
                        </div>
                      </div>

                    </div>

                    <!-- button -->
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <?php
          $result=mysqli_query($con,$count);
          $row=mysqli_fetch_row($result);
          ?>

          <div class="col-lg">
            <div class="card border-warning text-center">
              <div class="card-body bg-warning text-white">
                <div class="row">
                  <div class="col-sm"><i class="fa fa-spinner fa-4x"></i></div>
                  <div class="col-sm"><a href="allrecords.php" class="text-white">
                    <?php
                    echo '<h3>'.$row[2].'</h3>';
                    echo 'Halaqah';
                    ?>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="" class="text-warning" data-toggle="modal" data-target="#popUpWindow3">Add New <i class="fa fa-plus-circle"></i></a>
            </div>
          </div>
          <div class="modal fade" id="popUpWindow3">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- header -->
                <div class="modal-header bg-warning">

                  <h3 class="modal-title text-white">Register Halaqah</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- body (form) -->
                <div class="modal-body">
                  <form action="creatinghlqh.php" method="post">

                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Halaqah Name</label>
                      <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" id="name"  value="<?php
                        $filter="Select max(halaqah_name) AS 'id' FROM halaqah ";
                        $result3=mysqli_query($con,$filter);

                        $row=mysqli_fetch_array($result3);
                        $name = substr("$row[0]", -1);
                        $name = ($name + 1);
                        echo 'Halaqah '.$name;
                        ?>"readonly>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="id" class="col-sm-3 col-form-label">Halaqah ID</label>
                      <div class="col-sm-9">
                        <input type="text" name="id" class="form-control" id="id" value="<?php
                        $filter="Select max(halaqah_id) AS 'id' FROM halaqah ";
                        $result3=mysqli_query($con,$filter);

                        $row=mysqli_fetch_array($result3);
                        $id = substr("$row[0]", -1);
                        $id = ($id + 1);
                        echo 'H'.$id;
                        ?>"readonly>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="lect_id" class="col-sm-3 col-form-label">Select lecturer</label>
                      <div class="col-sm-9">
                        <select class="custom-select" name="lect_id" id="lect_id" style="width: 300px">

                          <?php
                          $filter="Select lect_id,lect_name FROM lecturer ";
                          $result3=mysqli_query($con,$filter);

                          while($row=mysqli_fetch_assoc($result3)){
                            echo '<option value="'.$row['lect_id'].'">'.$row['lect_name'].'</option>';
                          }

                          ?>

                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- button -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-warning btn-block text-white">Submit</button>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>

        <?php
        $result=mysqli_query($con,$count);
        $row=mysqli_fetch_row($result);
        ?>

        <div class="col-lg">
          <div class="card border-info text-center">
            <div class="card-body bg-info text-white">
              <div class="row">
                <div class="col-sm"><i class="fa fa-users fa-4x"></i></div>
                <div class="col-sm"><a href="allrecords.php" class="text-white">
                  <?php
                  echo '<h3>'.$row[3].'</h3>';
                  echo 'Batch';
                  ?>
                </a>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <a href="" class="text-info" data-toggle="modal" data-target="#popUpWindow4">Add New <i class="fa fa-plus-circle"></i></a>
          </div>
        </div>
        <div class="modal fade" id="popUpWindow4">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- header -->
              <div class="modal-header bg-info">

                <h3 class="modal-title text-white">Register Batch</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- body (form) -->
              <div class="modal-body">
                <form action="creatingbtch.php" method="post">

                  <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Batch Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" class="form-control" id="name" value="<?php
                      $filter="Select max(batch_name) AS 'name' FROM batch ";
                      $result3=mysqli_query($con,$filter);

                      $row=mysqli_fetch_array($result3);
                      $name = substr("$row[0]", -1);
                      $name = ($name + 1);
                      echo 'Tahfiz '.$name;
                      ?>"readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label">Batch ID</label>
                    <div class="col-sm-9">
                      <input type="text" name="id" class="form-control" id="id" value="<?php
                      $filter="Select max(batch_id) AS 'id' FROM batch ";
                      $result3=mysqli_query($con,$filter);

                      $row=mysqli_fetch_array($result3);
                      $id = substr("$row[0]", -1);
                      $id = ($id + 1);
                      echo 'T'.$id;
                      ?>"readonly>
                    </div>
                  </div>
                </div>

                <!-- button -->
                <div class="modal-footer">
                  <button type="submit" class="btn btn-info btn-block">Submit</button>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="card col-lg-4">

        <div class="card-body">
          <h3 class="card-title" align="center">Statistics</h3>
          <div>
            <canvas id="myChart" width="10" height="10"></canvas>
            <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
              // The type of chart we want to create
              type: 'pie',

              // The data for our dataset
              data: {
                labels: ["Above Muqarrar", "On Muqarrar", "Below Muqarrar"],
                datasets: [{
                  label: "My First dataset",
                  backgroundColor: ['#62ff8f','#fff462','#ff6262'],
                  data: [
                    <?php
                    $filter = "SELECT
                    SUM(IF(student.page_memorized>programme.curr_syllabus, 1, 0)) AS ABOVE_MUQARRAR,
                    SUM(IF(student.page_memorized=programme.curr_syllabus, 1, 0)) AS ON_MUQARRAR,
                    SUM(IF(student.page_memorized<programme.curr_syllabus, 1, 0)) AS BELOW_MUQARRAR
                    FROM student
                    INNER JOIN programme
                    ON student.programme_id=programme.programme_id";

                    $result4=mysqli_query($con,$filter);
                    $row=mysqli_fetch_row($result4);

                    echo $row[0].','.$row[1].','.$row[2];?>

                  ],
                }]
              },

              // Configuration options go here
              options: {}
            });
            </script>
          </div>
          <BR>

          </div>
        </div>
        <div class="card col-lg ml-3">
          <div class="card-body">

            <h3 class="card-title" align="center">Update Current Muqarrar</h3>

            <?php
            $sql3="Select programme_name, curr_syllabus, programme_id FROM programme";
            $result3=mysqli_query($con,$sql3);

            echo '<table class="table table-striped col-lg-12" >';
            echo '<thead>';
            echo '<tr align="center">';
            echo '<th scope="col">'.'Programme'.'</th>';
            echo '<th scope="col">'.'Page'.'</th>';
            echo '<th scope="col">'.'Action'.'</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row=mysqli_fetch_row($result3)) {

              echo '<tr>';
              echo '<td align="left" scope="row">'.$row[0].'</td>';
              echo '<td align="center">'.$row[1].'</td>';
              $prog_id = preg_replace('/\s/', '', $row[2]);
              echo '<td align=\'center\'>'.'<a href="#edit'.$prog_id.'" data-toggle="modal"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popUpWindow5"><i class="fa fa-pencil"></i></button></a>'.'</td>';

              echo '<div class="modal fade" id="edit'.$prog_id.'">';
              echo '<div class="modal-dialog">';
              echo '<div class="modal-content">';


              echo'<div class="modal-header">';

              echo'<h3 class="modal-title">Update Syllabus</h3>';
              echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
              echo'</div>';


              echo'<div class="modal-body">';
              echo'<form action="update_syllabus_page.php" method="post">';

              echo'<div class="form-group row">';
              echo'<label for="curr_syllabus" class="col-sm-6 col-form-label">Current Page</label>';
              echo'<div class="col-sm-6">';
              echo'<input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="1" maxlength="3" name="curr_syllabus" class="form-control" id="curr_syllabus" placeholder="Page Number" value="'.$row[1].'">';
              echo'</div>';
              echo'</div>';

              echo'<div class="form-group row" style="display: none;">';
              echo'<label for="id" class="col-sm-3 col-form-label">Programme ID</label>';
              echo'<div class="col-sm-9">';
              echo'<input type="text" name="id" class="form-control" id="id" placeholder="ID" value="'.$row[2].'">';
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
              echo '</tr>';

            }
            echo '<tr>';

            echo '<td scope="row">';
            echo '</td>';
            echo '<td>';
            echo '</td>';
            echo '<td align="center">'.'<button type="button" class="btn btn-success rounded-circle"  data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-plus"></i></button>'.'</td>';

            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
            ?>
          </div>
          <div class="modal fade" id="popUpWindow">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">

                <!-- header -->
                <div class="modal-header bg-success">

                  <h3 class="modal-title text-white">New Programme</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- body (form) -->
                <div class="modal-body">
                  <form action="creatingprgm.php" method="post">

                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Programme Name</span></label>
                      <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="id" class="col-sm-3 col-form-label">Programme ID</label>
                      <div class="col-sm-9">
                        <input type="text" name="id" class="form-control" id="id" placeholder="ID" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="syllabus" class="col-sm-3 col-form-label">Syllabus</label>
                      <div class="col-sm-3">
                        <input type="number" min="1" name="syllabus" class="form-control" id="syllabus" placeholder="Current Page" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                      </div>
                    </div>
                  </div>

                  <!-- button -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Submit</button>
                  </form>
                </div>

              </div>
            </div>
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
