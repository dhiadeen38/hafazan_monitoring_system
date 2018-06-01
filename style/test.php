<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Generate record</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

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
  <script>
  $(document).on('click', '.del_btn', function(){
           var id=$(this).data("id3");
           if(confirm("Are you sure you want to delete this?"))
           {
                $.ajax({
                     url:"delete.php",
                     method:"POST",
                     data:{stud_id:stud_id},
                     dataType:"text",
                     success:function(data){
                          alert(data);
                          fetch_data();
                     }
                });
           }
      });
  </script>
</head>

<body>
  <?php

  $con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $sql="SELECT programme.curr_syllabus, student.stud_name, student.stud_id, student.halaqah_id, student.batch_id, student.page_memorized
  FROM programme
  INNER JOIN student
  ON programme.programme_id=student.programme_id";
  $result=mysqli_query($con,$sql);
  ?>
  <div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#">Admin</a></li>
        <li><a href="createuser.php">Create user</a></li>
        <li><a href="managehalaqah.php">Manage halaqah</a></li>
        <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">Generate record</a>
          <ul class="sidebar-nav" id="submenu1" role="menu" aria-labelledby="btn-1">
            <li><a href="overview.php">-Overview</a></li>
            <li><a style="background: yellow; color:#522184" href="generaterecord.php">-Search</a></li>
            <li><a href="allrecords.php">-All Records</a></li>

          </ul>
        </li>
        <li><a href="changepwdadmin.php">Change password</a></li>
        <li><a href="../homepage/logout.php">Logout</a></li>
      </ul>
    </div>

    <!--Content header-->
    <div id="page-content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            Kalam Ulama<BR>
            </div>
          </div>
        </div>
      </div>

      <!-- Page content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="text-info">Assalamulaikum w.b.t</h1>

              <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
              </form>

              <BR>

                  <div class="container-fluid">
                    <table class="col-lg-12" border='1' id="myTable">
                      <?php
                      $no=1;
                      $curr_page=0;
                      $prev_page=0;
                      $temp=1;
                      echo '<thead>';
                      echo '<tr class="bg-info" align="center">';
                      echo '<th>'.'No'.'</th>';
                      echo '<th>'.'Name'.'</th>';
                      echo '<th>'.'Student ID'.'</th>';
                      echo '<th>'.'Halaqah'.'</th>';
                      echo '<th>'.'Batch'.'</th>';
                      echo '<th>'.'Muqarrar Completion'.'</th>';
                      echo '<th>'.'Muqarrar Status'.'</th>';
                      echo '<th>'.'Rank In Halaqah'.'</th>';
                      echo '<th>'.'Rank In Batch'.'</th>';
                      echo '<th colspan="2">'.'Action'.'</th>';
                      echo '</tr>';
                      echo '</thead>';

                      function setStatus($x){
                        $x=$x;
                        if($x==100 ||$x>100){
                          echo "Completed";
                        }

                        else if($x<100 && $x>0){
                          echo "Ongoing";
                        }

                        else if($x==0 ||$x<0){
                          echo "Behind Schedule";
                        }
                      }
                      echo '<tbody>';
                      while($row=mysqli_fetch_array($result)){
                        echo "<tr class='bg-warning'>";
                        echo "<td align='center'>".$no."</td>";
                        echo "<td>".$row['stud_name']."</td>";
                        echo "<td>".$row['stud_id']."</td>";
                        echo "<td align='center'>".$row['halaqah_id']."</td>";
                        echo "<td align='center'>".$row['batch_id']."</td>";

                        $percent=(($row['page_memorized']/$row['curr_syllabus'])*100);

                        echo "<td align='center'>".$percent.'%'."</td>";
                        echo "<td align='center'>";
                        echo (setStatus($percent));
                        echo "</td>";
                        $curr_page=$row['page_memorized'];
                        $prev_page=$row['page_memorized'];
                        /*
                        if

                        */
                        echo "<td align='center'>".$temp."</td>";
                        echo "<td align='center'>".$temp."</td>";
                        echo '<td align=\'center\'>'.'<a href="">Edit'.'</td>';
                        echo '<td align=\'center\' name=\'del_btn\' data-id3=\'$row[\'stud_id\']\'>'.'<a href="delete.php">Delete'.'</td>';
                        echo "</tr>";
                        $no=($no + 1);
                      }
                      echo '</tbody>';

                      ?>
                    </table>
                    <BR>

                      <BR><BR>

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
