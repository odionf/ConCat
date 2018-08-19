<?php
	include 'db.php';
	session_start();
	if(!isset($_SESSION['$pid'])){
		echo '<script type="text/javascript">alert("Login First!")</script>';
		header("Location: {$_SESSION['$last_page']}");
		exit();
	} else {
		if($_SESSION['$type']!='Administrator'){
			echo '<script type="text/javascript">alert("Only accessible to a Administrator!");</script>';
			header("Location: {$_SESSION['$last_page']}");
			exit();
		}
	}
?>
<?php
  
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo "Events | " . $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | ConCat" ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
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
        <a class="nav-link" href="admin.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="admin_events.php">Events<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_speakers.php">Speakers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_users.php">Users</a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
    <form action="logout.php" method="post" style="float: right; margin: 0;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
    </form>
  </div>
</nav>
<div class="container">
  <table class="table table-hover">
    <thead style="background-color: black; color: white;">
      <td><!--input type="checkbox" name="checkAll" /--></td>
      <td>Event Name</td>
      <td>Committee Name</td>
      <td>Start Date</td>
      <td>End Date</td>
      <td>Event Fee</td>
      <td>Contact Person</td>
      <td>Visibility</td>
      <td></td>
      <td></td>
    </thead>
    <tbody>
    <?php
      $qry = "SELECT * from `events` ORDER BY event_sdate DESC";
      $result = mysqli_query($mysqli,$qry);
      if($result){
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td><!--input type='checkbox' /--></td><td>".$row['event_name']."</td><td>".$row['comm_name']."</td><td>".date('dS M Y',strtotime($row['event_sdate']))."</td><td>".date('dS M Y',strtotime($row['event_edate']))."</td><td>".$row['event_fee']."</td><td>".$row['event_cont']."</td><td>";
          if($row['visibility'] == 1){
            echo "Yes";
          } elseif ($row['visibility'] == 0) {
            echo "No";
          }
          echo "</td><td><form action='edit_event.php?event_id=".$row['event_id']."'><button type='submit' class='btn btn-primary' name='event_id' value='".$row['event_id']."'>Edit</button></form></td><td><form action='edit_event.php' method='post'><button type='submit' class='btn btn-danger' name='event_id' value='".$row['event_id']."'>Delete</button></form></td></tr>";
        }
      }
    ?>
    </tbody>
  </table>
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "admin_events.php"; ?>