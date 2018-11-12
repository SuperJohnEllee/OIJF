<!DOCTYPE html>
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
	<div class="container py-5 mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6 mx-auto">
						<div class="card rounded-0">
							 <div class="card-header mdb-color darken-4">
                            	<h3 class="text-center text-white mb-0"><span class="fa fa-sign-in"></span> Login Credentials for Employers</h3>
                        	</div>
							<div class="card-body">
								<form class="form" method="post" role="form" autocomplete="off" id="formLogin">
									<div class="form-group">
										<label>Email</label>
										<input class="form-control form-control-lg rounded-0" type="email" name="email" required>
									</div>
									<div class="form-group">
										<label>Password</label>
										<input class="form-control form-control-lg rounded-0" type="password" name="password" id="admin_pass" required autocomplete="new-password">
									</div>
									<p>Don't Have an account?<a style="text-decoration: none;" href="employer_register.php"> Sign Up Here</a></p>
									<button class="btn btn-success btn-lg float-right" type="submit" name="login" id="btnLogin"><i class="fa fa-sign-in"></i> Login
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		$conn = mysqli_connect('localhost', 'root', '', 'oijf') or 
		die('Connection Failed: ' . mysqli_error()); // set connection

		session_start(); //starts the session

		if (isset($_POST['login'])) {
		 	
		 	//define login variables
			$txtEmail = mysqli_real_escape_string($conn, $_POST['email']);
			$txtPass = mysqli_real_escape_string($conn, $_POST['password']);

			//query start
			$log_sql = "SELECT * FROM employer WHERE Email = '$txtEmail' AND Password = '$txtPass'";
			$log_res = mysqli_query($conn, $log_sql);

			if (mysqli_num_rows($log_res) == 1) {
				$log_row = mysqli_fetch_assoc($log_res);

				//session variables
				$_SESSION['email'] = $log_row['Email'];
				$_SESSION['lastname'] = $log_row['LastName'];
				$_SESSION['firstname'] = $log_row['FirstName'];
				$_SESSION['midname'] = $log_row['Midname'];
				$_SESSION['name'] = $log_row['FirstName'] . ' ' . $log_row['LastName'];
				$_SESSION['fullname'] = $log_row['FirstName'] . ' ' . $log_row['Midname'] . ' ' . $log_row['LastName'];
				$_SESSION['company'] = $log_row['Company'];
				$_SESSION['emp_id'] = $log_row['EmpID'];
				header("location: employer-dashboard.php");
			
			} else {
				echo "<h3 class='alert alert-danger text-center'>Wrong Email or Password</h3>";
			}
		}
	?>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>