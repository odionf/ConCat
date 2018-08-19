<?php
	session_start();
	if(!isset($_SESSION['$pid'])){
		echo '<script type="text/javascript">alert("Login First!")</script>';
		header("Location: {$_SESSION['$last_page']}");
		exit();
	} else {
		if($_SESSION['$type']!='Student'){
			echo '<script type="text/javascript">alert("Only accessible to a student!");</script>';
			header("Location: {$_SESSION['$last_page']}");
			exit();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>

<style type="text/css">
.button {
  display: inline-block;

  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color:#3f6396;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}
.button:hover {background-color: #027987}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

textarea {
    width: 100%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
}


.main { 
                width: 900px; 
                margin: 0 auto; 
                height: 700px;
                border: 1px solid #ccc;
                padding: 20px;
            }

            .header{
                height: 100px;    
            }
            .content{    
                height: 700px;
                border-top: 1px solid #ccc;
                padding-top: 15px;
            }
            .footer{
                height: 100px;  
                bottom: 0px;
            }
            .heading{
                color: #FF5B5B;
                margin: 10px 0;
                padding: 10px 0;
                font-family: trebuchet ms;
            }

            #dv1, #dv0{
                width: 408px;
                border: 1px #ccc solid;
                padding: 15px;
                margin: auto;

            }
           

        </style>
        <style>
            /****** Rating Starts *****//*
            @import url(http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

            fieldset, label { margin: 0; padding: 0; }
            body{ margin: 20px; }
            h1 { font-size: 1.5em; margin: 10px; }

            .rating { 
                border: none;
                float: left;
            }

            .rating > input { display: none; } 
            .rating > label:before { 
                margin: 5px;
                font-size: 1.25em;
                font-family: FontAwesome;
                display: inline-block;
                content: "\f005";
            }

            .rating > .half:before { 
                content: "\f089";
                position: absolute;
            }

            .rating > label { 
                color: #ddd; 
                float: right; 
            }

            .rating > input:checked ~ label, 
            .rating:not(:checked) > label:hover,  
            .rating:not(:checked) > label:hover ~ label { color: #FFD700;  }

            .rating > input:checked + label:hover, 
            .rating > input:checked ~ label:hover,
            .rating > label:hover ~ input:checked ~ label, 
            .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }     
            .rcard {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    
    margin: auto;
    text-align: center;
    font-family: arial;
}

            */
        </style>


        <!-- done-->


	<title><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | ConCat"; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>


</head>
<body style="background-color: #e8f0ff;">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 9999; width: 100%">
  		<a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" style="margin-bottom: 5px" alt="ConCat"> ConCat</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="student.php">Home<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="studentinfo.php">Edit Profile</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="review.php">Review</a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
	<form action="logout.php" method="post" style="float: right;">
	    <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
	</form>
  </div>
</nav>
	
 

<?php
			include 'db.php';
			$p=$_SESSION['$pid'];
			$qry= "SELECT DISTINCT event_id FROM `attendance` WHERE pid='$p' AND paid='1'";
			$result = mysqli_query($mysqli,$qry);

			if (!$result) {
                
				echo "<div class = 'container-fluid' style = 'text-align: center; margin: 20px;'><h1>No Events attended yet!</h1></div>";
			} else	{

				while ($row = mysqli_fetch_assoc($result)) {

					$r=$row['event_id'];
										
					$ss=mysqli_query($mysqli,"SELECT * FROM `events` INNER JOIN `speakers` WHERE events.event_id='$r' AND speakers.speaker_id= events.speaker_id");
					$ss=mysqli_fetch_assoc($ss);
                    echo "<div class='rcard' style='float:left; margin:2%; padding:10px; background-color:#e6edec;'>";
                echo"<form method ='POST' action='addrate.php?eid=".$r." name='rating'>";
						echo 
						"<div style='padding: 15px; margin: 2%; align-items: center;  background-color:#e6edec; border-radius:20px;' class='container'>
						<h2>".$ss['speaker_fname']." ".$ss['speaker_lname'].",</h2><h3> ".$ss['event_name']." </h3>";
			/*			echo " 
                    <script>
                        $(document).ready(function () {
                            $('#demo3 .stars').click(function () {

                              
                                var label = $('label[for= + $(this).attr('id')+]');
                                $('#feedback').text(label.attr('title');
                                $(this).attr('checked');
                            });
                        })
                    </script>
                     <div style='float:left;'>Rate the speaker</div> 
                    <div style='float:left;'>
                    <fieldset id='demo3' class='rating' >
                        <input class='stars' type='radio' id='star53' name='rating' value='5' />
                        <label class = 'full' for='star53' title='Awesome - 5 stars'></label>
                        <input class='stars' type='radio' id='star4half3' name='rating' value='4.5' />
                        <label class='half' for='star4half3' title='Pretty good - 4.5 stars'></label>
                        <input class='stars' type='radio' id='star43' name='rating' value='4' />
                        <label class = 'full' for='star43' title='Pretty good - 4 stars'></label>
                        <input class='stars' type='radio' id='star3half3' name='rating' value='3.5' />
                        <label class='half' for='star3half3' title='Meh - 3.5 stars'></label>
                        <input class='stars' type='radio' id='star33' name='rating' value='3' />
                        <label class = 'full' for='star33' title='Meh - 3 stars'></label>
                        <input class='stars' type='radio' id='star2half3' name='rating' value='2.5' />
                        <label class='half' for='star2half3' title='Kinda bad - 2.5 stars'></label>
                        <input class='stars' type='radio' id='star23' name='rating' value='2' />
                        <label class = 'full' for='star23' title='Kinda bad - 2 stars'></label>
                        <input class='stars' type='radio' id='star1half3' name='rating' value='1.5' />
                        <label class='half' for='star1half3' title='Meh - 1.5 stars'></label>
                        <input class='stars' type='radio' id='star13' name='rating' value='1' />
                        <label class = 'full' for='star13' title='Sucks big time - 1 star'></label>
                        <input class='stars' type='radio' id='starhalf3' name='rating' value='0.5' />
                        <label class='half' for='starhalf3' title='Sucks big time - 0.5 stars'></label>
                    </fieldset>
                    <div id='feedback'></div>

                    

<div style='clear:both;'></div>
                
</div>           
            <script>
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-43091346-1', 'devzone.co.in');
                ga('send', 'pageview');

            </script>		";

*/
            echo "<label>Rate out of 10 </label> <input type='text' name='rate' >";
						echo "<br><div>Comment or review?<br><textarea cols='50' rows='3' name='review'></textarea></div>";



						echo"<br><button type='submit' name='subr' class='btn-primary'>Click to save</button></form></div>";
					 echo "</div>";
                    }  
			}
		?>
    </script>
</body>
</html>
<?php $_SESSION['$last_page'] = "student.php"; ?>