<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>All Records</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/sidebar.css">
  <script type="text/javascript" src="../script/print.js"></script>

</head>

<body>
  <?php
  session_start();
  $con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $sql='SELECT halaqah.halaqah_name, halaqah.halaqah_id, lecturer.lect_name, COUNT(student.halaqah_id) "total_students"
  FROM halaqah
  INNER JOIN student
  ON halaqah.halaqah_id=student.halaqah_id
  INNER JOIN lecturer
  ON halaqah.lect_id=lecturer.lect_id
  GROUP BY student.halaqah_id';
  $result=mysqli_query($con,$sql);

  $sql2='SELECT batch.batch_name, batch.batch_id, COUNT(student.batch_id) "total_students"
  FROM batch
  INNER JOIN student
  ON batch.batch_id=student.batch_id
  GROUP BY student.batch_id ';
  $result2=mysqli_query($con,$sql2);

  $sql3='SELECT programme.programme_name, student.stud_name, student.gender, student.stud_id, student.programme_id, student.halaqah_id, student.batch_id, student.stud_status, student.sponsor, student.ic_no, student.phone_no, student.email
  FROM programme
  INNER JOIN student
  ON programme.programme_id=student.programme_id
  ORDER BY student.page_memorized DESC';
  $result3=mysqli_query($con,$sql3);

  $sql4="SELECT lecturer.lect_name, lecturer.gender,lecturer.lect_id, lecturer.ic_no, lecturer.phone_no, lecturer.email, halaqah.halaqah_id
  FROM lecturer
  INNER JOIN halaqah
  ON lecturer.lect_id=halaqah.lect_id";
  $result4=mysqli_query($con,$sql4);

  $sql5="Select * FROM parent ";
  $result5=mysqli_query($con,$sql5);
  ?>
  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Admin</a></li>
        <li><a href="createuser.php"><i class="fa fa-users"></i> Dashboard</a></li>
        <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><i class="fa fa-list-alt"></i> Generate record</a>
          <ul class="sidebar-nav" id="submenu1" role="menu" aria-labelledby="btn-1">
            <li style="text-indent: 30px"><a href="generaterecord.php"><i class="fa fa-book"></i> Hafazan</a></li>
            <li style="text-indent: 30px"><a style="background: yellow; color:#522184" href="allrecords.php"><i class="fa fa-th-list"></i> All Records</a></li>

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
              <div class="row">

                <div class="col-lg-8">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-regstud-tab" data-toggle="pill" href="#pills-regstud" role="tab" aria-controls="pills-regstud" aria-selected="true">Student</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-reglect-tab" data-toggle="pill" href="#pills-reglect" role="tab" aria-controls="pills-reglect" aria-selected="false">Lecturer</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-createhlqh-tab" data-toggle="pill" href="#pills-createhlqh" role="tab" aria-controls="pills-createhlqh" aria-selected="true">Halaqah</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-createbtch-tab" data-toggle="pill" href="#pills-createbtch" role="tab" aria-controls="pills-createbtch" aria-selected="false">Batch</a>
                    </li>
                  </ul>

              </div>
              <div class="col-sm-4 d-flex justify-content-end">
                <button class="btn btn-light btn-sm hidden-print" onclick="myFunction()"><i class="fa fa-print"></i> Print Record</button>
              </div>
              <div class="col-lg-12 tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-regstud" role="tabpanel" aria-labelledby="pills-regstud-tab">

                  <div class="container-fluid">
                    <div class="card">
                      <div class="card-body">
                        <table class="table table-striped col-lg-12" id="myTable">

                          <?php
                          $no=1;
                          echo '<thead>';
                          echo '<tr align="center">';
                          echo '<th>'.'No'.'</th>';
                          echo '<th >'.'Name'.'</th>';
                          echo '<th>'.'Student ID'.'</th>';
                          echo '<th>'.'Programme'.'</th>';
                          echo '<th>'.'Batch'.'</th>';
                          echo '<th>'.'Halaqah'.'</th>';
                          echo '<th colspan="2">'.'Action'.'</th>';
                          echo '</tr>';
                          echo '</thead>';
                          echo '<tbody>';
                          while($row=mysqli_fetch_array($result3)){
                            echo "<tr>";
                            echo "<td align='center'>"."<strong>".$no."</strong>"."</td>";

                            $stud_id=$row['stud_id'];
                            $stud_name=$row['stud_name'];

                            echo "<td>".'<a href="#view_bio'.$stud_id.'" data-toggle="modal">'.$stud_name.'</a>'."</td>";

                            echo '<div class="modal fade" id="view_bio'.$stud_id.'">';
                              echo '<div class="modal-dialog">';
                                echo'<div class="modal-content">';


                                  echo'<div class="modal-header bg-primary text-white">';

                                    echo'<h3 class="modal-title">Student Biodata</h3>';
                                    echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                                  echo'</div>';

                                  echo'<div class="modal-body">';

                                  $pic_sql="SELECT profile_pic
                                	FROM student
                                	WHERE stud_id='$stud_id'";
                                	$pic_result=mysqli_query($con,$pic_sql);

                                	$student = $pic_result->fetch_assoc();
                                	$profile_pic = $student['profile_pic'];

                                  if ($profile_pic == NULL){
                  									echo "<p align='center'><img src='Image-not-available.jpg' width='180'></p>";
                  								}
                  								else {
                  									echo "<p align='center'><img src='../student/" . $profile_pic . "' width='180'></p>";
                  								}

                                  echo 'Gender: '.$row['gender'].'<BR>';
                                  echo 'Status: '.$row['stud_status'].'<BR>';
                                  echo 'Programme: '.$row['programme_name'].'<BR>';
                                  echo 'Sponsor: '.$row['sponsor'].'<BR>';
                                  echo 'IC No: '.$row['ic_no'].'<BR>';
                                  echo 'Phone No: '.$row['phone_no'].'<BR>';
                                  echo 'Email: '.$row['email'].'<BR>';

                                  echo'</div>';

                                echo'</div>';
                              echo'</div>';
                            echo'</div>';

                            echo "<td>".substr($stud_id,0,6).'/'.substr($stud_id,-4)."</td>";
                            echo "<td align='center'>".$row['programme_id']."</td>";
                            echo "<td align='center'>".$row['batch_id']."</td>";
                            echo "<td align='center'>".$row['halaqah_id']."</td>";
                            echo '<td align=\'center\'>'.'<a href="#edit'.$row['stud_id'].'" data-toggle="modal"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popUpWindow5"><i class="fa fa-pencil"></i></button></a>'.'</td>';

                            echo '<div class="modal fade" id="edit'.$stud_id.'">';
                            echo '<div class="modal-dialog">';
                            echo'<div class="modal-content">';


                            echo'<div class="modal-header bg-warning text-white">';

                            echo'<h3 class="modal-title">Edit Student</h3>';
                            echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            echo'</div>';


                            echo'<div class="modal-body">';
                            echo'<form action="update_stud_bio2.php" method="post">';

                            echo'<div class="form-group row">';
                            echo'<label for="name" class="col-sm-3 col-form-label">Name</label>';
                            echo'<div class="col-sm-9">';
                            echo'<input type="text" name="name" class="form-control" id="name" placeholder="Name" value="'.$stud_name.'">';
                            echo'</div>';
                            echo'</div>';

                            echo'<div class="form-group row" style="display: none;">';
                            echo'<label for="id" class="col-sm-3 col-form-label">ID</label>';
                            echo'<div class="col-sm-9">';
                            echo'<input type="text" name="id" class="form-control" id="id" placeholder="ID" value="'.$stud_id.'">';
                            echo'</div>';
                            echo'</div>';
                            echo'</div>';


                            echo'<div class="modal-footer">';
                            echo'<button type="submit" class="btn btn-warning btn-block text-white">Submit</button>';
                            echo'</form>';
                            echo'</div>';

                            echo'</div>';
                            echo'</div>';
                            echo'</div>';


                            echo '<td align=\'center\'>'.'<a href="#delete'.$stud_id.'" data-toggle="modal"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>'.'</td>';

                            echo'<div class="modal fade" id="delete'.$stud_id.'">';
                            echo'<div class="modal-dialog">';
                            echo'<form action="delete_stud2.php" method="post">';
                            echo'<div class="modal-content">';


                            echo'<div class="modal-header bg-danger text-white">';

                            echo'<h3 class="modal-title">Delete Student</h3>';
                            echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            echo'</div>';


                            echo'<div class="modal-body">';
                            echo'<input type="hidden" name="id" class="form-control" id="id" placeholder="ID" value="'.$stud_id.'">';

                            echo'<p>'.'<div class="alert alert-danger">'.'Are you Sure you want to delete '.'<strong>'. $stud_name.'?'.'</strong>'.'</p>'.'</div>';

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
                          echo '</tbody>';

                          ?>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="tab-pane fade" id="pills-reglect" role="tabpanel" aria-labelledby="pills-reglect-tab">

                  <div class="container-fluid">
                    <div class="card">
                      <div class="card-body">
                        <table class="table table-striped col-lg-12">
                          <?php
                          $no=1;
                          echo '<thead>';
                          echo '<tr align="center">';
                          echo '<th>'.'No'.'</th>';
                          echo '<th>'.'Name'.'</th>';
                          echo '<th>'.'ID'.'</th>';
                          echo '<th colspan="2">'.'Action'.'</th>';
                          echo '</tr>';
                          echo '</thead>';
                          echo '<tbody>';
                          while($row=mysqli_fetch_array($result4)){
                            echo "<tr>";
                            echo "<td align='center'>"."<strong>".$no."</strong>"."</td>";
                            echo "<td>".'<a href="#view_bio'.$row['lect_id'].'" data-toggle="modal">'.$row['lect_name'].'</a>'."</td>";

                            echo '<div class="modal fade" id="view_bio'.$row['lect_id'].'">';
                              echo '<div class="modal-dialog">';
                                echo'<div class="modal-content">';


                                  echo'<div class="modal-header bg-success text-white">';

                                    echo'<h3 class="modal-title">Lecturer Biodata</h3>';
                                    echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                                  echo'</div>';

                                  echo'<div class="modal-body">';

                                  echo 'Gender: '.$row['gender'].'<BR>';
                                  echo 'IC No: '.$row['ic_no'].'<BR>';
                                  echo 'Phone No: '.$row['phone_no'].'<BR>';
                                  echo 'Email: '.$row['email'].'<BR>';
                                  echo 'Assigned Halaqah: '.$row['halaqah_id'].'<BR>';


                                  echo'</div>';

                                echo'</div>';
                              echo'</div>';
                            echo'</div>';



                            echo "<td>".$row['lect_id']."</td>";
                            echo '<td align=\'center\'>'.'<a href="#edit'.$row['lect_id'].'" data-toggle="modal"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popUpWindow5"><i class="fa fa-pencil"></i></button></a>'.'</td>';

                            echo '<div class="modal fade" id="edit'.$row['lect_id'].'">';
                            echo '<div class="modal-dialog">';
                            echo'<div class="modal-content">';


                            echo'<div class="modal-header bg-warning text-white">';

                            echo'<h3 class="modal-title">Edit Lecturer</h3>';
                            echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            echo'</div>';


                            echo'<div class="modal-body">';
                            echo'<form action="update_lect_bio.php" method="post">';

                            echo'<div class="form-group row">';
                            echo'<label for="name" class="col-sm-3 col-form-label">Name</label>';
                            echo'<div class="col-sm-9">';
                            echo'<input type="text" name="name" class="form-control" id="name" placeholder="Name" value="'.$row['lect_name'].'">';
                            echo'</div>';
                            echo'</div>';

                            echo'<div class="form-group row" style="display: none;">';
                            echo'<label for="id" class="col-sm-3 col-form-label">ID</label>';
                            echo'<div class="col-sm-9">';
                            echo'<input type="text" name="id" class="form-control" id="id" placeholder="ID" value="'.$row['lect_id'].'">';
                            echo'</div>';
                            echo'</div>';
                            echo'</div>';


                            echo'<div class="modal-footer">';
                            echo'<button type="submit" class="btn btn-warning btn-block text-white">Submit</button>';
                            echo'</form>';
                            echo'</div>';

                            echo'</div>';
                            echo'</div>';
                            echo'</div>';


                            echo '<td align=\'center\'>'.'<a href="#delete'.$row['lect_id'].'" data-toggle="modal"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>'.'</td>';

                            echo'<div class="modal fade" id="delete'.$row['lect_id'].'">';
                            echo'<div class="modal-dialog">';
                            echo'<form action="delete_lect.php" method="post">';
                            echo'<div class="modal-content">';


                            echo'<div class="modal-header bg-danger text-white">';

                            echo'<h3 class="modal-title">Delete Lecturer</h3>';
                            echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            echo'</div>';


                            echo'<div class="modal-body">';
                            echo'<input type="hidden" name="id" class="form-control" id="id" placeholder="ID" value="'.$row['lect_id'].'">';

                            echo'<p>'.'<div class="alert alert-danger">'.'Are you Sure you want to delete '.'<strong>'. $row['lect_name'].'?'.'</strong>'.'</p>'.'</div>';

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
                          echo '</tbody>';

                          ?>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="tab-pane fade" id="pills-createhlqh" role="tabpanel" aria-labelledby="pills-createhlqh-tab">

                  <div class="container-fluid">
                    <div class="card">
                      <div class="card-body">
                        <table class="table table-striped col-lg-12">
                          <?php
                          $no=1;
                          echo '<thead>';
                          echo '<tr align="center">';
                          echo '<th>'.'No'.'</th>';
                          echo '<th>'.'Halaqah Name'.'</th>';
                          echo '<th>'.'Halaqah ID'.'</th>';
                          echo '<th>'.'Lecturer Name'.'</th>';
                          echo '<th>'.'Total students'.'</th>';
                          echo '<th colspan="2">'.'Action'.'</th>';
                          echo '</tr>';
                          echo '</thead>';
                          echo '<tbody>';
                          while($row=mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<td align='center'>"."<strong>".$no."</strong>"."</td>";
                            echo "<td>".$row['halaqah_name']."</td>";
                            echo "<td align='center'>".$row['halaqah_id']."</td>";
                            echo "<td align='center'>".$row['lect_name']."</td>";
                            echo "<td align='center'>".'<a href="#view_halaqah'.$row['halaqah_id'].'" data-toggle="modal">'.$row['total_students'].'</a>'."</td>";
                            $halaqah_name=$row['halaqah_name'];
                            $halaqah=$row['halaqah_id'];
                            $sql6="SELECT student.stud_name
                            FROM student
                            WHERE student.halaqah_id='$halaqah'";
                            $result6=mysqli_query($con,$sql6);


                            echo '<div class="modal fade" id="view_halaqah'.$halaqah.'">';
                              echo '<div class="modal-dialog">';
                                echo'<div class="modal-content">';


                                  echo'<div class="modal-header bg-warning text-white">';

                                    echo'<h3 class="modal-title">Enrolled Student</h3>';
                                    echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                                  echo'</div>';

                                  echo'<div class="modal-body">';
                                  $no2=1;
                                  while($row=mysqli_fetch_array($result6)){


                                  echo $no2.') '.$row['stud_name'].'<BR>';

                                  $no2=($no2+1);
                                  }

                                  echo'</div>';

                                echo'</div>';
                              echo'</div>';
                            echo'</div>';

                            echo '<td align=\'center\'>'.'<a href="#edit'.$halaqah.'" data-toggle="modal"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popUpWindow5"><i class="fa fa-pencil"></i></button></a>'.'</td>';

                            echo '<div class="modal fade" id="edit'.$halaqah.'">';
                            echo '<div class="modal-dialog">';
                            echo'<div class="modal-content">';


                            echo'<div class="modal-header bg-warning text-white">';

                            echo'<h3 class="modal-title">Edit Halaqah</h3>';
                            echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            echo'</div>';


                            echo'<div class="modal-body">';
                            echo'<form action="update_hlqh_bio.php" method="post">';

                            echo'<div class="form-group row">';
                            echo'<label for="name" class="col-sm-3 col-form-label">Name</label>';
                            echo'<div class="col-sm-9">';
                            echo'<input type="text" name="name" class="form-control" id="name" placeholder="Name" value="'.$halaqah_name.'">';
                            echo'</div>';
                            echo'</div>';

                            echo'<div class="form-group row" style="display: none;">';
                            echo'<label for="id" class="col-sm-3 col-form-label">ID</label>';
                            echo'<div class="col-sm-9">';
                            echo'<input type="text" name="id" class="form-control" id="id" placeholder="ID" value="'.$halaqah.'">';
                            echo'</div>';
                            echo'</div>';
                            echo'</div>';


                            echo'<div class="modal-footer">';
                            echo'<button type="submit" class="btn btn-warning btn-block text-white">Submit</button>';
                            echo'</form>';
                            echo'</div>';

                            echo'</div>';
                            echo'</div>';
                            echo'</div>';


                            echo '<td align=\'center\'>'.'<a href="#delete'.$halaqah.'" data-toggle="modal"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>'.'</td>';

                            echo'<div class="modal fade" id="delete'.$halaqah.'">';
                            echo'<div class="modal-dialog">';
                            echo'<form action="delete_hlqh.php" method="post">';
                            echo'<div class="modal-content">';


                            echo'<div class="modal-header bg-danger text-white">';

                            echo'<h3 class="modal-title">Delete Halaqah</h3>';
                            echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            echo'</div>';


                            echo'<div class="modal-body">';
                            echo'<input type="hidden" name="id" class="form-control" id="id" placeholder="ID" value="'.$halaqah.'">';

                            echo'<p>'.'<div class="alert alert-danger">'.'Are you Sure you want to delete '.'<strong>'. $halaqah_name.'?'.'</strong>'.'</p>'.'</div>';

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
                          echo '</tbody>';
                          ?>
                        </table>
                      </div>
                    </div>
                  </div>
                  <BR>

                  </div>

                  <div class="tab-pane fade" id="pills-createbtch" role="tabpanel" aria-labelledby="pills-createbtch-tab">

                    <div class="container-fluid">
                      <div class="card">
                        <div class="card-body">
                          <table class="table table-striped col-lg-12">
                            <?php
                            $no=1;
                            echo '<thead>';
                            echo '<tr align="center">';
                            echo '<th>'.'No'.'</th>';
                            echo '<th>'.'Batch Name'.'</th>';
                            echo '<th>'.'Batch ID'.'</th>';
                            echo '<th>'.'Total students'.'</th>';
                            echo '<th colspan="2">'.'Action'.'</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            while($row=mysqli_fetch_array($result2)){
                              echo "<tr>";
                              echo "<td align='center'>"."<strong>".$no."</strong>"."</td>";
                              echo "<td>".$row['batch_name']."</td>";
                              echo "<td align='center'>".$row['batch_id']."</td>";
                              echo "<td align='center'>".'<a href="#view_batch'.$row['batch_id'].'" data-toggle="modal">'.$row['total_students'].'</a>'."</td>";
                              $batch_name=$row['batch_name'];
                              $batch=$row['batch_id'];
                              $sql6="SELECT student.stud_name
                              FROM student
                              WHERE student.batch_id='$batch'";
                              $result6=mysqli_query($con,$sql6);


                              echo '<div class="modal fade" id="view_batch'.$batch.'">';
                                echo '<div class="modal-dialog">';
                                  echo'<div class="modal-content">';


                                    echo'<div class="modal-header bg-info text-white">';

                                      echo'<h3 class="modal-title">Enrolled Student</h3>';
                                      echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                                    echo'</div>';

                                    echo'<div class="modal-body">';

                                    $no2=1;
                                    while($row=mysqli_fetch_array($result6)){


                                    echo $no2.') '.$row['stud_name'].'<BR>';

                                    $no2=($no2+1);
                                    }

                                    echo'</div>';

                                  echo'</div>';
                                echo'</div>';
                              echo'</div>';



                              echo '<td align=\'center\'>'.'<a href="#edit'.$batch.'" data-toggle="modal"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popUpWindow5"><i class="fa fa-pencil"></i></button></a>'.'</td>';

                              echo '<div class="modal fade" id="edit'.$batch.'">';
                              echo '<div class="modal-dialog">';
                              echo'<div class="modal-content">';


                              echo'<div class="modal-header bg-warning text-white">';

                              echo'<h3 class="modal-title">Edit Batch</h3>';
                              echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                              echo'</div>';


                              echo'<div class="modal-body">';
                              echo'<form action="update_btch_bio.php" method="post">';

                              echo'<div class="form-group row">';
                              echo'<label for="name" class="col-sm-3 col-form-label">Name</label>';
                              echo'<div class="col-sm-9">';
                              echo'<input type="text" name="name" class="form-control" id="name" placeholder="Name" value="'.$batch_name.'">';
                              echo'</div>';
                              echo'</div>';

                              echo'<div class="form-group row" style="display: none;">';
                              echo'<label for="id" class="col-sm-3 col-form-label">ID</label>';
                              echo'<div class="col-sm-9">';
                              echo'<input type="text" name="id" class="form-control" id="id" placeholder="ID" value="'.$batch.'">';
                              echo'</div>';
                              echo'</div>';
                              echo'</div>';


                              echo'<div class="modal-footer">';
                              echo'<button type="submit" class="btn btn-warning btn-block text-white">Submit</button>';
                              echo'</form>';
                              echo'</div>';

                              echo'</div>';
                              echo'</div>';
                              echo'</div>';


                              echo '<td align=\'center\'>'.'<a href="#delete'.$batch.'" data-toggle="modal"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>'.'</td>';

                              echo'<div class="modal fade" id="delete'.$batch.'">';
                              echo'<div class="modal-dialog">';
                              echo'<form action="delete_btch.php" method="post">';
                              echo'<div class="modal-content">';


                              echo'<div class="modal-header bg-danger text-white">';

                              echo'<h3 class="modal-title">Delete Batch</h3>';
                              echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                              echo'</div>';


                              echo'<div class="modal-body">';
                              echo'<input type="hidden" name="id" class="form-control" id="id" placeholder="ID" value="'.$batch.'">';

                              echo'<p>'.'<div class="alert alert-danger">'.'Are you Sure you want to delete '.'<strong>'. $batch_name.'?'.'</strong>'.'</p>'.'</div>';

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
                            echo '</tbody>';

                            ?>
                          </table>
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
  </div>


</div>

</div>
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </html>
