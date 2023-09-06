<?php 
include '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header("location: ../index.php");
};

if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $img = $_FILES['img']['name']; 
    $img_tmp = $_FILES['img']['tmp_name'];
    $type = $_FILES['img']['type'];

    $check_product = mysqli_query($conn, "SELECT name FROM  `product` WHERE name='$name'") or die('query failed');

    if(mysqli_num_rows($check_product) > 0){
      echo  $error = "product name has already";
    }else{
        try{
            if($type == "image/jpeg" || $type == "image/png"){
                move_uploaded_file($img_tmp, "../img/$img");
                mysqli_query($conn, "INSERT INTO `product` (name, author, price, img) VALUES ('$name' , '$author', '$price', '$img')") or die('query failed');
            };
        } catch(\Exception $e){
            echo $e;
        }  ;       
    };
}

//  DELETE 
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_img = mysqli_query($conn, "SELECT img FROM `product` WHERE id = '$delete_id'") or die('query failed');
    $fetch = mysqli_fetch_assoc($delete_img);
    unlink('../img/'. $fetch['img']);
    mysqli_query($conn, "DELETE FROM `product` WHERE id = '$delete_id'") or die('query failed');
    header("location: admin_item.php");
};

//UPDATE
if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_author = $_POST['update_author'];
    $update_price = $_POST['update_price'];

    mysqli_query($conn, "UPDATE `product` SET name = '$update_name' , author = '$update_author' , price = '$update_price' WHERE id='$update_p_id'") or die('query failed');

    $update_old_img = $_POST['update_old_img'];
    $update_img = $_FILES['update_img']['name'];
    $update_img_tmp = $_FILES['update_img']['tmp_name'];
    $update_img_type = $_FILES['update_img']['type'];

    try{
        if($update_img_type == 'image/jpeg' || $update_img_type == 'image/png'){
            mysqli_query($conn, "UPDATE `product` SET img = '$update_img' WHERE id = '$update_p_id'") or die('query failed');

            move_uploaded_file($update_img_tmp, "../img/$update_img");
            unlink('../img'. $update_old_img);
        };
    }catch(\Exception $e){
        echo $e;
    };
    
    header('location: admin_item.php');
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
        <div class="add mx-5">
            <h1 class="my-4 text-center">Add product</h1>

            <form action="" method="post" enctype="multipart/form-data" class="form w-50 bg-light p-4 shadow-lg mx-auto">
                <input type="text" name="name"  placeholder="Book Name" class="form-control mb-3 " require>
                <input type="text" name="author"  placeholder="Author Name" class="form-control mb-3" require>
                <input type="text" name="price"  placeholder="Price" class="form-control mb-3" require>
                <input type="file" name="img" class="form-control mb-3"  require>
                <input type="submit" value="Add product" name="add_product" class="btn btn-success">
            </form>

            
        </div>

        <!-- show  -->
        <div class="show my-5">
            <h2 class="text-center my-5">Products List</h2>
            <table class="table table-striped container">
                        <thead class="text-center align-middle">
                            <th scope="col">id</th>
                            <th scope="col">Cover</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date</th>
                            <th scope="col" colspan="2">Edit</th>
                        </thead>
            <?php 
                $select_data = mysqli_query($conn, "SELECT * FROM `product`") or die("query failed");

                if(mysqli_num_rows($select_data) > 0){
                    while($row = mysqli_fetch_assoc($select_data)){ ?>
                    
                        <tbody>
                            <tr class="text-center align-middle">
                                <td><?php echo $row['id'];?></td>
                                <td><img src="../img/<?php echo $row['img'];?>" alt="" width="100px"></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['author'];?></td>
                                <td><?php echo $row['price'];?></td>
                                <td><?php echo $row['create_at'];?></td>
                                <td>
                                    <a href="admin_item.php?update=<?php echo $row['id'];?>" class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#exampleModal" id="update">Update</a>
                                </td>
                                <td>
                                    <a href="admin_item.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    

                <?php  };
                }else{
                    echo '<p class="empty">no products added yet!</p>';
                };
            ?>
            </table>  
            
        </div>
        <!-- show end  -->

        <!-- update  -->
        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="exampleModalLabel">Edit Product</h1>
                    </div>
                    <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="update_p_id" id="update_id">
                                <input type="hidden" name="update_old_img" id="update_old_img">
                                
                                <div class="form-group">
                                    <input type="text" name="update_name" id="update_name" placeholder="Book Name" class="form-control mb-3 " require>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="update_author" id="update_author" placeholder="Author Name" class="form-control mb-3" require>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="update_price" id="update_price" placeholder="Price" class="form-control mb-3" require>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="update_img" id="update_img" class="form-control mb-3"  require>
                                </div>
                                
                                <div class="modal-footer">
                                    <input type="submit" value="update" name="update_product" class="btn btn-success " id="update_btn">
                                    <input type="reset" value="cancle" data-bs-dismiss="modal" class="btn btn-dark">
                                </div>
                            </form>
                    </div>
                </div>
                
            
            </div>
        </div>
    </div>
    

    

<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        $('.editBtn').on('click', function(){

            $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#update_name').val(data[2]);
                $('#update_author').val(data[3]);
                $('#update_price').val(data[4]);
               
        });
    });
</script>
</body>
</html>