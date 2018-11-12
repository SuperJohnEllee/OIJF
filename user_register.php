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
</head>
<body>
<div class="container">
    <h3 class="text-center">CREATE ACCOUNT FOR USERS</h3>
    <form method="post">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-sm-3 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="lastname" required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-sm-3">First Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="firstname" required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-sm-3 control-label">Middle Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="midname" required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-10">
                    <input class="form-control" type="email" name="email" required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-sm-3 control-label">Password</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" name="password" required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-sm-3 control-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" name="confirm_pass" required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success" name="register">CREATE ACCOUNT</button>
            </div>
        </div>
    </form>
</div>
<?php
  $conn = mysqli_connect('localhost', 'root', '', 'oijf') or 
  die('Connection Failed: ' . mysqli_error());

  if (isset($_POST['register'])) {
      
      $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
      $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
      $midname = mysqli_real_escape_string($conn, $_POST['midname']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $confirm_pass = htmlspecialchars($_POST['confirm_pass']);

      $check_email = mysqli_query($conn, "SELECT * FROM users WHERE Email = '$email'");

      if (mysqli_num_rows($check_email) > 0) {
          
          echo "<script>
            alert('Email is already existing');
          </script>";
      }

      elseif ($password != $confirm_pass) {
          
          echo "<script>
            alert('Password do not match');
          </script>";
      } else {

         $register_sql = "INSERT INTO users (LastName, FirstName, Midname, Email, Password, RegisterDate)
         VALUES ('$lastname', '$firstname', '$midname', '$email', '$password', NOW())";

         $register_res = mysqli_query($conn, $register_sql);

         if ($register_res) {
            
              echo "<script>
                alert('You are now registered Successfully');
                window.open('index.php?remarks=success', '_self');
              </script>";
         } else {

              echo "<script>
                alert('Failure in registration');
              </script>";
         }
      }
  }
?>
</body>
</html>