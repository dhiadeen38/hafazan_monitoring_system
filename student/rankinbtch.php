<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Ranking In Batch</title>
  <?php include '../script/setStatus.php';?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/sidebar.css">
  <script type="text/javascript" src="../script/print.js"></script>
</head>

<body>
  <?php
  session_start();
  $id=$_SESSION["username"];
  $con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $batch="SELECT batch_id
  		FROM student
  		WHERE stud_id='$id'";
  $get_batch=mysqli_query($con,$batch);

  $row=mysqli_fetch_row($get_batch);
  $batch_id=$row[0];

  $sql="SET @curr_page = NULL";
  $result=mysqli_query($con,$sql);

  $sql="SET @rank := 0";
  $result=mysqli_query($con,$sql);

  $sql="SELECT stud_name,stud_id,halaqah_id,page_memorized,(
      CASE
          WHEN @curr_page = student.page_memorized THEN @rank

          WHEN @curr_page := student.page_memorized THEN @rank := @rank + 1
      END) AS Rank
  		FROM student
  		WHERE batch_id='$batch_id'
  		ORDER BY page_memorized DESC";
  $result=mysqli_query($con,$sql);
  ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Student</a></li>
        <li><a href="studbiodata.php"><i class="fa fa-user"></i> Biodata</a></li>
        <li><a style="background: yellow; color:#522184" href="studrecord.php"><i class="fa fa-bar-chart"></i> Performance Record</a></li>
        <li><a href="studachievements.php"><i class="fa fa-graduation-cap"></i> Achievements</a></li>
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
        <nav class="card-body" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="studrecord.php">Performance Record</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ranking In Batch</li>
          </ol>
        </nav>
      </div>
      <div class="card row">
        <div class="card-body col-lg-12">
          <center><h1>Ranking In Batch</h1><center>

          <table class="table table-hover">
          <thead>
            <tr align='center'>
            <th>Rank</th>
            <th>Name</th>
            <th>ID</th>
            <th>Halaqah</th>
            <th>Page Memorized</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=1;

              while($row=mysqli_fetch_array($result)){

                echo "<tr>";
                echo "<td align='center'>";
                if ($row['Rank']==NULL) {
                  echo "Not Ranked";
                }
                else {
                  echo $row['Rank'];
                }

                "</td>";

                echo "<td>";
                if ($id==$row['stud_id']) {
                  echo $row['stud_name'];
                }
                else {
                  echo "xxx";
                }

                echo "</td>";

                echo "<td align='center'>";
                if ($id==$row['stud_id']) {
                  echo $row['stud_id'];
                }
                else {
                  echo "xxx";
                }

                echo "</td>";
                echo "<td align='center'>".$row['halaqah_id']."</td>";
                echo "<td align='center'>".$row['page_memorized']."</td>";

                echo "</tr>";

              }
             ?>

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
