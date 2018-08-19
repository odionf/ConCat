<?php
  session_start();
  require 'db.php';
  if(!isset($_SESSION['$event_id'])){
  $_SESSION['$event_id'] = $_GET['event_id'];
}
?>
<?php
if(!isset($_SESSION['$pid'])){
  if (isset($_POST['submit'])){
    $pid = mysqli_real_escape_string($mysqli,$_POST['pid']);
    $query = $mysqli->query("SELECT * FROM users WHERE pid = '$pid' LIMIT 1");
    $result = $query->fetch_assoc();
    $check = password_verify($_POST['password'], $result['password']);
    $result = $mysqli->query("SELECT * FROM users WHERE pid = '$pid' AND $check LIMIT 1");
    if (!$result) {
      echo " <div class='navbar-text' style='margin: 0px 5px; color: red;''>Invalid Details!</div> ";
    } else {
      $query = "SELECT pid,first_name,last_name,type FROM users WHERE pid = '$pid' LIMIT 1";
      $query = $mysqli->query($query);
      $query = $query->fetch_assoc();
      $_SESSION['$type'] = $query['type'];
      $_SESSION['$pid'] = $query['pid'];
      $_SESSION['$first_name'] = $query['first_name'];
      $_SESSION['$last_name'] = $query['last_name'];
      if ($_SESSION['$type'] == 'Student') {
        if(!isset($_SESSION['$pid'])){
        echo "<script> window.location.href='view_event.php?event_id=".$_SESSION['$event_id']."';</script>";
        exit();
      }
      } elseif($_SESSION['$type'] == 'Committee') {
        header("Location: committee_view_events.php");
        exit();
      } elseif ($_SESSION['$type'] == 'Administrator') {
        header("Location: admin_events.php");
        exit();
      } else {
        echo "<script>alert('You Must be A Committee or Student or Administrator to view the Event Details!');</script>";
       session_destroy();
      }
    }
}
}   
?>
<html>
<html>
<head>
	<title>ConCat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

  <style>
  

#mainbox{
  font-family: calibri;
  box-sizing: border-box;
  justify-content: center;
  display: flex;
flex-wrap: wrap;
}

.title {
  color: grey;
  font-size: 18px;
}
.flex-container {
    display: -webkit-flex;
    display: flex;  
    -webkit-flex-flow: row wrap;
    flex-flow: row wrap;
    text-align: center;
}

.flex-container > * {
    padding: 15px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
}

.article {

    text-align: left;
}

.imp{
	font-size: 4em;	
}

header {background: black;color:white;}



@media all and (min-width: 768px) {
    .article {-webkit-flex:5 0px;flex:5 0px;-webkit-order:2;order:2;}
 
}

</style>


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 9999; width: 100%">
      <a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" style="margin-bottom: 5px" alt="ConCat">     ConCat</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if(isset($_SESSION['$type'])){
        if($_SESSION['$type'] == "Student"){ echo '<li class="nav-item">
        <a class="nav-link" href="student.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="studentinfo.php">Edit Profile</a>
      </li>';}} else {
        echo '<li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>';
      }?>
    </ul>
    <?php if (isset($_SESSION['$type'])) {
     echo "<div class = 'navbar-text'> Signed in as <i>" . $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . "</i></div>
  <form action='logout.php' method='post' style='float: right; margin: 0;'>
      <button class='btn btn-secondary' style='margin-left: 10px;' type='submit' name='logout'>Log Out</button>
  </form>
  </div>";
    } else {
    echo "<form style='margin-bottom: 0px;' method='post' action='".$_SERVER['PHP_SELF']."'>
  <div class='form-row align-items-center'>
    <div class='col-auto'>
      <label class='sr-only' for='pid'>Username</label>
      <div class='input-group mb-2 mb-sm-0'>
        <input type='text' class='form-control' id='pid' name='pid' placeholder='Username'>
      </div>
    </div>
    <div class='col-auto'>
      <label class='sr-only' for='password'>Password</label>
      <input type='password' class='form-control mb-2 mb-sm-0' id='password' name='password' placeholder='Password'>
    </div>
    <div class='col-auto'>
      <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
    </div>
  </div>
</form>";
    }
  ?>
</nav>
<div class="flex-container">



<?php
  $event_id = $_SESSION['$event_id'];
  $event_id = $_GET['event_id'];
  $qry = "SELECT * FROM `events` INNER JOIN `speakers` WHERE events.speaker_id = speakers.speaker_id AND event_id = $event_id";
  $result = mysqli_query($mysqli,$qry);
  if($result){
    $row = mysqli_fetch_assoc($result);
    $sid=$row['speaker_id'];
    $q="SELECT * FROM `speakers` WHERE speaker_id='$sid'";
    $r= mysqli_query($mysqli,$q);
    $r= mysqli_fetch_assoc($r);
    echo 
    "<header>
    <h1>".$row['event_name']."</h1>
    </header>
    <div class='container'>
    <article class='article'>
    <img src='data:image;base64,".$row['event_image']."' style='padding: 15px 0px; height: 100%; width:100%'>
      <h1>Details</h1>
      <p>".$row['event_desc']."</p>
      <p><strong><label>Date: &nbsp;</label>".date('dS M Y',strtotime($row['event_sdate']))." to ".date('dS M Y',strtotime($row['event_edate']))."
    <br><label>Time: </label>&nbsp; ".date('h:i a',strtotime($row['event_stime']))." to ".date('h:i a',strtotime($row['event_etime']))."
    <br><label>Cost: </label>&nbsp; ".$row['event_fee']." 
    <br><label>Resource Person: </label>- &nbsp; ".$row['speaker_fname']." ".$row['speaker_lname']." (rating- ".$r['avg_rating'].")
    <br><label>Contact:</label> &nbsp; ".$row['cont_name']." - ".$row['event_cont']."
    </big>
    </strong></p>
      <button class='btn btn-primary' style='border-radius: 10px;' id='register'";
      if(!isset($_SESSION['$type'])){
        echo "onclick='setFocus();'";
      }
      echo ">Register</button>";
      if (isset($_SESSION['$type'])) {
        echo "<script type='text/javascript'>
            $(document).ready(function(){
              $('#register').click(function(){
                $.ajax({
                  type : 'POST',
                  url : 'register.php',
                  data : {'event_id' : '".$row['event_id']."' , 'pid' : '".$_SESSION['$pid']."'},
                  success : function(){alert('Successfully Registered!');},
                  error : function(){alert('Registration unsuccessful!');},
                });
                });
              });
         </script>";
      }
    }
  
?>
</article></div>
</div>
</body>
<script type="text/javascript">
  function setFocus(){
    document.getElementById("pid").focus();
    alert("Login First!");
  }
</script>
</html>
<?php $_SESSION['$last_page'] = "view_event.php?event_id=".$event_id."'"; ?>