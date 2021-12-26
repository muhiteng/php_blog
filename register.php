<?php

include 'admin/includes/dbconfig.php'; // Include database configuration file



session_start();

if (isset($_SESSION['id'])) {
    header("Location: admin/index.php");
}

$msg = "";

error_reporting(0);

if (isset($_POST['submit'])) { // Check register button is clicked or not
    // Define  variables
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if ($password == $cpassword) { // Check password is match or not
        $sql = "SELECT username, email FROM users WHERE username='$user_name' AND email='$email'";
        //get query from database
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $msg = "<div class='alert alert-danger'>Username or Email is already exists.</div>";
        } else {
            // status default value =1
            $insertSql = "INSERT INTO users (username, email, password, role) VALUES ('$user_name', '$email', '$password', '0')";
            $insertResult = mysqli_query($conn, $insertSql);
            if ($insertResult) {
                $msg = "<div class='alert alert-success'>Your registration is completed. Now you can login.</div>";
                $_POST['username'] = "";
                $_POST['email'] = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                $msg = "<div class='alert alert-danger'>Your registration is not completed. Please try again.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Password not matched. Please try again.</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-5 col-12 mx-auto">
                <form action="" method="POST">
                    <?php echo $msg; ?>
                    <h2>Register Here</h2>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Enter your Username" value="<?php echo $_POST['username']; ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Enter your Email" value="<?php echo $_POST['email']; ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Enter your Password" value="<?php echo $_POST['password']; ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" value="<?php echo $_POST['cpassword']; ?>" required>
                    </div>
                    <div class="input-group">
                        <button type="submit" name="submit" class="btn btn-primary">Register</button>
                    </div>
                    <p class="mt-3">Do you have already an account? <a href="login.php">Login Here</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>