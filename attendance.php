<?php
  session_start();
  if(!isset($_SESSION['$pid'])){
    echo '<script type="text/javascript">alert("Login First!")</script>';
  } elseif($_SESSION['$type']!='Committee') {
      echo '<script type="text/javascript">alert("Only accessible to a student!");</script>';
      header("Location: {$_SESSION['$last_page']}");
      exit();
    }
    else {
  include 'db.php';
  $event_id = $_GET['attendance'];
  $qry = mysqli_query($mysqli,"SELECT * FROM `events` WHERE event_id = $event_id");
  $qry = mysqli_fetch_assoc($qry);
  $event_name = $qry['event_name'];
  $diff = abs(strtotime($qry['event_sdate'])-strtotime($qry['event_edate']))/24/60/60;
}
?>
<html>
<head>
	<title>Attendance | <?php echo $event_name." | ".$_SESSION['$first_name'] ?> | ConCat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <style type="text/css">
    .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 26px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 2px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 30px;
}

.slider.round:before {
  border-radius: 50%;
}
  </style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 999;">
  		<a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" alt="ConCat" style="margin-bottom: 5px;"> ConCat</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="committee.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_event.php">Add Event</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_speaker.php">Add Speaker</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="committee_view_events.php">View Events > Attendance > <?php echo $event_name; ?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="view_suggestions.php">View Suggestions</a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <a href="committee_info.php" style="color: inherit;"><u><i><?php echo $_SESSION['$first_name']; ?></i></u></a></div>
    <form action="logout.php" method="post" style="float: right; margin: 0;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
    </form>
  </div>
</nav>
<nav class="navbar navbar-inverse bg-inverse" style="background-color: #39414f">
<?php
  for($x=0;$x<=$diff;$x++){
    $y=$x+1;
    echo '<div class="" style="width: 25%;padding: 2px;"><button id="btncollapse'.$y.'" class="btn btn-secondary" style="background-color: #39414f;width: 100%;" href="#collapse1">Day '.$y.'</button></div>';
  }
?>
  </nav>
<div align="center" class="container">
  <?php
  for($x=0;$x<=$diff;$x++){
    $y=$x+1;
  echo '<table class="table table-hover" id="collapse'.$y.'" style="text-align:center; ';if($y!=1){echo "display:none;";}echo '">
    <thead style="background-color: black; color: white;">
      <td>PID</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Contact No.</td>
      <td style="text-align: center;">Attendance</td>
    </thead>
    <tbody>';
      $qry = "SELECT * from `attendance` INNER JOIN `users` where users.pid = attendance.pid AND event_id = $event_id AND attendance.paid = 1 AND event_day = $y ORDER BY users.pid";
      $result = mysqli_query($mysqli,$qry);
      if($result){
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>".$row['pid']."</td><td>".$row['first_name']."</td><td>".$row['last_name']."</td>";
          echo "<td>".$row['cont_num']."</td><td style='justify-content:center;'><label class='switch'><input type='checkbox' id='attendtrig".$row['event_id'].$row['pid'].$y."'";
          if($row['attended'] == 1){
            echo " checked";
          } elseif ($row['attended'] == 0) {
            echo "";
          }
          echo "><span class='slider round'></span></label>";
          echo "<script type='text/javascript'>
                $(document).ready(function(){
                  $('#attendtrig".$row['event_id'].$row['pid'].$y."').click(function(){
                    $.ajax({
                      type: 'POST',
                      url: 'trig_attend.php',
                      data : { 'event_id' : '".$row['event_id']."' , 'pid' : '".$row['pid']."' , 'event_day' : '".$y."'},
                      success : function(){alert('Successful!');},
                      error : function(){alert('Unsuccessful!');},
                    });
                  });
                });
              </script>";
        }
      }
    echo '</td></tr>
    </tbody>
  </table><script type="text/javascript">
  $(document).ready(function(){
    $("#btncollapse'.$y.'").click(function(){
      $("#collapse'.$y.'").delay(400).fadeIn();';
      for($a=0;$a<=$diff;$a++){
        $b=$a+1;
        if($b!=$y){
          echo '$("#collapse'.$b.'").delay(0).fadeOut();';
        }
      }
    echo '});
  });
</script>';
  }
  ?>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#btncollapse1').click(function(){
      $('#collapse1').delay(400).fadeIn();
      $('#collapse2').delay(0).fadeOut();
      $('#collapse3').delay(0).fadeOut();
    });
  });
</script>
</body>
</html>
<?php $_SESSION['$last_page'] = "attendance.php"; ?>