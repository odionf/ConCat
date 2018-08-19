<?php
  include 'db.php';
  session_start();
  $pd=$_SESSION['$pid'];
  
   if (isset($_GET['submit'])) {
                
         
        foreach ($_GET['ai'] as $value) {
          $q= "SELECT * from interests WHERE pid='$pd' AND interest='$value'";
        $result=mysqli_query($mysqli,$q);
        if(($result->num_rows)==0) 
        {
          $qer="INSERT INTO interests VALUES ('$pd', '$value');";
          $res=mysqli_query($mysqli,$qer);
          echo "<script>alert('profile Successfully Updated!')</script>"; 
        }
        else{
          echo "<script>alert('".$value." Already added')</script>";
        }
       
        
      }
      $qery="SELECT * from `users` WHERE pid='$pd'";
      $r=mysqli_query($mysqli,$qery);
      $row = mysqli_fetch_assoc($r);
    
      if($row['type']=='Student')
      {
        echo "<script> window.location.href = 'studentinfo.php'</script> ";
      }
      else{
        echo "<script> window.location.href= 'facultyinfo.php'</script>";
      }
    }
?>