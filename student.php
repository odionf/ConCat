<?php
	session_start();
	if(!isset($_SESSION['$pid'])){
		echo '<script type="text/javascript">alert("Login First!")</script>';
		header("Location: {$_SESSION['$last_page']}");
		exit();
	} else {
		if($_SESSION['$type']!='Student'){
			echo '<script type="text/javascript">alert("Only accessible to a student!");</script>';
			header("Location: {$_SESSION['$last_page']}");
			exit();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | ConCat"; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body style="background-color: #e8f0ff;">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 9999; width: 100%">
  		<a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" style="margin-bottom: 5px" alt="ConCat"> ConCat</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="studentinfo.php">Edit Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="review.php">Review</a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
	<form action="logout.php" method="post" style="float: right;">
	    <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
	</form>
  </div>
</nav>
 
  </div>
</nav>
  <div id="mainbox" class="container-fluid">
    <div style="width: 90%; margin-top: 1%">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group" style="float: right; width: 100% display: inline-block;">
        <div style="float: left;">
          <label for="sel1" style="text-align: center; margin: 5px;">Select Committee:</label>
          </div>
          <div style="float: left;"><select class="form-control" id="sel1" name="valueToSearch">
            <option value="">All</option>
            <?php 
           
            include 'db.php';
            if(isset($_POST['search'])){
              $search = $_POST['valueToSearch'];
            } else {
              $search = '';
            }
            $qry="SELECT distinct comm_name from `events` WHERE visibility='1'";
            $res=mysqli_query($mysqli,$qry);
            
               
                while ($r=mysqli_fetch_assoc($res)) {
                if ($r['comm_name']==$search) {
                  echo "<option value='".$r['comm_name']."' selected>".$r['comm_name']."</option>";
                  }
                  else {
                echo "<option value='".$r['comm_name']."'>".$r['comm_name']."</option>";
                  }
               }
            
            ?>  
          </select></div>
          <div style="float: left;">&nbsp;<button type="submit" class="btn btn-primary" style="float: right;" name="search" >Find</button></div>       
        </div>
      </form>
    </div>
  <?php
    
    $qry = "SELECT * FROM `events` INNER JOIN `speakers` WHERE events.speaker_id = speakers.speaker_id AND events.visibility = '1' AND events.comm_name LIKE '%$search%' ORDER BY events.event_sdate";
    $result = mysqli_query($mysqli,$qry);
    if (!$result) {
      echo "<div class = 'container-fluid' style = 'text-align: center; margin: 20px;'><h1>No Events found!</h1></div>";
    } else  {
      while ($row = mysqli_fetch_assoc($result)) {
        if(strtotime('today')<strtotime($row['event_sdate'])){
          echo
          "<div class='card col-md-4' id='card-resp' style='float: left; padding: 15px; margin: 2%; align-items: center'>
            <img src = 'img/" . $row['comm_name'] . "_logo.jpg' alt='" . $row['comm_name'] . "' style='width:200px; height:200px; border-radius: 100px;' align={center}>
            <br>
            <h2>".$row['event_name']."</h2>
            <p class='title'>" . $row['speaker_fname']. " " . $row['speaker_lname'] . "</p>
            <p>";
            if($row['event_sdate']!=$row['event_edate']) { echo date('dS M Y',strtotime($row['event_sdate'])) . " to " . date('dS M Y',strtotime($row['event_edate'])); } else { echo date('dS M Y',strtotime($row['event_sdate'])); }
            echo "</p>
           <p style='width:100%'><form method='post' action='view_event.php?event_id=".$row['event_id']."'><button class='btn btn-primary' type='submit' name='event_id' value='".$row['event_id']."'>More Information</button></form></p>
          </div>";
        }
        }
      }
  ?>
  </div>
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "student.php"; ?>