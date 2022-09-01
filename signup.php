<?php
session_start();

include("connection.php");
include("functions.php");

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$user_name = $_POST['user_name'];
	$mail_id = $_POST['mail_id'];
	$password = $_POST['password'];


	if (!empty($user_name) && !empty($password) && !empty($mail_id) && !is_numeric($user_name) ) {

		//save to database
		$user_id = random_num(20);
		$query = "insert into users (user_id,user_name,mail_id,password) values ('$user_id','$user_name','$mail_id','$password')";

		mysqli_query($con, $query);

		header("Location: login.php");
		die;

	}else {
		$error_message = "Please enter some valid information!";
	}
}	

?>


<!DOCTYPE html>
<html>

<head>
	<title>Signup</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-2">
			</div>
			<div class="col-8">
				<div class="row">
					<div class="col">
						<h2>Signup</h2>
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="alert alert-danger" role="alert" style="display:<?php echo (empty($error_message) ? 'none' : 'block') ?>">
							<?php echo $error_message; ?>
						</div>
						<form method="POST">
							<div class="form-group">
								<label for="signup-user-name">Username</label>
								<input type="text" class="form-control" id="signup-user-name" name="user_name" placeholder="Enter your name">
							</div>
							<div class="form-group">
								<label for="signup-email">Email</label>
								<input type="email" class="form-control" id="signup-email" name="mail_id" placeholder="Enter a valid e-mail">
							</div>
							<div class="form-group">
								<label for="signup-password">Password</label>
								<input type="password" class="form-control" id="signup-password" name="password" placeholder="Create your password">
							</div>
							<button type="submit" class="btn btn-primary">Signup</button>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<br>
						<p>Already have an account? <a href="login.php">Click here to Login</a></p>
					</div>
				</div>
			</div>
			<div class="col-2">
			</div>
		</div>
	</div>

</body>

</html>