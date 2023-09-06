<?php 
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
} 
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
    <?php include 'header.php';?>

    <div class="container-md-6">
        <h1 class="text-center">Your Order</h1>
        <p class="text-center"> <a href="home.php">home</a> / orders </p>
        <div class="container d-flex justify-content-evenly flex-wrap my-5">
            <?php 
            $select = mysqli_query($conn, "SELECT * FROM `order` ") or die('query_die');
            if(mysqli_num_rows($select)> 0){
                while($row = mysqli_fetch_assoc($select)){
            ?>
            
            <div class="card p-4" style="width: 400px;">
                <p> <b>place on: </b><span><?php echo $row['order_at']?></span></p>
                <p> <b>name: </b><span><?php echo $row['name']?></span></p>
                <p> <b>email: </b><span><?php echo $row['email']?></span></p>
                <p> <b>phone: </b><span><?php echo $row['phone']?></span></p>
                <p> <b>address: </b><span><?php echo $row['address']?></span></p>
                <p> <b>total products: </b><span><?php echo $row['product']?></span></p>
                <p> <b>total price: </b><span><?php echo $row['price']?></span></p>
                <p> <b>payment method: </b><span><?php echo $row['method']?></span></p>
                <p> <b>Delivery: </b><span class="<?php if($row['delivery'] == "pending"){echo 'text-danger';}else{echo 'text-success';}?>"><?php echo $row['delivery']?></span></p>
                <p> <b>Payment: </b><span class="<?php if($row['payment'] == "pending"){echo 'text-danger';}else{echo 'text-success';}?>"><?php echo $row['payment']?></span></p>
            </div>
            
            <?php        
                }
            }else{
                echo '<div class="text-center"><span class="border border-danger p-3">No order yet</span></div>';
            }
            ?>
        </div>
        
    </div>
</body>
</html>