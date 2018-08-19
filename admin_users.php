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
<!DOCTYPE html>
<html>
<head>
	<title><?php echo "Users | " . $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | ConCat" ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
 <script type="text/javascript">
    $(function() {
     $('#f1').ajaxForm(function() {
       alert("Successfully Added User! Reset to Add More");
       });
     });
    $(function() {
     $('#f2').ajaxForm(function() {
       alert("Successfully Added Users! Reset to Add More");
       });
     });
    $(function() {
     $('#f3').ajaxForm(function() {
       alert("Successfully Deleted Users");
       });
     });
  </script>
  <script type="text/javascript">
     function formValidation2()
    {
      var sid=document.f2.s_id;
      var eid=document.f2.e_id;
           alert(sid);
      if (userid_validation(sid,5,8))
      {
        if(userid_validation(eid,5,8))
        {
        }}
        return false;
    }
 function userid_validation(uid,mx,my)
    {
      var uid_len=uid.value.length;
      var letters=/^[0-9]+$/;
      if (uid_len==0)
      {
        alert("User ID should not be empty");
        uid.focus();
        return false;
      }
      else if(uid_len>my || uid_len<mx)
      {
        alert("Length between " +mx+ " and " +my);
        uid.focus();
        return false;
      }
      else if (!uid.value.match(letters)){
        alert("ID must be numeric");
        uid.focus();
      }
      else
        return true;
    }
  </script>
  <script type="text/javascript">
    function formValidation1()
    {
      var uid=document.f1.pid;
      var pass=document.f1.password;
      var fname=document.f1.first_name;
      var lname=document.f1.last_name;
      
      if (userid_validation(uid,5,8))
      {
        if(passid_validation(passid,2,12))
        {
          if(allletter(fname))
          {
            if(allletter(lname))
            {
            }}}}
        return false;
    }
     function formValidation2()
    {
      var sid=document.f2.s_id;
      var eid=document.f2.e_id;
           alert(sid);
      if (userid_validation(sid,5,8))
      {
        if(userid_validation(eid,5,8))
        {
        }}
        return false;
    }
     function formValidation3()
    {
      var sid=document.f3.s_id;
      var eid=document.f3.e_id;
           
      if (userid_validation(sid,5,8))
      {
        if(userid_validation(eid,5,8))
        {
        }}
        return false; 
    }
    function userid_validation(uid,mx,my)
    {
      var uid_len=uid.value.length;
      var letters=/^[0-9]+$/;
      if (uid_len==0)
      {
        alert("User ID should not be empty");
        uid.focus();
        return false;
      }
      else if(uid_len>my || uid_len<mx)
      {
        alert("Length between " +mx+ " and " +my);
        uid.focus();
        return false;
      }
      else if (!uid.value.match(letters)){
        alert("ID must be numeric");
        uid.focus();
      }
      else
        return true;
    }
    function passid_validation(passid,mx,my)
    {
      var passid_len=passid.value.length;
      if (passid_len==0)
      {
        alert("Password cannot be empty");
        passid.focus();
        return false;
      }
      else if( passid_len>=my || passid_len<mx)
      {
        alert("Length of password between " +mx +" and " +my);
        passid.focus();
        return false;
      }
      return true;
    }
    function allletter(uname)
    {
    var letters=/^[A-Za-z]+$/;
    if (uname.value.match(letters)){
      return true;
    }
    else{alert("Username must have alphabet");
    uname.focus();
    }
    return false;
    }
  </script>
  <script type='text/javascript'>
    $(document).ready(function(){
      $('#btncollapse1').click(function(){
        $('#collapse1').delay(200).fadeIn();
        $('#collapse2').delay(0).fadeOut();
        $('#collapse3').delay(0).fadeOut();
        $('#collapse4').delay(0).fadeOut();
      });
      $('#btncollapse2').click(function(){
        $('#collapse2').delay(200).fadeIn();
        $('#collapse1').delay(0).fadeOut();
        $('#collapse3').delay(0).fadeOut();
        $('#collapse4').delay(0).fadeOut();
      });
      $('#btncollapse3').click(function(){
        $('#collapse4').delay(0).fadeOut();
        $('#collapse3').delay(200).fadeIn();
        $('#collapse2').delay(0).fadeOut();
        $('#collapse1').delay(0).fadeOut();
      });
       $('#btncollapse4').click(function(){
        $('#collapse4').delay(200).fadeIn();
        $('#collapse3').delay(0).fadeOut();
        $('#collapse2').delay(0).fadeOut();
        $('#collapse1').delay(0).fadeOut();
      });
    });
  </script>
  <style type="text/css">
    td {
      text-align: center;
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
        <a class="nav-link" href="admin.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_events.php">Events</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_speakers.php">Speakers</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="admin_users.php">Users<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
    <form action="logout.php" method="post" style="float: right; margin: 0;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
    </form>
  </div>
</nav>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #39414f">
  <div class="" style="width: 25%;padding: 2px;"><button id="btncollapse1" class="btn btn-secondary" style="background-color: #39414f;width: 100%;" href="#collapse1">Student</button></div>
  <div class="" style="width: 25%;padding: 2px;"><button id="btncollapse2" class="btn btn-secondary" style="background-color: #39414f;width: 100%;" href="#collapse2">Committee</button></div>
  <div class="" style="width: 25%;padding: 2px;"><button id="btncollapse3" class="btn btn-secondary" style="background-color: #39414f;width: 100%;" href="#collapse3">Faculty</button></div>
  <div class="" style="width: 25%;padding: 2px"><button id="btncollapse4" class="btn btn-secondary" style="background-color: #39414f;width: 100%;">Add Users</button></div>
</nav>


<!--Current Users-->
<!--Student-->
<div class="container">
<table class="table table-hover panel panel-default" style="width: 100%;" id="collapse1">
    <thead style="background-color: black; color: white;">
      <td><!--input type="checkbox" name="checkAll" /--></td>
      <td>PID</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td></td>
      <td></td>
    </thead>
    <tbody>
    <?php
      $qry = "SELECT * from `users` where type='Student'";
      $result = mysqli_query($mysqli,$qry);
      if($result){
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td><!--input type='checkbox' /--></td><td>".$row['pid']."</td><td>".$row['first_name']."</td><td>".$row['last_name']."</td>";
          echo "<td><button type='submit' class='btn btn-primary' name='reset' value='reset' id='res".$row['pid']."'>Reset Password</button>
          <td><button type='submit' class='btn btn-danger' value='".$row['pid']."' id='del".$row['pid']."'>Delete</button></td>";
          echo "<script>
          $(document).ready(function(){
            $('#del".$row['pid']."').click(function(){
              $.ajax({
                  type: 'get',
                  url : 'admin_users_update.php?pid=".$row['pid']."&value=delete',
                  success: function(){alert('Successfully Deleted!');},
                  error: function(){alert('Already Deleted!');},
              })
            });
            $('#res".$row['pid']."').click(function(){
              $.ajax({
                  type: 'get',
                  url : 'admin_users_update.php?pid=".$row['pid']."&value=reset',
                  success: function(){alert('Successfully Reset!');},
                  error: function(){alert('Cant Reset!');},
              })
            });
          })
          </script>";
        }
      }
    ?>
    </tbody>
    <script>
      $(document).ajaxStop(function() {
        window.location.reload(); 
      });
    </script>
