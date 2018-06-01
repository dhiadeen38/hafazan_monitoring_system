<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Performance Record</title>
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

  $sql="SELECT student.stud_name,programme.curr_syllabus, student.page_memorized
  FROM programme
  INNER JOIN student
  ON programme.programme_id=student.programme_id
  WHERE student.ic_no='$id' ";

  $result=mysqli_query($con,$sql);
  ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Parent</a></li>
        <li><a style="background: yellow; color:#522184" href="studrecord.php"><i class="fa fa-bar-chart"></i> Performance Record</a></li>
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
              $row=mysqli_fetch_row($result);
              echo '<h2>'.'<center>'.$row[0].'</center>'.'</h2>';
              ?>
              <h3>Hafazan Performance</h3>
              <div class="row">


                <div class="col-lg">
                  <div class="card text-center" style="max-width: 18rem;">
                    <div class="card-header bg-primary text-white">Current Syllabus</div>
                    <div class="card-body">
                      <p class="card-text">
                        <?php echo $row[1];?>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-lg">
                  <div class="card text-center" style="max-width: 18rem;">
                    <div class="card-header bg-info text-white">Page(s) Memorized</div>
                    <div class="card-body">
                      <p class="card-text">
                        <?php echo $row[2];?>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-lg">
                  <div class="card text-center" style="max-width: 18rem;">
                    <div class="card-header bg-danger text-white">Page(s) Left</div>
                    <div class="card-body">
                      <p class="card-text">
                        <?php
                        $pages_left=($row[1]-$row[2]);
                        if ($pages_left==0 || $pages_left <0) {
                          echo '0';
                        } else {
                          echo $pages_left;
                        }

                        ?>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-lg">
                  <div class="card text-center" style="max-width: 18rem;">
                    <div class="card-header bg-warning text-white">Muqarrar Completion</div>
                    <div class="card-body">
                      <p class="card-text">
                        <?php
                        $percent=(($row[2]/$row[1])*100);
                        echo round($percent,2).'%';
                        ?>

                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-lg">
                  <div class="card text-center" style="max-width: 18rem;">
                    <div class="card-header bg-success text-white">Completion Status</div>
                    <div class="card-body">
                      <p class="card-text">
                        <?php
                        echo(setStatus($row[2],$row[1]));
                        ?>
                      </p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <BR>
          <h3>Ranking</h3>
            <div class="row">

              <div class="card col-lg-12">
                <div class="card-body">
                  <table class="table table-sm table-striped">
                    <?php

                    $halaqah="SELECT halaqah_id
                    		FROM student
                    		WHERE ic_no='$id'";
                    $get_halaqah=mysqli_query($con,$halaqah);

                    $row=mysqli_fetch_row($get_halaqah);
                    $halaqah_id=$row[0];

                    $sql2="SET @curr_page = NULL";
                    $result2=mysqli_query($con,$sql2);

                    $sql2="SET @rank := 0";
                    $result2=mysqli_query($con,$sql2);

                    $sql2="SELECT ic_no,page_memorized,
                        CASE
                            WHEN @curr_page = student.page_memorized THEN @rank

                            WHEN @curr_page := student.page_memorized THEN @rank := @rank + 1
                        END
                    		FROM student
                    		WHERE halaqah_id='$halaqah_id'
                    		ORDER BY page_memorized DESC";
                    $result2=mysqli_query($con,$sql2);

                    while($row=mysqli_fetch_array($result2)){
                      if ($id==$row['ic_no']) {
                  			$rank_in_halaqah=$row[2];
                        break;
                  		}
                    }

                    $batch="SELECT batch_id
                    		FROM student
                    		WHERE ic_no='$id'";
                    $get_batch=mysqli_query($con,$batch);

                    $row=mysqli_fetch_row($get_batch);
                    $batch_id=$row[0];

                    $sql2="SET @curr_page = NULL";
                    $result2=mysqli_query($con,$sql2);

                    $sql2="SET @rank := 0";
                    $result2=mysqli_query($con,$sql2);

                    $sql2="SELECT ic_no,page_memorized,
                        CASE
                            WHEN @curr_page = student.page_memorized THEN @rank

                            WHEN @curr_page := student.page_memorized THEN @rank := @rank + 1
                        END
                    		FROM student
                    		WHERE batch_id='$batch_id'
                    		ORDER BY page_memorized DESC";
                    $result2=mysqli_query($con,$sql2);

                    while($row=mysqli_fetch_array($result2)){
                      if ($id==$row['ic_no']) {
                  			$rank_in_batch=$row[2];
                        break;
                  		}
                    }

                    $sql3="SELECT  (
                                  SELECT COUNT(student.stud_name)
                                  FROM   student
                            WHERE student.halaqah_id='$halaqah_id'
                                ) AS no_in_halaqah,
                                (
                                  SELECT COUNT(student.stud_name)
                                  FROM student
                                  WHERE student.batch_id='$batch_id'
                                ) AS no_in_batch";

                    $result3=mysqli_query($con,$sql3);
                    $row=mysqli_fetch_row($result3);
                    ?>
                    <tbody>
                      <tr>
                        <th scope="row">Within Halaqah</th>
                        <td>
                          <?php
                          echo $rank_in_halaqah."/".$row[0];
                          ?>
                        </td>
                        <td><input type="button" class="btn  btn-warning btn-sm" onClick="location.href='rankinhlqh.php'" value="View in Table"></td></td>
                      </tr>
                      <tr>
                        <th scope="row">Within Batch</th>
                        <td>
                          <?php
                          echo $rank_in_batch."/".$row[1];
                          ?>
                        </td>
                        <td><input type="button" class="btn  btn-warning btn-sm" onClick="location.href='rankinbtch.php'" value="View in Table"></td>
                      </tr>

                    </tbody>
                  </table>

                </div>

              </div>
              <div>
                <BR>
                  <a class="btn btn-light btn-sm hidden-print" href="printrecord.php" target="_blank">Print Record</a>
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
