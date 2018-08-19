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
  if(!isset($_SESSION['speaker_id'])){
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
   <script src="js/jquery.form.min.js"></script>
  <style type="text/css">
    .card1 {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  width: 100%;
  margin: auto;
  text-align: center;
  font-family: arial;
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
        		<a class="nav-link" href="committee.php">Return To Speakers</a>
      </li>
    </ul>
    	<div class = "navbar-text"> Signed in as <a href="committee_info.php" style="color: inherit;"><u><i><?php echo $_SESSION['$first_name']; ?></i></u></a></div>
    	<form action = "logout.php" method="post" style="float: right; margin: 0;">
      		<button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
    	</form>
  	</div>
</nav>

<div class="container card" style="margin-top: 50px; padding: 30px;">
    <div class="row">
    <div class="col-md-6 mb-3" style="width: 50%;float: left;">
      <label><b>Speaker Name:</b></label><blockquote class="blockquote"><?php echo " ", $sfname, " ", $slname; ?></blockquote>
      <label><b>Contact Number:</b></label><blockquote class="blockquote"><?php echo $scontact; ?></blockquote>
      <label><b>Contact E-mail:</b></label><blockquote class="blockquote"><?php echo $semail; ?></blockquote>
      <label><b>Description:</b></label><blockquote class="blockquote"><?php echo $description; ?></blockquote>
    </div>
     <div class="col-md-6 mb-3" style="width: 50%;float: left;">
      <label><b>Image:</b></label><blockquote class="blockquote"><?php echo $simg; ?></blockquote>
      <label><b>Speaker ID:</b></label><blockquote class="blockquote"><?php echo " ", $sid; ?></blockquote>
      <label><b>Average Rating:</b></label><blockquote class="blockquote"><?php echo $avgrating; ?></blockquote>
    </div>
    <br>
    <div width='100%' align='left'><big><b> &nbsp;&nbsp;Reviews :</big></b></div><br>
    <div class="card1">
      <?php
      $qer= "SELECT * from `rates` where speaker_id='$sid'";
      
       $result=mysqli_query($mysqli,$qer);
  if($result)
  {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class='card1'>";
        $rv=$row['review'];
        echo "<br> ".$rv."<br>";
        echo "</div>";
      }
    }
      ?>
    </div>
  </div>
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "committee_speaker.php"; ?>