</table>

<!--Committee-->
<table class="table table-hover panel panel-default" style="width: 100%; display: none;" id="collapse2">
    <thead style="background-color: black; color: white;">
      <td><!--input type="checkbox" name="checkAll" /--></td>
      <td>PID</td>
      <td>Committee Name</td>
      <td></td>
      <td></td>
    </thead>
    <tbody>
    <?php
      $qry = "SELECT * from `users` where type='Committee'";
      $result = mysqli_query($mysqli,$qry);
      if($result){
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td><!--input type='checkbox' /--></td><td>".$row['pid']."</td><td>".$row['first_name'];
         
          echo "<td><button type='submit' class='btn btn-primary' name='reset' value='reset' id='res".$row['pid']."'>Reset Password</button>
          <td><button type='submit' class='btn btn-danger' value='".$row['pid']."' id='del".$row['pid']."'>Delete</button></td>";

          echo "<script>
          $(document).ready(function(){
            $('#del".$row['pid']."').click(function(){
              $.ajax({
                  type: 'get',
                  url : 'admin_users_update.php?pid=".$row['pid']."&value=delete',
                  success: function(){alert('Successfully Deleted!');},
                  error: function(){alert('Already Deleted!');},
              })
            });
            $('#res".$row['pid']."').click(function(){
              $.ajax({
                  type: 'get',
                  url : 'admin_users_update.php?pid=".$row['pid']."&value=reset',
                  success: function(){alert('Successfully Reset!');},
                  error: function(){alert('Cant Reset!');},
              })
            });
          });
          </script>";
        }
      }
    ?>
    </tbody>
