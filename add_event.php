<?php
	require 'db.php';
	session_start();
	if (!isset($_SESSION['$pid'])) {
		echo "Login First!";
		exit();
	} else {
		if ($_SESSION['$type']!='Committee') {
			echo "Only Committee can add events";
			exit();
		}
	}
?>
<?php
	if (isset($_POST['submit'])) {
		include 'db.php';
    $imgsize = getimagesize($_FILES['event_img']['tmp_name']);
    if($imgsize == FALSE){
      echo "Please select an image.";
    } else {
      $image = addslashes($_FILES['event_img']['tmp_name']);
      $name = addslashes($_FILES['event_img']['name']);
      $image = file_get_contents($image);
      $image = base64_encode($image);
    }
		if ($_POST["event_sdate"]>$_POST['event_edate']) {
			echo "<script>alert('Start date cannot be after End Date!'); window.location.href = 'add_event.php';</script>";
		} elseif($_POST['event_sdate']<=date("Y-m-d",strtotime("-1 day",strtotime("Today")))){
      echo "<script>alert('Day already passed. Choose a newer date!'); window.location.href = 'add_event.php';</script>";
    } else {
        $sql = "INSERT INTO `events` (`comm_name`,`event_name`,`speaker_id`,`event_sdate`,`event_edate`,`event_stime`,`event_etime`,`event_desc`,`event_image`,`event_fee`,`cont_name`,`event_cont`) VALUES ('".$_SESSION['$first_name']."','".$_POST["event_name"]."','".$_POST["speaker_id"]."','".$_POST['event_sdate']."','".$_POST['event_edate']."','".$_POST["event_stime"]."','".$_POST["event_etime"]."','".$_POST["event_desc"]."','".$image."','".$_POST["event_fee"]."','".$_POST['event_cont_name']."','".$_POST["event_contact"]."')";
        $sql = $mysqli->query($sql);
        if ($sql) {
        	echo "<script>alert('Event Successfully Added!');</script>";
        } else {
        	echo "<script>alert('Error in Adding Event!');</script>";
        }
    }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Event | <?php echo $_SESSION['$first_name'] ?> | ConCat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
  $(function() {
      $("#event_img").on("change", function()
      {
          var files = !!this.files ? this.files : [];
          if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
   
          if (/^image/.test( files[0].type)){ // only image file
              var reader = new FileReader(); // instance of the FileReader
              reader.readAsDataURL(files[0]); // read the local file
   
              reader.onloadend = function(){ // set image data as background of div
                  $("#imagePreview").css("display","flex");
                  $("#imagePreview").css("background-image", "url("+this.result+")");
              }
          }
      });
  });
  </script>
  <style>
  #imagePreview {
    width: 500px;
    height: 500px;
    background-position: center center;
    background-repeat: no-repeat;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
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
			<li class="nav-item ">
        <a class="nav-link" href="committee.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="add_event.php">Add Event</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_speaker.php">Add Speaker</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="committee_view_events.php">View Events</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="view_suggestions.php">View Suggestions</a>
      </li>
    	</ul>
    	<div class = "navbar-text"> Signed in as <a href="committee_info.php" style="color: inherit;"><u><i><?php echo $_SESSION['$first_name']; ?></i></u></a></div>
    	<form action = "logout.php" method="post" style="float: right; margin: 0;">
      		<button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
    	</form>
  	</div>
</nav>
<div class="container card" style="margin-top: 50px; padding: 30px;">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="event_name">Event Name</label>
      <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Event name" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="mr-sm-2" for="speaker_id">Speaker</label><br>
	  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" style="width: 100%;" id="speaker_id" name="speaker_id">
	    <option selected>Choose...</option>
	    <?php
	    include 'db.php';
		$qry = "SELECT * FROM `speakers`";
		$result = mysqli_query($mysqli,$qry);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
	    	echo "<option value=".$row['speaker_id'].">".$row['speaker_fname']." ".$row['speaker_lname']." (Average Rating ~ ".$row['avg_rating'].")</option>";
			}
		}
	    ?>
	  </select>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3 mb-3">
      <label for="event_stime">Start Time :</label>
      <input type="time" class="form-control" id="event_stime" name="event_stime" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="event_etime">End Time :</label>
      <input type="time" class="form-control" id="event_etime" name="event_etime" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="event_sdate">Start Date of the Event</label>
      <input type="date" class="form-control" id="event_sdate" name="event_sdate" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="event_edate">End Date of the Event</label>
      <input type="date" class="form-control" id="event_edate" name="event_edate" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3 mb-3">
      <label for="event_fee">Fees</label>
      <input type="text" class="form-control" id="event_fee" placeholder="Event Fee" name="event_fee" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="event_cont_name">Contact Person</label>
      <input type="text" class="form-control" id="event_cont_name" placeholder="Contact Name" name="event_cont_name" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="event_contact">Contact Number</label>
      <input type="text" class="form-control" id="event_contact" placeholder="Contact No." name="event_contact" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="event_img">Image</label>
      <input type="file" class="form-control" id="event_img" name="event_img" required>
    </div>
    <div id="imagePreview" style="display: none;">
    </div>
  </div>
  <div class="row">
  	<div style="width: 100%; margin: 5px 15px;">
      <label for="event_desc">Event Description</label>
      <div class="form-group">
	    <textarea class="form-control" id="event_desc" name="event_desc" style="width: 100%;" rows="3"></textarea>
	  </div>
  	</div>
	</div>
  <br>
  <div class="row" style="align-items: center; width: 100%">
  	<button class="btn btn-primary" type="submit" name="submit">Submit form</button>
  </div>
</form>
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "add_event.php"; ?>