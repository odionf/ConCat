<?php
	require 'db.php';
	session_start();
	if (!isset($_SESSION['$pid'])) {
		echo "<script>alert('Login First!'); window.location.href = '".$_SESSION['$last_page']."'</script>";
		exit();
	} else {
		if(!in_array($_SESSION['$type'], array('Committee','Administrator'))) {
			echo "<script>alert('You are not priveilaged to edit event!'); window.location.href = '".$_SESSION['$last_page']."'</script>";
			exit();
    }
  }
?>
<?php
  if(!isset($_SESSION['submit'])){
    $eid = $_GET['event_id'];
    $qry = "SELECT * FROM `events` INNER JOIN `speakers` where events.event_id = $eid and events.speaker_id = speakers.speaker_id";
    $result = $mysqli->query($qry);
    if ($result) {
      $row = mysqli_fetch_assoc($result);
      $ename = $row['event_name'];
      $sid = $row['speaker_id'];
      $esdate = $row['event_sdate'];
      $eedate = $row['event_edate'];
      $estime = $row['event_stime'];
      $eetime = $row['event_etime'];
      $edesc = $row['event_desc'];
      $efee = $row['event_fee'];
      $econt = $row['event_cont'];
      $sfname = $row['speaker_fname'];
      $slname = $row['speaker_lname'];
      $avgrating = $row['avg_rating'];
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Event | <?php echo $ename; ?> | <?php echo $_SESSION['$first_name'] ?> | ConCat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.2.1.js"></script>
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
        		<a class="nav-link" href="<?php if($_SESSION['$type'] == 'Committee'){ echo 'committee.php';} elseif($_SESSION['$type'] == 'Administrator'){ echo 'admin.php';}?>">Home</a>
      		</li>
          <?php if($_SESSION['$type'] == "Committee"){
      		echo '<li class="nav-item">
        		<a class="nav-link" href="add_event.php">Add Event</a>
      		</li>
      		<li class="nav-item">
        		<a class="nav-link" href="add_speaker.php">Add Speaker</a>
      		</li>
          <li class="nav-item active">
            <a class="nav-link" href="committee_view_events.php">View Events > Edit > '.$ename.'<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="view_suggestions.php">View Suggestions</a>
          </li>';
          } elseif ($_SESSION['$type'] == "Administrator") {
          echo '<li class="nav-item active">
                  <a class="nav-link" href="admin_events.php">Events > Edit > '.$ename.'<span>class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin_speakers.php">Speakers</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin_users.php">Users</a>
                </li>';
          } ?>
    	</ul>
    	<div class = "navbar-text"> Signed in as <a href="committee_info.php" style="color: inherit;"><u><i><?php echo $_SESSION['$first_name']; ?></i></u></a></div>
    	<form action = "logout.php" method="post" style="float: right; margin: 0;">
      		<button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
    	</form>
  	</div>
</nav>
<div class="container card" style="margin-top: 50px; padding: 30px;">
	<form method="post" action="update_event.php?eid=<?php echo $eid; ?>">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="event_name">Event Name</label>
      <input type="text" class="form-control" id="event_name" name="event_name" value="<?php echo $ename; ?>" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="mr-sm-2" for="speaker_id">Speaker</label><br>
	  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" style="width: 100%;" id="speaker_id" name="speaker_id" required>
	    <?php
	    include 'db.php';
		$qry = "SELECT * FROM `speakers`";
		$result = mysqli_query($mysqli,$qry);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
	    	echo "<option value=";
        echo $row['speaker_id'];
        if (in_array($row['speaker_id'], array($sid))){
          echo " selected";
        }
        echo ">".$row['speaker_fname']."&nbsp;".$row['speaker_lname']." (Average Rating ~ ".$row['avg_rating'].")</option>";
			}
		}
	    ?>
	  </select>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3 mb-3">
      <label for="event_fee">Fees</label>
      <input type="text" class="form-control" id="event_fee" placeholder="Event Fee" name="event_fee" value="<?php echo $efee; ?>" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="event_contact">Contact Person</label>
      <input type="text" class="form-control" id="event_contact" placeholder="Contact No." name="event_contact" value="<?php echo $econt; ?>" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="event_sdate">Start Date of the Event</label>
      <input type="date" class="form-control" id="event_sdate" name="event_sdate" value="<?php echo $esdate; ?>" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="event_edate">End Date of the Event</label>
      <input type="date" class="form-control" id="event_edate" name="event_edate" value="<?php echo $eedate; ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3 mb-3">
      <label for="event_stime">Start Time :</label>
      <input type="time" class="form-control" id="event_stime" name="event_stime" value="<?php echo $estime; ?>" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="event_etime">End Time :</label>
      <input type="time" class="form-control" id="event_etime" name="event_etime" value="<?php echo $eetime; ?>" required>
    </div>
  </div>
  <div class="row">
  	<div style="width: 100%; margin: 5px 15px;">
      <label for="event_desc">Event Description</label>
      <div class="form-group">
	    <textarea class="form-control" id="event_desc" name="event_desc" style="width: 100%;" rows="3"><?php echo $edesc; ?></textarea>
	  </div>
  	</div>
	</div>
  <br>
  <div class="row" style="align-items: center; width: 100%">
  	<button class="btn btn-primary" type="submit" name="submit">UPDATE</button>
  </div>
</form>
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "edit_event.php?event_id=".$_GET['event_id']; ?>