</table>

<!--Faculty-->
<table class="table table-hover panel panel-default" style="width: 100%; display: none;" id="collapse3">
    <thead style="background-color: black; color: white;">
      <td><!--input type="checkbox" name="checkAll" /--></td>
      <td>ID</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td></td>
      <td></td>
    </thead>
    <tbody>
    <?php
      $qry = "SELECT * from `users` where type='Faculty'";
      $result = mysqli_query($mysqli,$qry);
      if($result){
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td><!--input type='checkbox' /--></td><td>".$row['pid']."</td><td>".$row['first_name']."</td><td>".$row['last_name'];
         
          echo "<td><button type='submit' class='btn btn-primary' name='reset' value='reset' id='res".$row['pid']."'>Reset Password</button>
          <td><button type='submit' class='btn btn-danger' value='".$row['pid']."' id='del".$row['pid']."'>Delete</button></td>";

          echo "<script>
          $(document).ready(function(){
            $('#del".$row['pid']."').click(function(){
              $.ajax({
                  type: 'get',
                  url : 'admin_users_update.php?pid=".$row['pid']."&value=delete',
                  success: function(){alert('Successfully Deleted!');},
                  error: function(){alert('Already Deleted!');},
              })
            });
            $('#res".$row['pid']."').click(function(){
              $.ajax({
                  type: 'get',
                  url : 'admin_users_update.php?pid=".$row['pid']."&value=reset',
                  success: function(){alert('Successfully Reset!');},
                  error: function(){alert('Cant Reset!');},
              })
            });
          });
          </script>";
        }
      }
    ?>
    </tbody>
</table>

<!--Add Users-->
<div  style="width: 100%; display: none;" id="collapse4">

<h4 class="lead"><b>Individual Add</b></h4>
<form name="f1" id="f1" action="admin_users_add.php" method="post" >
<table class="table table-hover panel panel-default">
    <thead style="background-color: black; color: white;">
      <td>Type</td>
      <td>ID</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Password</td>
    </thead>
    <tbody>
      <tr>
          <td>
          <select class="" id="type" name="type">
            <option value="Committee">Committee</option>
            <option value="Faculty">Faculty</option>
            <option value="Student">Student</option>
          </select>
        </td>
        <td><input type="text" value="" name="pid" required="1"><p style="color: red;">Note: Committee IDs start from 900000</p></td>
        <td><input type="text" id="first_name" name="first_name" required="1"></td>
        <td><input type="text" id="last_name" name="last_name" required="1"></td>
        <td><input type="text" id="password" name="password" required="1"></td>
      </tr>
      <tr>
      <td colspan="5"><input type="submit" name="submit"><input type="reset" name="reset"></td>
      </tr>
    </tbody>
</table>
</form>

<h4 class="lead"><b>Group Add</b></h4>
<form name="f2" action="admin_users_add_group.php" id="f2" method="post">
<table class="table table-hover panel panel-default">
    <thead style="background-color: black; color: white;">
      <td>Type</td>
      <td>ID Range</td>
    </thead>
    <tbody>
      <tr>
        <td>
          <select class="" id="type" name="type">
            <option value="">Select User Type</option>
            <option value="Committee">Committee</option>
            <option value="Faculty">Faculty</option>
            <option value="Student">Student</option>
          </select>
        </td>
        <td>
          From:<input type="text" id="s_id" name="s_id" required="1"> To:<input type="text" id="e_id" name="e_id" required="1">
        </td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" name="submit"><input type="reset" name="reset"></td>
      </tr>
    </tbody>
</table>
</form>

<h4 class="lead"><b>Group Delete</b></h4>
<form name="f3" action="admin_users_del_group.php" id="f3" method="post">
<table class="table table-hover panel panel-default">
    <thead style="background-color: black; color: white;">
      <td>Type</td>
      <td>ID Range</td>
    </thead>
    <tbody>
      <tr>
        <td>
          <select name="type" id="type">
            <option value="">Select User Type</option>
            <option value="Committee">Committee</option>
            <option value="Faculty">Faculty</option>
            <option value="Student">Student</option>
          </select>
        </td>
        <td>
          From:<input type="text" id="s_id" name="s_id"> To:<input id="e_id" type="text" name="e_id">
        </td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="submit"><input type="reset" name="reset"></td>
    </tr>
    </tbody>
</table>
</form>
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "admin_users.php"; ?>