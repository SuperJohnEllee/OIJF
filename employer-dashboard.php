<!DOCTYPE html>
<?php
	session_start(); //session start

	//session variables
	$email = htmlspecialchars($_SESSION['email']);
	$name = htmlspecialchars($_SESSION['name']);
	$id = htmlspecialchars($_SESSION['emp_id']);
	$firstname = htmlspecialchars($_SESSION['firstname']);

	$conn = mysqli_connect('localhost', 'root', '', 'oijf'); //set connection

	//not logged in
	if(!$email){

		header('location: index.php');
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<title>Online International Job Finder</title>
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
      		<ul class="navbar-nav ml-auto">
      			<li class="nav-item">
      				<a class="nav-link text-white" href="#"><span class="fa fa-user"></span> <?php echo $firstname;  ?></a>
      			</li>
      			<li class="nav-item">
      				<a class="nav-link text-white" onclick="return confirm('Are you sure you want to logout?');" href="logout.php"><span class="fa fa-sign-in"></span> Log Out</a>
      			</li>
      		</ul>
      	</div>
	</nav><br><br><br>
	<div class="container">
		<h3>Welcome, <?php echo $name; ?></h3>
		<h5><?php echo $_SESSION['company']; ?></h5>
		<hr>
		<div class="row">
			<div class="card blue col-4 lighten-5" style="width: 17rem;">
				<div class="view overlay">
					<span class="fa fa-gear fa-5x"></span>
					<a style="font-size: 25px;" class="font-weight-bold" href="employer-create-job.php"><div class="mask rgba-white-slight"></div> Manage Jobs</a>
				</div>
				<hr>
			</div>
			<div class="card col-4 red lighten-4" style="width: 17rem;">
				<div class="view overlay">
					<span class="fa fa-users fa-5x"></span>
					<a style="font-size: 25px;" class="font-weight-bold" href="employer-view-applicants.php"><div class="mask rgba-white-slight"></div> View Applicants</a>
				</div>
				<hr>
			</div>
			<div class="card col-4 green lighten-3" style="width: 17rem;">
				<div class="view overlay">
					<span class="fa fa-check fa-5x"></span>
					<a style="font-size: 25px;" class="font-weight-bold" href="#"><div class="mask rgba-white-slight"></div> Approved Jobs</a>
				</div>
				<hr>
			</div>
		</div>
	</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>