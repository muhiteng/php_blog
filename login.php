<?php 


session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}



?>
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>


<form action="index.php?controller=users&action=login" method="post">

                    <h2>Login Here</h2>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="email"  >
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" >
                    </div>
                    <div class="input-group">
                        <input type="submit" value="Login" class="btn btn-success"/>
                    </div>
                    <p class="mt-3">Don't have any account? <a href="register.php">Register Here</a></p>

</form>


</body>
</html>