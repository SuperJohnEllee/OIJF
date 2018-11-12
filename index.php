<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<meta name="author" content="OIJF">
	<meta name="description" content="Online International Job Finder for IT Students">
	<title>Online International Job Finder</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="img/job_finde.png">
  <style>
      .center{
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        display: block;
      }
      .centertext{
        position: absolute;
        font-size: 120px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }
  </style>
</head>
<body><br><br><br>
	<nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark">
		<a class="navbar-brand" href="#"><img src="img/job_finde.png" height="30" width="30"></a>
      		<button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      			<span class="navbar-toggler-icon"></span>
      		</button>
      	<div class="collapse navbar-collapse" id="navbar">
      		<ul class="navbar-nav mr-auto">
      			<li class="nav-item">
      				<a class="nav-link text-white" href="index.php"><span class="fa fa-home"></span> Home<span class="sr-only">(current)</span></a>
      			</li>
      		</ul>
      		<ul class="navbar-nav ml-auto">
      			<li class="nav-item">
      				<a class="nav-link text-white" data-toggle="modal" data-target="#register"><span class="fa fa-user"></span> Sign Up</a>
      			</li>
      			<li class="nav-item">
      				<a class="nav-link text-white" data-toggle="modal" data-target="#login"><span class="fa fa-sign-in"></span> Log In</a>
      			</li>
      		</ul>
      	</div>
	</nav>
  <?php include('library/modal/loginModal.php'); 
        include('library/modal/registerModal.php');
  ?>
  <div>
      <img class="center" width="460" height="300" src="img/career.jpg">
  </div>
    <form method="post">
      <div class="md-form">
      <div class="input-group mt-3 mx-auto col-lg-7">
        <input class="form-control" type="text" name="job_search" id="job_search">
        <label>Search for Jobs</label>
        <button type="submit" class="btn btn-primary" name="btn_search"><span class="fa fa-search"></span> Search</button>
      </div>
    </div>
  </form>
  <div class="container">
    <h1 class="text-center">Latest Jobs</h1>
    <div class="row">
  <?php
  $conn = mysqli_connect('localhost', 'root', '', 'oijf');
    if (isset($_POST['btn_search'])) {
        $job_search = $_POST['job_search'];
        $search = mysqli_query($conn, "SELECT * FROM job INNER JOIN employer USING(EmpID) WHERE JobType LIKE 
          '%$job_search%' OR JobSalary LIKE '%$job_search%'");
        if (mysqli_num_rows($search) > 0) {
            while ($search_row = mysqli_fetch_assoc($search)) {
              echo "<div class='card col-3' style='width:17rem;'>
                      <div class='view overlay'>
                        <span class='fa fa-user fa-5x'></span>
                        <h3>".$search_row['JobType']." <br> at ".$search_row['Company']."</h3>
                        <h5>Posted by ".$search_row['FirstName']." ".$search_row['LastName']."</h5>
                      </div>
                    </div>";
            }
        } else {
          echo "<div class='card mx-auto alert alert-danger' style='width:17rem;'>
                    <h1 class='text-center'><span class='fa fa-info-circle'></span> '$job_search' is not found<h1>
                  </div>
                </div>";
        }
    } else {
        $disp_search = mysqli_query($conn, "SELECT * FROM job INNER JOIN employer USING(EmpID) WHERE JobPostDate >= CURRENT_DATE() - INTERVAL 12 DAY_HOUR ORDER BY JobPostDate");
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
                  </div>
                </div>";
        }
    }
  ?>
</div>
</div>
<hr>
  <div class="container">
      <div class="text-center text-dark">
         <div class="row">
        <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
          <img style="border-radius: 80px;" class="img-fluid theo-mb-1" src="img/biodata.jpg">
          <h4><strong>Professional Jobs</strong></h4>
          <p>Track best professional jobs for you</p>
        </div>
        <div class="col-xs-12 col-md-4 col-xl-4">
          <img class="img-fluid theo-mb-1" src="img/job_finde.png">
          <h4><strong>Personal Page</strong></h4>
          <p>Log in to your personal page to view jobs that match you</p>
        </div>
        <div class="col-xs-12 col-md-4 col-xl-4">
          <img class="img-fluid theo-mb-1" src="img/job_finde.png">
          <h4><strong>Leadership</strong></h4>
          <p>Proving them a better way to become the leader</p>
        </div>
      </div>
      </div>
  </div>
  <div style="padding: 15px 0;" class="bg-dark text-white text-center">
      <h6 class="col-lg-12">Develop by Jardiolin Solutions &copy 2018. All Rights Reserved</h6>
  </div>
  <?php //include('library/html/footer.php'); ?>
<!--JS Libraries-->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>