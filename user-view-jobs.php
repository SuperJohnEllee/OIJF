<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header("location: index.php");
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<title>Online International Job Finder</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" href="css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="icon" href="img/job_finde.png">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-dark fixed-top">
		<a class="navbar-brand" href="#"><img src="img/job_finde.png" height="30" width="30"></a>
      		<button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      			<span class="navbar-toggler-icon"></span>
      		</button>
      	<div class="collapse navbar-collapse" id="navbar">
      		<ul class="navbar-nav mr-auto">
      			<li class="nav-item">
      				<a class="nav-link text-white" href="user-dashboard.php"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
      			</li>
      		</ul>
      	</div>
	</nav><br><br><br>
	<div class="container">
		<h1>Jobs Available Today</h1>
		<hr>
		<div class="row">
			<?php
				$conn = mysqli_connect('localhost', 'root', '', 'oijf');
				$disp_search = mysqli_query($conn, "SELECT * FROM job INNER JOIN employer USING(EmpID)");
        			if (mysqli_num_rows($disp_search) > 0) {
            			while ($disp_row = mysqli_fetch_assoc($disp_search)) {
               				echo "<div class='card blue lighten-4 col-3' style='width:17rem;'>
                        			<div class='view overlay'>
                          				<span class='fa fa-user fa-5x'></span>
                          				<h3>".$disp_row['JobType']." <br> at ".$disp_row['Company']."</h3>
                          				<h5>Posted by ".$disp_row['FirstName']." ".$disp_row['LastName']."</h5>
                        			</div>
                      			</div>";
            				}
        		} else {
          		echo "<div class='card mx-auto alert alert-warning' style='width:17rem;'>
                   	 	<h1 class='text-center'><span class='fa fa-info-circle'></span> No Jobs posted<h1>
                  	</div>";
        		}

			?>
		</div>
	</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>