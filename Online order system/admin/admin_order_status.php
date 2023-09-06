<?php 
include '../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update'])){
    $order_id = $_POST['order_id'];
    $update_deli = $_POST['delivery'];
    $update_payment = $_POST['payment'];
    mysqli_query($conn, "UPDATE `order` SET delivery = '$update_deli' , payment = '$update_payment'") or die('query failed');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `order` WHERE id = $delete_id") or die('query failed');
    header('location: admin_order_status.php');
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
<?php include 'admin_header.php';?>
    <div class="container-md-6 col-9 py-3 ms-3 float-start">
        <h1 class="text-center">Order</h1>
        <div class="container d-flex justify-content-evenly flex-wrap my-5">
            <?php 
            $select = mysqli_query($conn, "SELECT * FROM `order` ") or die('query_die');
            if(mysqli_num_rows($select)> 0){
                while($row = mysqli_fetch_assoc($select)){
            ?>
            
            <div class="card p-4" style="width: 400px;">
                <p> <b>user id: </b><span><?php echo $row['user_id']?></span></p>
                <p> <b>name: </b><span><?php echo $row['name']?></span></p>
                <p> <b>email: </b><span><?php echo $row['email']?></span></p>
                <p> <b>phone: </b><span><?php echo $row['phone']?></span></p>
                <p> <b>address: </b><span><?php echo $row['address']?></span></p>
                <p> <b>total products: </b><span><?php echo $row['product']?></span></p>
                <p> <b>total price: </b><span><?php echo $row['price']?></span></p>
                <p> <b>payment method: </b><span><?php echo $row['method']?></span></p>
                <p> <b>place on: </b><span><?php echo $row['order_at']?></span></p>
                <form action="" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $row['id']?>">
                    <select name="delivery" class="form-select my-3">
                        <option value="" selected disabled>Delivery Status (<?php echo $row['delivery']?>)</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                    <select name="payment" class="form-select my-3">
                        <option value="" selected disabled>Payment Status (<?php echo $row['payment']?>)</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                    <input type="submit" value="update" name="update" class="btn btn-warning my-3 me-3">
                    <a href="admin_order_status.php?delete=<?php echo $row['id']?>" class="text-danger">Delete order</a>
                </form>
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