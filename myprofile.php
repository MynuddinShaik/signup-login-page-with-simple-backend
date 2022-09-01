<?php
session_start();
//including connection.php and function.php
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $id = $_POST['profile-id'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];

    if (empty($age)) {
        $age = 'NULL';
    }

    //save data to database
    $query = "update users SET age=$age,dob='$dob',contact='$contact' where user_id=$id";

    mysqli_query($con, $query);
}

$user_data = check_login($con);

?>
<!DOCTYPE html>
<html>

<head>
    <title>My Profile </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-11">
                <h2>Welcome, <?php echo $user_data['user_name']; ?></h2>
            </div>
            <div class="col-1">
                <a href="logout.php" class="btn btn-link">Logout</a>
            </div>
        </div>
        <br>
        <form method="POST">
            <input type="hidden" name="profile-id" value="<?php echo $user_data['user_id'] ?>">
            <div class="form-group">
                <label for="profile-age">Age</label>
                <input type="number" class="form-control" id="profile-age" name="age" value="<?php echo $user_data['age'] ?>">
            </div>
            <div class="form-group">
                <label for="profile-dob">DOB</label>
                <input type="date" class="form-control" id="profile-dob" name="dob" value="<?php echo $user_data['dob'] ?>">
            </div>
            <div class="form-group">
                <label for="profile-contact">Contact</label>
                <input type="text" class="form-control" id="profile-contact" name="contact" value="<?php echo $user_data['contact'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile Information</button>
        </form>
    </div>
</body>

</html>