<?php 
include '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header("location: ../index.php");
};

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
    <?php include 'admin_header.php';?>
    <div class="col-9 py-3 ms-3 float-start d-flex flex-wrap justify-content-evenly">
        
        <div class="box border border-dark rounded w-25 p-3 m-3">
            <?php 
            $total_pending = 0;
            $select_pending = mysqli_query($conn, "SELECT price FROM `order` WHERE payment = 'pending'");
            if(mysqli_num_rows($select_pending) > 0){
                while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                   $total_price = $fetch_pendings['price'];
                   $total_pendings += $total_price;
                };
             };
            ?>
            <h3 class="text-center"><?php echo $total_pendings; ?>/Ks</h3>
         <p class="text-center">pendings payments</p>
        </div>

        <div class="box border border-dark rounded w-25 p-3 m-3">
            <?php 
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT price FROM `order` WHERE payment = 'completed'");
            if(mysqli_num_rows($select_completed) > 0){
                while($fetch_completed = mysqli_fetch_assoc($select_pending)){
                   $total_price_completed = $fetch_completed['price'];
                   $total_completed += $total_price_completed;
                };
             };
            ?>
            <h3 class="text-center"><?php echo $total_completed; ?>/Ks</h3>
            <p class="text-center">Completed payments</p>
        </div>

        <div class="box border border-dark rounded w-25 p-3 m-3">
            <?php 
                $select_pending_order = mysqli_query($conn, "SELECT * FROM `order` WHERE payment = 'pending'");
                $total_pendings_order = mysqli_num_rows($select_pending_order);
            ?>
            <h3 class="text-center"><?php echo $total_pendings_order; ?></h3>
            <p class="text-center">total pendings order</p>
        </div>

        <div class="box border border-dark rounded w-25 p-3 m-3">
            <?php 
                $select_completed_order = mysqli_query($conn, "SELECT * FROM `order` WHERE payment = 'completed'");
                $total_completed_order= mysqli_num_rows($select_completed_order);
            ?>
            <h3 class="text-center"><?php echo $total_completed_order; ?></h3>
            <p class="text-center">total completed order</p>
        </div>

        <div class="box border border-dark rounded w-25 p-3 m-3">
            <?php 
                $select_order = mysqli_query($conn, "SELECT * FROM `order`");
                $total_order= mysqli_num_rows($select_order);
            ?>
            <h3 class="text-center"><?php echo $total_order; ?></h3>
            <p class="text-center">order placed</p>
        </div>

        <div class="box border border-dark rounded w-25 p-3 m-3">
            <?php 
                $select_order = mysqli_query($conn, "SELECT * FROM `product`");
                $total_order= mysqli_num_rows($select_order);
            ?>
            <h3 class="text-center"><?php echo $total_order; ?></h3>
            <p class="text-center">products added</p>
        </div>

        <div class="box border border-dark rounded w-25 p-3 m-3">
            <?php 
                $select_normal = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type = 'user'");
                $total_normal= mysqli_num_rows($select_normal);
            ?>
            <h3 class="text-center"><?php echo $total_normal; ?></h3>
            <p class="text-center">normal users</p>
        </div>

        <div class="box border border-dark rounded w-25 p-3 m-3">
            <?php 
                $select_admin = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type = 'admin'");
                $total_admin= mysqli_num_rows($select_admin);
            ?>
            <h3 class="text-center"><?php echo $total_admin; ?></h3>
            <p class="text-center">admin users</p>
        </div>

        <div class="box border border-dark rounded w-25 p-3 m-3">
            <?php 
                $select_acc = mysqli_query($conn, "SELECT * FROM `user`");
                $total_acc= mysqli_num_rows($select_acc);
            ?>
            <h3 class="text-center"><?php echo $total_acc; ?></h3>
            <p class="text-center">total accounts</p>
        </div>

        <div class="box border border-dark rounded w-25 p-3 m-3">
            <?php 
                $select_msg = mysqli_query($conn, "SELECT * FROM `message`");
                $total_msg= mysqli_num_rows($select_msg);
            ?>
            <h3 class="text-center"><?php echo $total_msg; ?></h3>
            <p class="text-center">Message</p>
        </div>
    </div>  
</body>
</html>