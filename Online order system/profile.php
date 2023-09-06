<?php 
include 'config.php';
session_start();

$error = $_FILES['photo']['error'];
$ptname = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];
$type = $_FILES['photo']['type'];
$id = $_SESSION['user_id'];

try{
    if($type == "image/jpeg" || $type =="image/png"){
        move_uploaded_file($tmp, "img/$ptname");
    
        mysqli_query($conn,"UPDATE `user` SET photo ='$ptname' WHERE id = '$id' ");
    }else{
        $error = "Your file is not image! Try again";
    };
} catch (\Exception $e) {
    echo "$e";
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
    <p class="text-center mt-5"> <a href="home.php">home</a> / Profile</p>

    <div class="container d-flex justify-content-center align-item-center mt-5">
        <div class="card shadow-lg p-4" style="width: 500px;">

            <?php if(file_exists("img/$ptname")):?>
            <img class="card-img-top mb-3"  src="./img/<?php echo $ptname?>" alt="" width="100px">
            
            <?php endif?>

            <div class="card-title"><h2>User Profile</h2></div>

            <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="file" name="photo" id="" class="form-control">
                    <button class="btn btn-secondary">Upload</button>
                </div>
            </form>

            <div class="border border-1 w-100 p-3 mt-5">
                <div>
                    <h3><?php echo $_SESSION['user_name']?></h3>
                </div>
                <div class="mt-1">
                    <b>email:</b>
                    <span><?php echo $_SESSION['user_email']?></span>
                </div>
                <button class="btn btn-danger mt-5">
                    <a href="logout.php" class="text-decoration-none text-white">Logout</a>

                </button>
            </div>
            </div>
        </div>
    </div>
</body>
</html>