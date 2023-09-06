<?php 
    include 'config.php';

    if(isset($_POST['btnRegister'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $psw = $_POST['psw'];
        $cpsw = $_POST['cpsw'];
        $user_type = $_POST['user_type'];

        $check = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' AND password = '$psw'");
        if(mysqli_num_rows($check) > 0){
            $messageAlready= 'Already use email or password! Try again';
        }else{
            if($psw != $cpsw){
                $messageWrong = "Password don't match";
            }else{
                mysqli_query($conn, "INSERT INTO `user` (name, password, email, user_type) VALUES('$name', '$psw', '$email', '$user_type')") or die('query failed');
                header('location: index.php');
            };
        };
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap  -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
<div class="card w-25 mx-auto mt-5 p-4 bg-light">
        <h2 class="text-center mb-2">Register</h2>

        <form action="" method="post">
        <div class="form-group mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="psw" class="form-label">Password</label>
                <input type="password" id="psw" name="psw" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="cpsw" class="form-label">Confirm Password</label>
                <input type="password" id="cpsw" name="cpsw" class="form-control">
            </div>
            <div class="form-group mb-3">
                <select name="user_type" class="form-select">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <div class="d-flex justify-content-center mt-4 mb-4">
                <input type="submit" value="Login" name="btnRegister" class="btn btn-info px-5 ">
            </div>

            <span class="me-3">already have an account</span><a href="./index.php">Login</a>

            <small><?php echo $messageAlready; echo $messageWrong?></small>
        </form>
    </div>
    
    
</body>
</html>