<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header("location: index.php");
	}

	$id = $_SESSION['emp_id'];
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
	<div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h3 class="modal-title w-100 text-dark"><strong><span class="fa fa-tasks"></span> Add Jobs</strong></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<div class="modal-body mx-4">
                <form method="post">
                    <div class="md-form mb-5">
                        <input type="text" name="job_type" id="job_type" class="form-control">
                        <label data-error="wrong" data-success="right" for="news_title">Job Type</label>
                    </div>
                    <div class="md-form mb-4">
                        <textarea class="form-control md-textarea" name="job_desc" id="job_desc" maxlength="1000" rows="7" autofocus></textarea>
                        <label data-error="wrong" data-success="right" for="news_content">Job Description</label>
                    </div>
                    <div class="md-form mb-4">
                    	<input class="form-control" type="text" name="job_salary">
                    	<label>Salary</label>
                    </div>
                    <div class="md-form mb-4">
                        <button type="submit" class="btn btn-default pull-right" name="add_job" ><span class="fa fa-plus"></span> Add</button>
                    </div>
                </form>
            </div>
		</div>
	</div>
</div>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-tasks"></span> Manage Jobs</h1>
			<a class="btn btn-info" data-toggle="modal" data-target="#jobModal"><span class="fa fa-plus"></span> Add Jobs</a>
			<hr>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th>Job ID</th>
						<th>Job Type</th>
						<th class="text-center">Job Description</th>
						<th>Job Salary</th>
						<th>Date Posted</th>
						<th class="text-center" colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$conn = mysqli_connect('localhost', 'root', '', 'oijf');
						$disp_job = mysqli_query($conn, "SELECT * FROM job WHERE EmpID = '$id' ORDER BY JobID DESC");
						if (mysqli_num_rows($disp_job) > 0) {
							while ($job_row = mysqli_fetch_assoc($disp_job)) {
								?>
								<tr>
									<td><?php echo $job_row['JobID']; ?></td>
									<td><?php echo $job_row['JobType']; ?></td>
									<td><?php echo $job_row['JobDesc']; ?></td>
									<td><?php echo $job_row['JobSalary']; ?></td>
									<td><?php echo $job_row['JobPostDate']; ?></td>
									<td><a class="btn btn-info" href="#"><span class="fa fa-edit"></span> Edit</a></td>
									<td><a onclick="return confirm('Delete this job?');" class="btn btn-danger" href="action.php?del_job=<?php echo $job_row['JobID'] ?>"><span class="fa fa-trash"></span> Delete</a></td>
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
<?php
	
	$conn = mysqli_connect('localhost', 'root', '', 'oijf');
	
	if (isset($_POST['add_job'])) {
		
		$job_type = $_POST['job_type'];
		$job_desc = $_POST['job_desc'];
		$job_salary = $_POST['job_salary'];

		if (empty($job_type) || empty($job_desc) || empty($job_salary)) {
			echo "<script>
				alert('Input all fields');
				window.open('employer-create-job.php', '_self');
			</script>";
		} else {
			$add_job = mysqli_query($conn, "INSERT INTO job(EmpID, JobType, JobDesc, JobSalary, JobPostDate)
				VALUES('$id', '$job_type', '$job_desc', '$job_salary', NOW())");
			echo "<script>
				alert('Added Job Successfully');
			</script>
			<meta http-equiv='refresh' content='0; url=employer-create-job.php'>";
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