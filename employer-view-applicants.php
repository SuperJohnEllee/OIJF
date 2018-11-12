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
  	<link rel="stylesheet" href="css/mdb.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="icon" href="img/job_finde.png">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-dark fixed-top">
		<a class="navbar-brand" href="#"><img src="img/job_finde.png" height="30" width="30"></a>
      		<button class="navbar-toggler bg-info darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      			<span class="fa fa-bars text-white"></span>
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
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-tasks"></span> Manage Applicants</h1>
			<hr>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Register Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$conn = mysqli_connect('localhost', 'root', '', 'oijf');
						$disp_user = mysqli_query($conn, "SELECT * FROM users ORDER BY RegisterDate DESC");
						if (mysqli_num_rows($disp_user) > 0) {
							while ($user_row = mysqli_fetch_assoc($disp_user)) {
								?>
								<tr>
									<td><?php echo $user_row['FirstName'] ." " .  $user_row['Midname'] . " " . $user_row['LastName']; ?></td>
									<td><?php echo $user_row['Email']; ?></td>
									<td><?php echo $user_row['RegisterDate']; ?></td>
									<td><a onclick="return confirm('Delete this user?');" class="btn btn-danger" href="action.php?del_user=<?php echo $user_row['UserID'] ?>"><span class="fa fa-trash"></span> Delete</a></td>
								</tr>
						<?php	} ?>
 					<?php	} else {
							echo "<tr><td colspan='11'><h1 class='alert alert-warning text-center'><span class='fa fa-info-circle'></span> No Jobs Found </h1></td></tr>";
						}

					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>