<?php
include 'config.php';
session_start();

if(isset($_POST['btnLogin'])){
    $email = $_POST['email'];
    $psw = $_POST['psw'];

    $check = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' AND password = '$psw'");

    if(mysqli_num_rows($check) > 0){
        $row = mysqli_fetch_assoc($check);

        if($row['user_type'] == "admin"){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location: ./admin/admin_page.php');
        }else{
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location: home.php');
        }
    }else{
        $messageWrong = "incorrect email or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- bootstrap  -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
    <div class="card w-25 mx-auto mt-5 p-4 bg-light">
        <h2 class="text-center mb-2">Login</h2>

        <form action="" method="post">
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            <div class="form-group mb-5">
                <label for="psw" class="form-label">Password</label>
                <input type="password" id="psw" name="psw" class="form-control">
            </div>
            <div class="d-flex justify-content-center mt-4 mb-4">
                <input type="submit" value="Login" name="btnLogin" class="btn btn-info px-5 ">
            </div>

            <span class="me-3">Don't have an account?</span><a href="./register.php">Register</a>

            <small><?php echo $messageWrong?></small>
        </form>
    </div>
    <?php

?>
</body>
</html>