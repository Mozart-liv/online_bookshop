<?php 
include 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white  sticky-top">
        <div class="container-lg">
            <a class="navbar-brand text-danger me-5" href="#">Mozart</a>
    
            
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
    
              <div class="collapse navbar-collapse position-relative" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-danger col-10">
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="home.php#home">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="./home.php#item">Item</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="./order.php">Order</a>
                  </li>
                  <li class="nav-item">
                    <a href="./home.php#contact" class="nav-link text-danger">Contact</a>
                  </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-danger col-2">
                  <li class="nav-item ">
                    <?php 
                    $select = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id= $user_id") or die('query failed');
                    $row = mysqli_num_rows($select);
                    ?>
                  <button class="btn btn-outline-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="fa-solid fa-cart-shopping me-3"></i>Cart (<?php echo $row?>)</button>
                  </li>
                  <li class="nav-item position-absolute start-100">
                    <a href="profile.php" class="nav-link text-danger">Profile</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
    </nav>

    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>