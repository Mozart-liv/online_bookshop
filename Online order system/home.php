<?php 
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if(isset($_POST['add_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_img = $_POST['product_img'];
    $product_quantity = $_POST['product_quantity'];

    $check = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check) > 0){
        $message = "already added product";
    }else{
        mysqli_query($conn, "INSERT INTO `cart` (user_id, name, price, quantity, img) VALUES ('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_img')") or die('query failed');
        $message = "product added to cart";
        header('location: home.php#item');
    }
    
}

// cart crud 

if(isset($_POST['update_cart'])){
    $cart_id = $_POST['cart_id'];
    $update_qty = $_POST['update_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = $update_qty WHERE id= $cart_id") or die('query failed');
    header("location: home.php#item");
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id= $delete_id") or die('query failed');
    header("location: home.php#item");
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = $user_id") or die('query failed');
    $message[] = "Delete all Done";
    header("location: home.php#item");
};

// contact 
if(isset($_POST['send_msg'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $msg = $_POST['message'];
    
    mysqli_query($conn, "INSERT INTO `message` (user_id, name, email, phone, message) VALUES ($user_id, '$name', '$email', '$phone', '$msg')") or die('query failed');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstarp  -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    
    <!-- fontawesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-light">
    <?php include 'header.php'?>
    
    <!-- home start  -->
    <div class="position-relative" id="home">
        <img src="./img/The_Hastings_Bookshop.jpg" alt="" class="w-100 opacity-50 object-fit-cover" style="height: 95vh;" >

        <h1 class="position-absolute top-50 start-50 translate-middle" style="font-size: 100px;">Welcome from Bookshop</h1>
    </div>
    <!-- home end  -->


    <!-- item start  -->

    <div class="container-lg" id="item">
        <h2 class="text-center m-5">Item</h2>
        <div class="d-flex flex-row flex-wrap justify-content-evenly py-4">
        <?php 
        $select = mysqli_query($conn, "SELECT * FROM `product`")or die ('query failed');
        if(mysqli_num_rows($select)){
            while($row = mysqli_fetch_assoc($select)){
        ?>
            
            <div class="card mb-4 shadow-md" style="width: 300px;">
                
            <form action="" method="post" class="box">
                <img src="./img/<?php echo $row['img']?>" class="card-img-top img-thumbnail" alt="" >
                <div class="card-body align-middle my-auto" >
                    <div class="card-title mb-3"><span class="fs-4 fw-bold"><?php echo $row['name']?></span> </div>
                    <span class="mb-3"><?php echo $row['author']?></span>
                    <div class="mt-3"><?php echo $row['price'] ?> /Ks</div>
                </div>
                
                <input type="number" name="product_quantity" value="1" id="" class="form-control mx-3  w-25" >
                <input type="hidden" name="product_name" value="<?php echo $row['name'] ?>">  
                <input type="hidden" name="product_price" value="<?php echo $row['price'] ?>">
                <input type="hidden" name="product_img" value="<?php echo $row['img'] ?>">  
                <input type="submit" value="Add to cart" name="add_cart" class="btn btn-outline-success m-3" >
            </form>
                
            </div>
        
        <?php        
            }
        }
        ?>
        </div>
    </div>

    <!-- item end  -->

    <!-- cart start  -->
    <div>
        <div class="offcanvas offcanvas-start bg-light" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Your cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
            
                <?php 
                    $grandTotal = 0;
                    $select = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = $user_id") or die('query failed');
                    if(mysqli_num_rows($select) > 0){
                        while($row = mysqli_fetch_assoc($select)){
                ?>
                <div class="row my-3 ">
                    <img src="./img/<?php echo $row['img']?>" alt="" width="10px" class="col-4">
                    <div class="col-4">
                        <b><?php echo $row['name']?></b>
                        <p><?php echo $row['price']?></p>
                    </div>
                    
                    <form action="" method="post" class="col-4">
                        <input type="hidden" name="cart_id" value="<?php echo $row['id']?>">
                        <input type="number" name="update_quantity" class="form-control w-50" value="<?php echo $row['quantity']?>">
                        <input type="submit" name="update_cart" value="Update" class="btn btn-warning my-3" >
                    </form>
                    
                    <div class="offset-5 my-3">
                        <a href="home.php?delete=<?php echo $row['id']?>"><i class="fa-solid fa-trash-can fs-5 text-danger"></i></a>
                        <div class="text-success w-50 border-start border-bottom border-warning d-inline p-2 ms-3">subtotal: <span><?php echo $subTotal = ($row['price'] * $row['quantity']) ?></span>/Ks</div>
                    </div>
                    
                </div>
                <hr>
                
                <?php 
                $grandTotal += $subTotal;
                    }
                }else{
                    echo "<p>any products are added</p>";
                } 
                ?>

                <div class="my-3 text-center">
                    <a href="home.php?delete_all" class="btn btn-danger px-4"><i class="fa-solid fa-trash-can fs-5 text-white me-3"></i>Delete All Item</a>
                </div>

                <div>
                    <p class="border border-success bg-opacity-10 bg-info rounded p-2 text-center">grand Total - <span><?php echo $grandTotal?></span>/Ks</p>
                    <div class="text-center d-grid gap-2">
                        <a href="./checkout.php" class="btn btn-success py-2">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart end  -->

    <!-- contact start -->
    <div class="container bg-dark p-4 rounded-4" id="contact">
        <h2 class="text-white text-center m-3">Contact us</h2>
        <form action="" method="post" class="mt-4 p-4">
            <input type="text" placeholder="Your Name" name="name" class="form-control mb-3">
            <input type="email" placeholder="Your email" name="email" class="form-control mb-3">
            <input type="number" placeholder="Your Phone" name="phone" class="form-control mb-3">
            <textarea name="message" id="" cols="30" rows="10" class="form-control mb-3"></textarea>
            <input type="submit" value="Send" class="btn btn-danger px-5" name="send_msg">
        </form>
    </div>
    <!-- contact end  -->
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>