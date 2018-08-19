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
  $event_id = $_GET['regist'];
  $q = "SELECT event_name FROM `events` WHERE event_id = '$event_id'";
  $q = mysqli_query($mysqli,$q);
  $q = mysqli_fetch_assoc($q);
}
?>
<html>
<head>
	<title>Registrations | <?php echo $q['event_name']; ?> | <?php echo $_SESSION['$first_name']; ?> | ConCat</title>
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
        <a class="nav-link" href="committee_view_events.php">View Events > Registrations > <?php echo $q['event_name']; ?><span class="sr-only">(current)</span></a>
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
<div align="center" class="container"><table class="table table-hover">
    <thead style="background-color: black; color: white;">
      <td>PID</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Contact No.</td>
      <td>Paid</td>
      <td></td>
    </thead>
    <tbody>
    <?php
      $qry = "SELECT * from `attendance` INNER JOIN `users` where users.pid = attendance.pid AND event_id = $event_id GROUP BY users.pid";
      $result = mysqli_query($mysqli,$qry);
      if($result){
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>".$row['pid']."</td><td>".$row['first_name']."</td><td>".$row['last_name']."</td>";
          echo "<td>".$row['cont_num']."</td><td><label class='switch'><input type='checkbox' id='paidtrig".$row['event_id'].$row['pid']."'";
          if($row['paid'] == 1){
            echo " checked";
          } elseif ($row['paid'] == 0) {
            echo "";
          }
          echo "><span class='slider round'></span></label></td><td><button type='submit' id='del".$row['pid']."' class='btn btn-danger'>Delete</button></td></tr>";
          echo "<script type='text/javascript'>
                $(document).ready(function(){
                  $('#paidtrig".$row['event_id'].$row['pid']."').click(function(){
                    $.ajax({
                      type: 'POST',
                      url: 'trig_paid.php',
                      data : {'event_id' : '".$row['event_id']."', 'pid' : '".$row['pid']."'},
                      success: function(){ alert('Successful!');},
                      error: function(){ alert('Unsuccessful!');}
                    });
                  });
                });
              </script>"; 
        }
      }
    ?>
    </tbody>
  </table>
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "registration.php"; ?>