<?php
  $conn = mysqli_connect('localhost', 'root', '', 'oijf');

  if (isset($_GET['del_job'])) {
  	$del_job = $_GET['del_job'];
  	$del_job_sql = mysqli_query($conn, "DELETE FROM job WHERE JobID = '$del_job'");
  	echo "<script>
  		alert('Deleted successfully');
  	</script>
	<meta http-equiv='refresh' content='0; url=employer-create-job.php'>";
  }

  if (isset($_GET['del_user'])) {
  	$del_user = $_GET['del_user'];
  	$del_user_sql = mysqli_query($conn, "DELETE FROM users WHERE UserID = '$del_user'");
  	echo "<script>
  		alert('Deleted successfully');
  	</script>
  	<meta http-equiv='refresh' content='0; url=employer-view-applicants.php'>";
  }
?>