<?php 
include '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header("location: ../index.php");
};

//  DELETE 
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `user` WHERE id = '$delete_id'") or die('query failed');
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
    <?php include './admin_header.php'?>

    <div class="col-9 py-3 px-4 float-start">
        <h2 class="text-center my-5">Coustmer users</h2>
            <table class="table table-striped container">
                        <thead class="text-center align-middle">
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date</th>
                            <th scope="col">Edit</th>
                        </thead>
            <?php 
                $select_data = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type = 'user'") or die("query failed");

                if(mysqli_num_rows($select_data) > 0){
                    while($row = mysqli_fetch_assoc($select_data)){ ?>
                    
                        <tbody>
                            <tr class="text-center align-middle">
                                <td><?php echo $row['id'];?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['create_at'];?></td>
                                <td>
                                    <a href="admin_normaluser.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    

                <?php  };
                };
            ?>
            </table>
    </div>
</body>
</html>