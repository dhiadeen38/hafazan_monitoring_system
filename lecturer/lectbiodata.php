<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Biodata</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/sidebar.css">
</head>

<body>
  <?php
  session_start();
  $id=$_SESSION["username"];
  $con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $sql="Select * FROM lecturer WHERE lect_id='$id'";
  $result=mysqli_query($con,$sql);

  $pic_sql="SELECT profile_pic
  FROM lecturer
  WHERE lect_id='$id'";
  $pic_result=mysqli_query($con,$pic_sql);

  $student = $pic_result->fetch_assoc();
  $profile_pic = $student['profile_pic'];
  ?>
  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Lecturer</a></li>
        <li><a style="background: yellow; color:#522184" href="lectbiodata.php"><i class="fa fa-user"></i> Biodata</a></li>
        <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><i class="fa fa-spinner"></i> My Halaqah</a>
          <ul class="sidebar-nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
            <li style="text-indent: 30px"><a href="myhalaqah.php"><i class="fa fa-bar-chart"></i> Records</a></li>

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
              <?php

              if (ISSET($_SESSION['message'])&& $_SESSION['message'] !=''){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
              }

               ?>
              <div class="card-deck col-lg-12">

                  <div class="card col-lg-4 ml-0">
                    <div class="card-body bg-light mt-3 mb-3 text-center">
        							<form action="upload.php" method="post" enctype="multipart/form-data">

        							<?php

        							if ($profile_pic == NULL){
        								echo "<p align='center'><img src='Image-not-available.jpg' width='180'></p>";
        							}
        							else {
        								echo "<p align='center'><img src='" . $profile_pic . "' width='180'></p>";
        							}

        							 ?>
        							 <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">

        						</div>
        						<div class="custom-file bg-primary mb-3 rounded text-white text-center">

        								<a href=""><label class="custom-file-label mt-2 text-white" for="fileToUpload">Choose File</label></a>

        								<input type="submit" class="btn btn-sm mb-1" value="Upload" name="submit">
        							</form>

        						</div>
                  </div>
                  <div class="card ml-0">
                    <div class="card-header bg-primary text-white">Biodata</div>
                    <div class="card-body">
                      <?php

                      $row=mysqli_fetch_row($result);
                      echo '<table class="table table-sm table-striped">';
                      echo '<tbody>';

                      echo '<tr align="left">';
                      echo '<th scope="row">'.'Full Name'.'</th>';
                      echo '<td class="w-75">'.$row[0].'</th>';
                      echo '</tr>';

                      echo '<tr align="left">';
                      echo '<th scope="row">'.'Gender'.'</th>';
                      echo '<td>'.$row[1].'</th>';
                      echo '</tr>';

                      echo '<tr align="left">';
                      echo '<th scope="row">'.'Lecturer ID'.'</th>';
                      echo '<td>'.$row[2].'</th>';
                      echo '</tr>';

                      echo '<tr align="left">';
                      echo '<th scope="row">'.'IC No'.'</th>';
                      echo '<td>'.substr($row[3],0,6).'-'.substr($row[3],-6,-4).'-'.substr($row[3],8).'</th>';
                      echo '</tr>';

                      echo '<tr align="left">';
                      echo '<th scope="row">'.'Contact No'.'</th>';
                      echo '<td>'.substr($row[4],0,3).'-'.substr($row[4],3).'</th>';
                      echo '</tr>';

                      echo '<tr align="left">';
                      echo '<th scope="row">'.'Email'.'</th>';
                      echo '<td>'.$row[5].'</th>';
                      echo '</tr>';

                      echo '</tbody>';
                      echo '</table>';

                      ?>
                      <a href="#edit<?php echo $row[1]; ?>" data-toggle="modal"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popUpWindow">Update</button></a>

    									<div class="modal fade" id="edit<?php echo $row[1]; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <!-- header -->
                            <div class="modal-header">

                              <h3 class="modal-title">Update Biodata</h3>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- body (form) -->
                            <div class="modal-body">
                              <form action="update_bio.php" method="post">

                                <div class="form-group row">
                                  <label for="name" class="col-sm-3 col-form-label">Phone No</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="phone_no" class="form-control" id="phone_no" placeholder="Phone" value="<?php echo $row[4]; ?>">
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="id" class="col-sm-3 col-form-label">Email</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $row[5]; ?>">
                                  </div>
                                </div>
                              </div>

                              <!-- button -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
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
