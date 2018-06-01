<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Generate record</title>
  <?php include '../script/setStatus.php';?>

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
  <script type="text/javascript" src="../script/print.js"></script>
  <script type="text/javascript" src="../script/sort.js"></script>
  <script type="text/javascript">
  function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, td2, td3, td4, td5, td6, td7, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      td2 = tr[i].getElementsByTagName("td")[1];
      td3 = tr[i].getElementsByTagName("td")[2];
      td4 = tr[i].getElementsByTagName("td")[3];
      td5 = tr[i].getElementsByTagName("td")[4];
      td6 = tr[i].getElementsByTagName("td")[5];
      td7 = tr[i].getElementsByTagName("td")[6];

      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1 || td5.innerHTML.toUpperCase().indexOf(filter) > -1 || td6.innerHTML.toUpperCase().indexOf(filter) > -1 || td7.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
  </script>

</head>

<body>
  <?php
  session_start();
  $con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $sql="SELECT programme.curr_syllabus, programme.programme_name, student.stud_name, student.gender, student.stud_id, student.halaqah_id, student.batch_id, student.page_memorized, student.stud_status, student.sponsor, student.ic_no, student.phone_no, student.email
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
            <li style="text-indent: 30px"><a style="background: yellow; color:#522184" href="generaterecord.php"><i class="fa fa-book"></i> Hafazan</a></li>
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

            <div class="container-fluid">
              <div class="card">
                <div class="card-body">
                  <?php

                  if (ISSET($_SESSION['message'])&& $_SESSION['message'] !=''){
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                  }

                   ?>
                  <div class="p-2">
                      <input type="text" class="form-control mr-sm-12 bg-light block" id="myInput" onkeyup="myFunction()" placeholder="&#xf0b0; Filter By Name / Halaqah / Batch / Muqarrar Completion / Muqarrar Status" style="font-family:Arial, FontAwesome" aria-label="Search">

                  </div>
                  <table class="table table-striped col-lg-12" id="myTable">

                    <thead>
                      <tr align="center">
                        <th scope="col">No</th>
                        <th scope="col" onclick="sortTable(1)">Name <i class="fa fa-sort"></i></th>
                        <th scope="col" onclick="sortTable(2)">Halaqah <i class="fa fa-sort"></i></th>
                        <th scope="col" onclick="sortTable(3)">Batch <i class="fa fa-sort"></i></th>
                        <th scope="col" onclick="sortTable(4)">Muqarrar Completion <i class="fa fa-sort"></i></th>
                        <th scope="col">Muqarrar Status</th>
                        <th scope="col">Rank In Halaqah</th>
                        <th scope="col">Rank In Batch</th>
                        <th scope="col" colspan="2">Action</th>

                      </tr>
                    </thead>

                    <tbody>

                      <?php
                      $no=1;
                      while($row=mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<th scope='row' align='center'>".$no."</th>";

                        $stud_id=$row['stud_id'];
                        $stud_name=$row['stud_name'];
                        echo "<td>".'<a href="#view_bio'.$stud_id.'" data-toggle="modal">'.$stud_name.'</a>'."</td>";

                        // Student modal
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
                              echo 'ID: '.$stud_id.'<BR>';
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

                        // End student modal

                        echo "<td align='center'>".$row['halaqah_id']."</td>";
                        $halaqah_id=$row['halaqah_id'];

                        echo "<td align='center'>".$row['batch_id']."</td>";
                        $batch_id=$row['batch_id'];

                        $percent=(($row['page_memorized']/$row['curr_syllabus'])*100);
                        $page_memorized=$row['page_memorized'];
                        $curr_syllabus=$row['curr_syllabus'];
                        echo "<td align='center'><a href='#' data-toggle='tooltip' title='Page Memorized: $page_memorized &#13;Current Muqarrar: $curr_syllabus'>".round($percent,2).'%'."</a></td>";
                        echo "<td align='center'>";
                        echo (setStatus($row['page_memorized'],$row['curr_syllabus']));
                        echo "</td>";

                        echo "<td align='center'>";

                        $sql2="SET @curr_page = NULL";
                        $result2=mysqli_query($con,$sql2);

                        $sql2="SET @rank := 0";
                        $result2=mysqli_query($con,$sql2);

                        $sql2="SELECT stud_id,page_memorized,(
                            CASE
                                WHEN @curr_page = student.page_memorized THEN @rank

                                WHEN @curr_page := student.page_memorized THEN @rank := @rank + 1
                            END) AS Rank
                        		FROM student
                        		WHERE halaqah_id='$halaqah_id'
                        		ORDER BY page_memorized DESC";
                        $result2=mysqli_query($con,$sql2);

                        while($row=mysqli_fetch_array($result2)){
                          if ($stud_id==$row['stud_id']) {
                            $rank_in_halaqah=$row['Rank'];
                            break;
                          }
                        }

                        if ($rank_in_halaqah==NULL) {
                          echo "Not Ranked";
                        }
                        else {
                          echo $rank_in_halaqah;
                        }

                        echo "</td>";

                        echo "<td align='center'>";

                        $sql2="SET @curr_page = NULL";
                        $result2=mysqli_query($con,$sql2);

                        $sql2="SET @rank := 0";
                        $result2=mysqli_query($con,$sql2);

                        $sql2="SELECT stud_id,page_memorized,(
                            CASE
                                WHEN @curr_page = student.page_memorized THEN @rank

                                WHEN @curr_page := student.page_memorized THEN @rank := @rank + 1
                            END) AS Rank
                        		FROM student
                        		WHERE batch_id='$batch_id'
                        		ORDER BY page_memorized DESC";
                        $result2=mysqli_query($con,$sql2);

                        while($row=mysqli_fetch_array($result2)){
                          if ($stud_id==$row['stud_id']) {
                            $rank_in_batch=$row['Rank'];
                            break;
                          }
                        }

                        if ($rank_in_batch==NULL) {
                          echo "Not Ranked";
                        }
                        else {
                          echo $rank_in_batch;
                        }


                        echo "</td>";

                        echo '<td align=\'center\'>'.'<a href="#edit'.$stud_id.'" data-toggle="modal"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popUpWindow5"><i class="fa fa-pencil"></i></button></a>'.'</td>';

                        echo '<div class="modal fade" id="edit'.$stud_id.'">';
                        echo '<div class="modal-dialog">';
                        echo'<div class="modal-content">';


                        echo'<div class="modal-header bg-warning text-white">';

                        echo'<h3 class="modal-title">Edit Student</h3>';
                        echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                        echo'</div>';


                        echo'<div class="modal-body">';
                        echo'<form action="update_stud_bio.php" method="post">';

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
                        echo'<form action="delete_stud.php" method="post">';
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
  </div>
  </body>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </html>
