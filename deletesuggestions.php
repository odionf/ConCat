<?php
	require 'db.php';
	session_start();
	if (isset($_POST['delete'])) {
	$sid=$_GET['sid'];
	$qry="DELETE from `suggestions` where counter='$sid'";
    $res=mysqli_query($mysqli,$qry);
    if($res)
    	{
        echo "<script>alert('Suggestion Deleted')</script>";
        echo"<script>window.location.href='faculty.php'</script>";
        }
        else
        {
            echo"<script>alert('error deleting');</script>";
            echo"<script>window.location.href='faculty.php'</script>";
        }


}

?>