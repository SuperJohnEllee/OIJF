<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header("location: index.php");
	}

	$id = $_SESSION['user_id'];
	$name = $_SESSION['name'];
	$fullname = $_SESSION['fullname'];
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
		<h1><?php echo $name; ?>'s Profile</h1>
		<hr>
		<div class="row">
			<div class="card cyan lighten-4 col-6" style="width: 17rem;">
				<h3 class="text-center">Personal Information</h3>
				<div class="view overlay">
					<div class="card-body">
						<h3>Name: <?php echo $fullname; ?></h3>
						<h3>Email: <?php echo $email; ?></h3>
					</div>
				</div>
			</div>
			<div class="card cyan lighten-4 col-6" style="width: 17rem;">
				<h3 class="text-center">Your Resume</h3>
				<div class="view overlay">
					<div class="card-body">
						<?php
							$disp_resume = mysqli_query($conn, "SELECT * FROM resume INNER JOIN users USING(UserID) WHERE UserID = '$id'");
							if (mysqli_num_rows($disp_resume) > 0) {
								$resume_row = mysqli_fetch_assoc($disp_resume);
								echo "<h3>School: ".$resume_row['School']."</h3>
									<h3>Course: ".$resume_row['Course']."</h3>
									<h3>Skills: ".$resume_row['Skills']."</h3>";
							} else {
								echo "<h3 class='text-center alert alert-warning'><span class='fa fa-info-circle'></span> You have no resume, create your resume now</h3>";
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>