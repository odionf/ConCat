<?php
	
	require 'db.php';
	session_start();
	if (isset($_POST['subr'])) {
	$eid=$_GET['eid'];
	$query = $mysqli->query("SELECT * FROM `events` WHERE event_id='$eid'");
    $result = $query->fetch_assoc();
    $sid=$result['speaker_id'];
    $rate=$_POST['rate'];
    $rev=$_POST['review'];
    $pid=$_SESSION['$pid'];
    if($rate>10||$rate<0)
    {
        echo "<script>alert('add proper rate')</script>";
        
       echo"<script>window.location.href='review.php'</script>";
    }
    echo "hi";
    $q= "SELECT * FROM `rates` WHERE  event_id='$eid' and pid='$pid' ";
    $r= mysqli_query($mysqli,$q);
    $r= mysqli_fetch_assoc($r);
    
    if($r)
    {
        $qry="UPDATE `rates` SET speaker_id='$sid', rate='$rate', review='$rev', rated='1' WHERE event_id='$eid' and pid='$pid'";
        $res=mysqli_query($mysqli,$qry);
         echo "hey";
         
         if($res)
        {
            $qr="UPDATE `attendance` set paid='0' WHERE pid='$pid' and event_id='$eid'";
        $r=mysqli_query($mysqli,$qr);
        echo "<script>alert('Review added yay')</script>";
        
       echo"<script>window.location.href='review.php'</script>";
        }
        else
        {
            echo"<script>alert('error first');</script>";
            echo"<script>window.location.href='review.php'</script>";
        }
    }
    else
    {
        $qry="INSERT INTO `rates` VALUES('$sid','$pid','$eid','$rate','$rev')";
    $res=mysqli_query($mysqli,$qry);

    if($res)
    {   
        $qr="UPDATE `attendance` set paid='0' WHERE pid='$pid' and event_id='$eid'";
        $r=mysqli_query($mysqli,$qr);
        $a3="SELECT AVG(rate) as av FROM `rates`  WHERE speaker_id='$sid' ";
        $a3=mysqli_query($mysqli,$a3);
        $row = mysqli_fetch_assoc($a3);
        $pr=$row['av'];
        $qr="UPDATE `speakers` set avg_rating='$pr' WHERE speaker_id='$sid'";
        $r=mysqli_query($mysqli,$qr);
        echo "<script>alert('Review added')</script>";
        echo"<script>window.location.href='review.php'</script>";



    }
    else
    {
        echo"<script>alert('error last');</script>";
        echo"<script>window.location.href='review.php'</script>";
    }
    }

   
    



}

?>