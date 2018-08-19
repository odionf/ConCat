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
    $sid = $_GET['speaker_id'];
    $qry = "SELECT * FROM `speakers` where speaker_id = '$sid'";
    $result = $mysqli->query($qry);
    if ($result) {
      $row = mysqli_fetch_assoc($result);
      $sid = $row['speaker_id'];
      $sfname = $row['speaker_fname'];
      $slname = $row['speaker_lname'];
      $simg = $row['speaker_img'];
      $scontact = $row['speaker_contact'];
      $semail = $row['speaker_email'];
      $visibility = $row['visibility'];
      $description = $row['description'];
      $avgrating = $row['avg_rating'];
    }
  }
?>
<html>
<head>
	<title>Edit Speaker | <?php echo $sfname; ?> | ConCat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(function() {
     $('#f1').ajaxForm(function() {
       alert('details updated!');
       });
     });
  </script>
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
        		<a class="nav-link" href="admin_speakers.php">Return To Speakers</a>
      </li>
    </ul>
    	<div class = "navbar-text"> Signed in as <a href="committee_info.php" style="color: inherit;"><u><i><?php echo $_SESSION['$first_name']; ?></i></u></a></div>
    	<form action = "logout.php" method="post" style="float: right; margin: 0;">
      		<button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
    	</form>
  	</div>
</nav>

<div class="container card" style="margin-top: 50px; padding: 30px;">
	<form method="get" action="admin_speakers_save.php" id="f1">

  <div class="row">
    <div class="col-md-6 mb-3">
      
      <input type="number" name="speaker_id" id="speaker_id" value="<?php echo $sid; ?>" hidden>
      <label for="speaker_name"><b>Speaker ID: <?php echo $sid; ?></b></label><br>
      <label for="speaker_name"><b>Speaker Rating: <?php echo $avgrating; ?></b></label><br>
      
      <label><b>Speaker Visibility: <?php echo $visibility; ?></b></label><br>
      Speaker Visible:<select id="visibility" name="visibility">
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
    
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="speaker_name"><b>Speaker Name:</b></label><br>
      First:<input type="text" class="form-control" id="speaker_fname" name="speaker_fname" placeholder="<?php echo $sfname; ?>" value="<?php echo $sfname; ?>">
      Last:<input type="text" class="form-control" id="speaker_lname" name="speaker_lname" placeholder="<?php echo $slname; ?>" value="<?php echo $slname; ?>">
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="speaker_name"><b>Contact Information:</b></label><br>
      Contact Number:<input type="text" class="form-control" id="speaker_contact" name="speaker_contact" value="<?php echo $scontact; ?>">
      E-Mail:<input type="text" class="form-control" id="speaker_email" name="speaker_email" value="<?php echo $semail; ?>">
    </div>
  </div>
  
  <div class="row">
  	<div style="width: 100%; margin: 5px 15px;">
      <label for="event_desc"><b>Speaker Description:</b></label>
      <div class="form-group">
	    <textarea class="form-control" id="description" name="description" style="width: 100%;" rows="3" value="<?php echo $description; ?>"><?php echo $description; ?></textarea>
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
<?php $_SESSION['$last_page'] = "admin_speakers_edit.php"; ?>