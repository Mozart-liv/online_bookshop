<?php 
include '../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../index.php');
};

if(isset($_GET['delete'])){
    $deleteId = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id = $deleteId") or die('query failed');   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap  -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <?php include './admin_header.php'?>

    <div class="col-9 py-3 px-4 float-start">
        <h1 class="text-center my-3">Message</h1>
        <div class="container d-flex flex-wrap justify-content-evenly">
            <?php 
            $select = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            if(mysqli_num_rows($select)>0){
                while($row = mysqli_fetch_assoc($select)){
            ?>
            <div class="card border border-dark p-4" style="width: 300px;">
                <p>user id : <span class="text-danger"><?php echo $row['user_id']?></span></p>
                <p>name : <span class="text-danger"><?php echo $row['name']?></span></p>
                <p>email : <span class="text-danger"><?php echo $row['email']?></span></p>
                <p>phone : <span class="text-danger"><?php echo $row['phone']?></span></p>
                <p>message : <span class="text-danger"><?php echo $row['message']?></span></p>
                <a href="admin_contact.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete Message</a>
            </div>
            <?php
                }
            }
            ?>
            
        </div>
    </div>
</body>
</html>