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
    $imgsize = getimagesize($_FILES['speaker_img']['tmp_name']);
    if($imgsize == FALSE){
      echo "Please select an image.";
    } else {
      $image = addslashes($_FILES['speaker_img']['tmp_name']);
      $name = addslashes($_FILES['speaker_img']['name']);
      $image = file_get_contents($image);
      $image = base64_encode($image);
    }
    $sql = "INSERT INTO `speakers` (speaker_fname,speaker_lname,speaker_contact,img_name,speaker_img)
    VALUES ('".$_POST['speaker_fname']."','".$_POST["speaker_lname"]."','".$_POST["speaker_contact"]."','".$name."','".$image."')";
    $sql = $mysqli->query($sql);
    if ($sql) {
     	echo "<script>alert('Event Successfully Added!');</script>";
    } else {
     	echo "<script>alert('Error in Adding Event!');</script>";
    }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Speaker | <?php echo $_SESSION['$first_name'] . " | ConCat"; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.2.1.js"></script>
  <script src="js/jquery-ui.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
  $(function() {
      $("#speaker_img").on("change", function()
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
      <li class="nav-item">
        <a class="nav-link" href="add_event.php">Add Event</a>
      </li>
      <li class="nav-item active">
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
      <label for="speaker_fname">First Name</label>
      <input type="text" class="form-control" id="speaker_fname" name="speaker_fname" placeholder="First name" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="speaker_lname">Last Name</label>
      <input type="text" class="form-control" id="speaker_lname" name="speaker_lname" placeholder="Last name" required>
    </div>
  </div>
  <div class="row"> 
    <div class="col-md-3 mb-3">
      <label for="speaker_contact">Contact Number</label>
      <input type="text" class="form-control" id="speaker_contact" placeholder="Contact No." name="speaker_contact" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="speaker_img">Image (Optional)</label>
      <input type="file" class="form-control" id="speaker_img" name="speaker_img">
    </div>
    <div id="imagePreview" style="display: none;">
      <div id="crop_tool"></div>
    </div>
  </div>
  <br>
  <div class="row" style="align-items: center; width: 100%; padding-left: 2%;">
  	<button class="btn btn-primary" type="submit" name="submit" value="Upload">Submit form</button>
  </div>
</form>
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "add_speaker.php"; ?>