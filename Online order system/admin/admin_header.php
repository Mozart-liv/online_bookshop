<?php 
include './config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- fontawesome  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="">
	<div class="bg-dark col-2 float-start ">
	<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Martzo Admin Panel</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
					<li class="nav-item">
                        <a href="./admin_page.php" class="nav-link px-0 align-middle">
						<i class="fa-solid fa-gauge"></i><span class="ms-2 d-none d-sm-inline">Dashboard</span></a>
                    </li>	

					<li class="nav-item">
                        <a href="./admin_item.php" class="nav-link align-middle px-0">
						<i class="fa-solid fa-book"></i><span class="ms-2 d-none d-sm-inline">Products</span></a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="./admin_order_status.php" class="nav-link px-0 align-middle">
						<i class="fa-solid fa-table"></i><span class="ms-2 d-none d-sm-inline">Orders</span></a>
                    </li>
                    
					<li class="nav-item">
                        <a href="./admin_contact.php" class="nav-link px-0 align-middle">
						<i class="fa-regular fa-message"></i><span class="ms-2 d-none d-sm-inline">Message</span></a>
                    </li>
                    
                    <li class="nav-item">
					<a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
						<i class="fa-regular fa-user"></i><span class="ms-2 d-none d-sm-inline">Accounts</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="./admin_normaluser.php" class="nav-link px-0"> <span class="d-none d-sm-inline">> user</span></a>
                            </li>
                            <li>
                                <a href="./admin_user.php" class="nav-link px-0"> <span class="d-none d-sm-inline">> admin</span></a>
                            </li>
                        </ul>
                    </li>

                </ul>
                <hr>
                
				<div class="pb-4">
					<a href="../index.php" class="text-decoration-none"><i class="fa-solid fa-door-open me-2"></i>Logout</a>
				</div>
            </div>
	</div>
			


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>	
</body>
</html>
