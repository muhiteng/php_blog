<?php include 'includes/header.php'; ?>
<?php


session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}



?>

    <?php include 'includes/header.php'; ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-5 col-12 mx-auto">
                <form action="index.php?controller=users&action=register" method="post">

                <h2>Register Here</h2>
                    <div class="input-group mb-3">
                     Name :   <input type="text" class="form-control" name="username" >
                    </div>
                    <div class="input-group mb-3">
                    Email :    <input type="text" class="form-control" name="email" >
                    </div>
                    <div class="input-group mb-3">
                      Password:  <input type="password" class="form-control" name="password" >
                    </div>
                    <div class="input-group mb-3">
                      Confirm password :  <input type="password" class="form-control" name="cpassword" >
                    </div>
                    <div class="input-group">
                        <input type="submit" value="Register" class="btn btn-success"/>
                    </div>
                    <p class="mt-3">Do you have already an account? <a href="login.php">Login Here</a></p>
                </form>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>