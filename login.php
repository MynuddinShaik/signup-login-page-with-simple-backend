<?php

session_start();

include("connection.php");
include("functions.php");

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];

	if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

		//read from database
		$query = "select * from users where user_name = '$user_name' limit 1";
		$result = mysqli_query($con, $query);
		if ($result) {
			if ($result && mysqli_num_rows($result) > 0) {

				$user_data = mysqli_fetch_assoc($result);

				if ($user_data['password'] === $password) {
					$_SESSION['user_id'] = $user_data['user_id'];
					header("Location: myprofile.php");
					die;
				}
			}
		}
		$error_message = "Enter a valid username or password!";
	} else {
		$error_message = "Enter a valid username or password!";
	}
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
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
						<h2>Login</h2>
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
								<label for="login-user-name">Username</label>
								<input type="text" class="form-control" id="login-user-name" name="user_name" placeholder="Enter registered username" value="<?php echo (isset($user_name) ? $user_name : '') ?>">
							</div>
							<div class="form-group">
								<label for="login-password">Password</label>
								<input type="password" class="form-control" id="login-password" name="password" placeholder="Enter correct password" value="<?php echo (isset($password) ? $password : '') ?>">
							</div>
							<button type="submit" class="btn btn-primary">Login</button>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<br>
						<p>Don't have an account? <a href="signup.php">Click here to Signup</a></p>
					</div>
				</div>
			</div>
			<div class="col-2">
			</div>
		</div>
	</div>

</body>

</html>