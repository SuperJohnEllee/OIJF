<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header("location: index.php");
	}

	$id = $_SESSION['user_id'];
	$name = $_SESSION['name'];
	$email = $_SESSION['email'];

	$conn = mysqli_connect('localhost', 'root', '', 'oijf');
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<title>Online International Job Finder</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
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
		<h1><span class="fa fa-pencil"></span> Create Resume</h1>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<h3>Personal Info</h3>
				<form method="post">
					<div class="md-form mb-4">
						<i class="fa fa-university prefix"></i>
						<input class="form-control" type="text" name="school">
						<label>School Graduated</label>
					</div>
					<div class="md-form mb-4">
						<i class="fa fa-university prefix"></i>
						<input class="form-control" type="text" name="course">
						<label>Course</label>
					</div>
					<div class="md-form mb-4">
						<i class="fa fa-asterisk prefix"></i>
						<textarea class="form-control md-textarea" rows="5" name="skills"></textarea>
						<label>Skills</label>
					</div>
					<div class="md-form mb-4">
						<button type="submit" class="btn btn-info" name="create_resume"><span class="fa fa-pencil"></span> Create</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php

	if (isset($_POST['create_resume'])) {
		
		$school = $_POST['school'];
		$course = $_POST['course'];
		$skills = $_POST['skills'];

		$id = $_SESSION['user_id'];
		if (empty($school) || empty($course) || empty($skills)) {
			echo "<script>
				alert('Input all fields');
				window.open('user-create-resume.php', '_self');
			</script>";
		} else {
			$resume_sql = mysqli_query($conn, "INSERT INTO resume(UserID, School, Course, Skills)
				VALUES('$id', '$school', '$course', '$skills')");
			echo "<script>
				alert('Sucessfully created a resume');
			</script>
			<meta http-equiv='refresh' content='0; url=user-create-resume.php'>";
		}
	}
?>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script>
	$(document).ready(function() {
 	$('.mdb-select').materialSelect();
});
</script>
</body>
</html>