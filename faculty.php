<?php
  session_start();
  if(!isset($_SESSION['$pid'])){
    echo '<script type="text/javascript">alert("Login First!")</script>';
    header("Location: {$_SESSION['$last_page']}");
    exit();
  } else {
    if($_SESSION['$type']!='Faculty'){
      echo '<script type="text/javascript">alert("Only accessible to a faculty!");</script>';
      header("Location: {$_SESSION['$last_page']}");
      exit();
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | ConCat"; ?></title>
  <script src="js/jquery-3.2.1.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<style>
.card1 {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  width: auto;
  margin: auto;
  text-align: center;
  font-family: arial;
}
.button {
  display: inline-block;
  width: 100%;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color:#3f6396;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
  padding: 3px;
}

.button:hover {background-color: #027987}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #8598ad;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #8598ad;
    color: white;
}





/*second*/
.modal1 {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal1-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 60%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}



/* The Close Button */
.close1 {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close1:hover,
.close1:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal1-header {
    padding: 2px 16px;
    background-color:#8598ad;
    color: white;
}

.modal1-body {padding: 2px 16px;}

.modal1-footer {
    padding: 2px 16px;
    background-color: #8598ad;
    color: white;
}

/*now for the toggle*/



.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
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
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
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
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}









</style>

</head>
<body style="background-color: #e8f0ff;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 9999; width: 100%">
      <a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" style="margin-bottom: 5px" alt="ConCat">     ConCat</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="facultyinfo.php">Edit Profile</a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
  <form action="logout.php" method="post" style="float: right;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
  </form>
  </div>
</nav>
<br>

  <div style="width: 40%; float: left; background-color: #c2d6d6; margin: 2.5%; border-radius: 15px; padding: 10px;" class="card1">
  


<h2>Write a suggestion for any committee</h2>

<!-- Trigger/Open The Modal -->
<button id="myBtn" class="btn-primary" style="width: 100%;"><big>Give Suggestion</big></button>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal1-header">
      <span class="close">&times;</span>
      <h2>Add Suggestions</h2>
    </div>

     
    <div class="modal-body">
      <form name="sop" method="Get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <textarea cols="100" rows="10" placeholder="Enter the suggestion here" name="suggestion" value="suggestion" required="required"></textarea>
      
  <?php
    include 'db.php';
    $qry = "SELECT first_name FROM `users` WHERE type='Committee' ORDER BY first_name";
    $result = mysqli_query($mysqli,$qry);
    if (!$result) {
      echo "<div class = 'container-fluid' style = 'text-align: center; margin: 20px;'><h1>No committees found!</h1></div>";
    } else  {
      echo "<select name='cname[]' multiple='multiple' style='height:15em'>";
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<option name=".$row['first_name']."value=".$row['first_name'].">".$row['first_name']."</option>";
        }
        echo "</select><i>use ctrl to select multiple</i><br><div style='float:left; margin-left:10%;' ><button type='submit' name='submits' class='btn-secondary'><big>Send</big></button></div>
        <div style='float:right; margin-right:10%;'><button type='submit' name='submita' class='btn-secondary' ><big>Send to ALL</big></button></div></form>";
     }

echo"</form>";
     if (isset($_GET['submits'])) {
        $cname=$_GET['cname'];
        $sugest=$_GET['suggestion'];
        $p=$_SESSION['$pid'];
        

        foreach ($_GET['cname'] as $value) {
        
        $qer="INSERT INTO `suggestions` (`pid`, `suggestion`, `committee`) VALUES ('$p', '$sugest', '$value');";
        $res=mysqli_query($mysqli,$qer);

        echo $res;
        echo "<script> window.location.href = 'faculty.php'</script> ";   
      }
      }

      if (isset($_GET['submita'])) {
        $sugest=$_GET['suggestion'];
        $p=$_SESSION['$pid'];       
        $qer="INSERT INTO `suggestions` (`pid`,`suggestion`,`committee`) VALUES ('$p', '$sugest', 'all');";
        $res=mysqli_query($mysqli,$qer);
        echo $res;
        echo "<script> window.location.href = 'faculty.php'</script> ";   
      }
  ?>
</div>
    <div class="modal-footer">
      thank you
    </div>
  </div>
  </div>

<br><br>

 <button id="myBtn1" class="btn-info" style="width: 100%;"><big>View suggestions</big></button>

<!-- The Modal -->
<div id="myModal1" class="modal1">

  <!-- Modal content -->
  <div class="modal1-content">
    <div class="modal1-header">
      <span class="close1">&times;</span>
      <h2>Suggestion History</h2>
    </div>
    <div class="modal1-body">
      <?php
      include 'db.php';
      $pid=$_SESSION['$pid'];
      $n=mysqli_query($mysqli,"SELECT * FROM `users` WHERE pid='$pid'");
      $t=mysqli_fetch_assoc($n);
      $p=$t['first_name'];
      $qer="SELECT * from `suggestions` WHERE pid='$pid' ORDER BY counter desc";
      $result=mysqli_query($mysqli,$qer);
      if($result)
      {
        while ($row = mysqli_fetch_assoc($result)) {
          
            echo "<div class='card1' style='margin:10px; padding 10px;'>";
            $k=$row['counter'];
           
            echo "<form method='POST' action='deletesuggestions.php?sid=".$k."'>";
            $dp=$row['committee'];
            if($dp=='all')
            {
              $dp='All committees';
            }
            echo " Suggestion given to <b>".$dp."  </b> <br> Suggestion: <b>".$row['suggestion']." </b>";
            echo"<br><button type='submit' class='btn-danger' name='delete'>Delete suggestion</button>";
            echo"</form>";
            echo "</div>";
          }
      }
      ?>
      
    </div>
  
  </div>

</div>
 



  </div>
</div>
<div style="width: 40%; float: left; background-color: #c2d6d6; margin: 2.5%; border-radius: 10px; padding: 10px;" class="card1" >

<!--<div>
  <label style="float: left;">Join as speaker</label>
    <label class="switch" style="float: left;">
  <input type="checkbox" >
  <span class="slider round"></span>
</label>

</div>
-->
<form name="vis" method="Get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
  include 'db.php';
  $pd=$_SESSION['$pid'];
  $r="SELECT * from `speakers` WHERE speaker_id='$pd'"; 
        $reslt = $mysqli->query($r);
        if ($result) {
        $ro = mysqli_fetch_assoc($reslt);
        $v=$ro['visibility'];
        if($v=='1')
        {
          echo"<button type='submit' name='remv' class='button' > Remove from speaker list</button>";
        }
        else
        {
          echo"<button type='submit' name='addv' class='button'> join as speaker</button>";
        }
        
    }
echo "<form>";
if (isset($_GET['remv'])) {
        $p=$_SESSION['$pid'];
        $qer="UPDATE `speakers` SET visibility='0' WHERE speaker_id='$p'";
        $res=mysqli_query($mysqli,$qer); 
        echo "<script> window.location.href = 'faculty.php'</script> ";   
      }
      if (isset($_GET['addv'])) {
        $p=$_SESSION['$pid'];
        $qer="UPDATE `speakers` SET visibility='1' WHERE speaker_id='$p'";
        $res=mysqli_query($mysqli,$qer);    
         echo "<script> window.location.href = 'faculty.php'</script> ";   
      }

$r="SELECT * from `speakers` WHERE speaker_id='$pd'"; 
$reslt = $mysqli->query($r);
if ($result) {
  $ro = mysqli_fetch_assoc($reslt);
  $v=$ro['visibility'];
echo "<br>";
echo "<br><h5>Your Details for resourceperson</h5>";
echo"<label><b>Name:</b></label>- ".$ro['speaker_fname']." ".$ro['speaker_lname']." ";
echo "<br><label><b>Contact</b></label>- ".$ro['speaker_contact']." ";
echo "<br><label><b>E-Mail</b></label>- ".$ro['speaker_email']." ";
echo "<br><label><b>About</b></label>-<br> ".$ro['description']." ";
}
  $p=$_SESSION['$pid'];
      $qer="SELECT * FROM `interests` WHERE pid='$p'";
       $result = mysqli_query($mysqli,$qer);
       
        echo"<br><br><b>Proficiencies </b> <br>";
        
        while ($row = mysqli_fetch_assoc($result)) 
          {
            echo "-".$row['interest']." <br>";
          }
?>
<button class="button"href="facultyinfo.php">Edit Profile</button>
</div>

<script>



// addd suggestions
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
       
    }
}

// view suggestions
var modal1 = document.getElementById('myModal1');

// Get the button that opens the modal
var btn1 = document.getElementById("myBtn1");

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close1")[0];

// When the user clicks the button, open the modal 
btn1.onclick = function() {
    modal1.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
    modal1.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
       
    }
}


</script>






</body>
</html>
<?php $_SESSION['$last_page'] = "faculty.php"; ?>