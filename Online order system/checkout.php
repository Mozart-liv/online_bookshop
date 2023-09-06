<?php 
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if(isset($_POST['order'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $method = $_POST['method'];
    $order_at = date('d-M-Y');

    $total_price = 0;
    $cart_product[] = '';

    $cart_select = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = $user_id") or die('query failed');
    if(mysqli_num_rows($cart_select)>0){
        while($row = mysqli_fetch_assoc($cart_select)){
            $cart_product[] = $row['name'].' x '. '('.$row['quantity'].')';   
            $subtotal = $row['price'] * $row['quantity'];
            $total_price += $subtotal;
        }
    }

    $product = implode(", " , $cart_product);
    $check_order = mysqli_query($conn, "SELECT * FROM `order` WHERE name='$name' AND email = '$email' AND phone = '$phone' AND product = '$product' AND price = '$total_price'") or die('query failed');

    try{
        if(mysqli_num_rows($check_order) > 0){
            $message = 'order already';
        }else{
            mysqli_query($conn, "INSERT INTO `order` (user_id, name, email, phone, address, product, price, method, order_at) VALUES ('$user_id', '$name', '$email', $phone, '$address', '$product', '$total_price', '$method', '$order_at')") or die('query failed');
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            $message = 'order complete';
        }
    }catch(\Exception $e){
        echo $e;
    };  
    
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
    <?php include 'header.php'?>
    <h1 class="text-center my-3">Your Selection</h1>
    <table class="table table-striped container-lg mt-5">
        <thead>
            <tr class="text-center align-middle">
            <th scope="col">Cover</th>
            <th scope="col">Book</th>
            <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody> 
            <?php 
            $grandTotal = 0;
            $select = mysqli_query($conn, "SELECT * FROM  `cart` WHERE user_id= $user_id") or die('query failed');
            if(mysqli_num_rows($select)>0){
                while($row = mysqli_fetch_assoc($select)){
                    $total = ($row['price'] * $row['quantity']);
                    $grandTotal += $total;
            ?>
            
            <tr class="text-center align-middle">
            <td><img src="./img/<?php echo $row['img'];?>" alt="" width="100px"></td>
            <td><?php echo $row['name'].' x '. ($row['quantity'])?></td>
            <td><?php echo $total . '/Ks'?></td>
            </tr>

            <?php       
                }
            }else{  
                echo '<div class="text-center"><span class="border border-danger p-3">any product in cart</span></div>';
            }
            ?>

            <tr class="text-center align-middle ">
            <th colspan="2" class="fs-4">grand Total</th>
            <td><?php echo $grandTotal?></td>       
            </tr>
        </tbody>
    </table>
    <div class="text-center">
    <a href="./home.php#item" class="btn btn-warning ">Continue shopping</a>
    </div>
    
    

    <!-- costumer info  -->
    <h2 class="text-center py-5 ">Order</h2>
    <form action="" method="post" class="container bg-secondary p-4 rounded shadow-lg">
        <div class="form-group mb-3 text-white">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group mb-3 text-white">
            <label for="" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group mb-3 text-white">
            <label for="" class="form-label">Phone</label>
            <input type="number" name="phone" class="form-control" required>
        </div>
        <div class="form-group mb-3 text-white">
            <label for="" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <div class="form-group mb-3 text-white">
            <label for="">Payment method</label>
            <select name="method" class="form-select" required>
                <option value="cashOndeli">Cash on delivery</option>
                <option value="KBZ">KBZ</option>
                <option value="Yoma">Yoma Bank</option>
            </select>
        </div>
        <div class="text-center mt-4">
            
            <input type="submit" name="order" class="btn btn-success px-5" value="Order Now">
        </div>
        
        <span class="text-danger"><?php echo $message?></span>
    </form>
</body>
</html>