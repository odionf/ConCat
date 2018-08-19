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
if(isset($_POST['submit_image']))
{
 $uploadfile=$_FILES["upload_file"]["tmp_name"];
 $folder="images/";
 move_uploaded_file($_FILES["upload_file"]["tmp_name"], "$folder".$_FILES["upload_file"]["name"]);
 exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo "Speakers | " . $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | ConCat" ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!--upload-->
  <!--script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="jquery.form.js"></script-->
  <script>
  $(document).ajaxStop(function() {
   window.location.reload(); 
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
        <a class="nav-link" href="admin.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_events.php">Events</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="admin_speakers.php">Speakers<span class="sr-only">(current)</span></a>
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
  <table class="table table-hover" id='table'>
    <thead style="background-color: black; color: white;">
      <td><!--input type="checkbox" name="checkAll" /--></td>
      <td>Speaker ID</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Average Rating</td>
      <td>Contact Number</td>
      <td>Visibility</td>
      <td></td>
      <td></td>
    </thead>
    <tbody>
    <?php
      $qry = "SELECT * from `speakers`";
      $result = mysqli_query($mysqli,$qry);
      if($result){
        while ($row = mysqli_fetch_assoc($result)) {
          
          echo "<tr><td></td><td>".$row['speaker_id']."</td><td>".$row['speaker_fname']."</td><td>".$row['speaker_lname']."</td><td>".$row['avg_rating']."</td><td>".$row['speaker_contact']."</td><td>".$row['visibility']."</td>";
          
          echo "<td><form action='admin_speakers_edit.php?speaker_id=".$row['speaker_id']."'><button type='submit' class='btn btn-primary' name='speaker_id' value='".$row['speaker_id']."'>Edit</button></form></td>";
          //echo "<td><button type='submit' class='btn btn-primary' id='edit".$row['speaker_id']."' value='edit' onclick='admin_speakers_edit.php?speaker_id=".$row['speaker_id']."&value=edit'>Edit</button></td>";
          
          echo "<td><button type='submit' class='btn btn-danger' id='del".$row['speaker_id']."' value='delete'>Delete</button></td></tr>";
          echo "<script>
            $(document).ready(function(){
              $('#del".$row['speaker_id']."').click(function(){
                $.ajax({
                    type: 'get',
                    url : 'admin_speakers_delete.php?speaker_id=".$row['speaker_id']."&value=delete',
                    success: function(){alert('Successfully Deleted!');},
                    error: function(){alert('Doesnt exist!');},
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

<?php $_SESSION['$last_page'] = "admin_speakers.php"; ?>