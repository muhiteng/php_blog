<?php 

include 'admin/includes/dbconfig.php'; // Include database configuration file

session_start();

if (isset($_SESSION['id'])) {
    header("Location: admin/index.php");
}

error_reporting(0);

$msg = "";

if (isset($_POST['submit'])) {
    $user_name = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$user_name' OR email='$user_name'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] == $password) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            header("Location: admin/index.php");
        } else {
            $msg = "<div class='alert alert-danger'>Password is incorrect. Please try again.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Username or Email is incorrect. Please try again.</div>";
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
                    <h2>Login Here</h2>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Enter your Username or Email" value="<?php echo $_POST['username']; ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Enter your Password" value="<?php echo $_POST['password']; ?>" required>
                    </div>
                    <div class="input-group">
                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                    </div>
                    <p class="mt-3">Don't have any account? <a href="register.php">Register Here</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>