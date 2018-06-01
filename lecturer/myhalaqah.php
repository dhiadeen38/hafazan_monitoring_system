<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>My Halaqah</title>
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
  <script type="text/javascript" src="../script/print.js"></script>

</head>

<body>
  <?php
  session_start();
  $id=$_SESSION["username"];
  $con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $get_syllabus="Select programme_id, curr_syllabus FROM programme";
  $curr_page=mysqli_query($con,$get_syllabus);

  $sql="Select halaqah_id FROM halaqah WHERE lect_id='$id' ";
  $result=mysqli_query($con,$sql);

  $sql2="SET @curr_page = NULL";
  $result2=mysqli_query($con,$sql2);

  $sql2="SET @rank := 0";
  $result2=mysqli_query($con,$sql2);

  $sql2="SELECT student.stud_id,student.stud_name, student.page_memorized, student.batch_id, programme.curr_syllabus,(
      CASE
          WHEN @curr_page = student.page_memorized THEN @rank

          WHEN @curr_page := student.page_memorized THEN @rank := @rank + 1
      END) AS Rank
  FROM student
  INNER JOIN programme
  ON student.programme_id=programme.programme_id
  INNER JOIN halaqah
  ON student.halaqah_id=halaqah.halaqah_id
  WHERE halaqah.lect_id='$id'
  ORDER BY student.page_memorized DESC";
  $result2=mysqli_query($con,$sql2);

  ?>
  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Lecturer</a></li>
        <li><a href="lectbiodata.php"><i class="fa fa-user"></i> Biodata</a></li>
        <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><i class="fa fa-spinner"></i> My Halaqah</a>
          <ul class="sidebar-nav" id="submenu1" role="menu" aria-labelledby="btn-1">
            <li style="text-indent: 30px"><a style="background: yellow; color:#522184" href="myhalaqah.php"><i class="fa fa-bar-chart"></i> Records</a></li>

          </ul>
        </li>
        <li><a href="changepwdlect.php"><i class="fa fa-refresh"></i> Change password</a></li>
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
          <div class="card col-lg-12">
            <div class="card-body">
              <?php
              echo '<div class="row justify-content-between">';
              echo '<div class="col-lg-6">';
              $row=mysqli_fetch_row($result);
              echo "<h3>".'Halaqah ID : '.$row[0]."</h3>";
              echo '</div>';

              echo '<div class="col-lg-6 text-center">';
              echo 'Current Muqarrar'.'<BR>';
              while($row=mysqli_fetch_array($curr_page)){

                echo '<strong>'.$row[0].' : '.'</strong>'.$row[1].' ';

              }
              echo '</div>';
              echo '</div>';
              echo '<table class="table table-striped col-lg-12" id="myTable">';

              $no=1;
              echo '<thead>';
              echo '<tr align="center">';
              echo '<th scope="col">'.'No'.'</th>';
              echo '<th scope="col" onclick="sortTable(1)">'.'Student Name'.'</th>';
              echo '<th scope="col" onclick="sortTable(2)">'.'Page(s) Memorized'.'</th>';
              echo '<th scope="col" onclick="sortTable(3)">'.'Page(s) Left'.'</th>';
              echo '<th scope="col" onclick="sortTable(4)">'.'Muqarrar Completion'.'</th>';
              echo '<th scope="col" onclick="sortTable(5)">'.'Completion Status'.'</th>';
              echo '<th scope="col" onclick="sortTable(6)">'.'Rank In Halaqah'.'</th>';
              echo '<th scope="col" onclick="sortTable(7)">'.'Rank In Batch'.'</th>';
              echo '<th scope="col">'.'Action'.'</th>';
              echo '</tr>';
              echo '</thead>';

              echo '<tbody>';
              while($row=mysqli_fetch_array($result2)){

                echo "<tr>";
                echo "<th scope='row' align='center'>".$no."</th>";
                echo "<td>".$row['stud_name']."</td>";

                echo "<td align='center'>".$row['page_memorized']."</td>";
                echo "<td align='center'>".($row['curr_syllabus']-$row['page_memorized'])."</td>";

                $percent=(($row['page_memorized']/$row['curr_syllabus'])*100);

                echo "<td align='center'>".round($percent,2).'%'."</td>";
                echo "<td align='center'>";
                echo (setStatus($row['page_memorized'],$row['curr_syllabus']));
                echo "</td>";

                $batch_id=$row['batch_id'];
                $stud_id=$row['stud_id'];
                $page_memorized=$row['page_memorized'];

                echo "<td align='center'>".$row['Rank']."</td>";

                echo "<td align='center'>";

                $sql3="SET @curr_page = NULL";
                $result3=mysqli_query($con,$sql3);

                $sql3="SET @rank := 0";
                $result3=mysqli_query($con,$sql3);

                $sql3="SELECT stud_id,page_memorized,(
                    CASE
                        WHEN @curr_page = student.page_memorized THEN @rank

                        WHEN @curr_page := student.page_memorized THEN @rank := @rank + 1
                    END) AS Rank
                		FROM student
                		WHERE batch_id='$batch_id'
                		ORDER BY page_memorized DESC";
                $result3=mysqli_query($con,$sql3);

                while($row=mysqli_fetch_array($result3)){
                  if ($stud_id==$row['stud_id']) {
                    $rank_in_batch=$row[2];
                    break;
                  }
                }
                echo $rank_in_batch;
                echo "</td>";

                echo '<td align=\'center\'>'.'<a href="#edit'.$stud_id.'" data-toggle="modal"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#popUpWindow5"><i class="fa fa-pencil"></i></button></a>'.'</td>';

                echo '<div class="modal fade" id="edit'.$stud_id.'">';
                echo '<div class="modal-dialog">';
                echo'<div class="modal-content">';


                echo'<div class="modal-header">';

                echo'<h3 class="modal-title">Update Page Memorized</h3>';
                echo'<button type="button" class="close" data-dismiss="modal">&times;</button>';
                echo'</div>';


                echo'<div class="modal-body">';
                echo'<form action="update_record.php" method="post">';

                echo'<div class="form-group row">';
                echo'<label for="curr_page" class="col-sm-6 col-form-label">Current Page</label>';
                echo'<div class="col-sm-6">';
                echo'<input type="text" name="curr_page" class="form-control" id="curr_page" placeholder="Page Memorized" value="'.$page_memorized.'">';
                echo'</div>';
                echo'</div>';

                echo'<div class="form-group row" style="display: none;">';
                echo'<label for="id" class="col-sm-3 col-form-label">Programme ID</label>';
                echo'<div class="col-sm-9">';
                echo'<input type="text" name="id" class="form-control" id="id" placeholder="ID" value="'.$row['stud_id'].'">';
                echo'</div>';
                echo'</div>';
                echo'</div>';

                echo'<div class="modal-footer">';
                echo'<button type="submit" class="btn btn-warning btn-block">Submit</button>';
                echo'</form>';
                echo'</div>';

                echo "</tr>";
                $no=($no + 1);
              }
              echo '</tbody>';
              echo '</table>';

              ?>

              </div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-white">
          <button class="btn btn-light btn-sm btn-block hidden-print" onclick="myFunction()"><i class="fa fa-print"></i> Print Record</button>
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
