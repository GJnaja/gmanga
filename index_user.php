<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        
        <style>
            .title_image{
                height: 320px;
                
            }
            .title-synopsis{
                width: 100px;
                margin-left: 100px;
            }
            .text-ar{
                width: 300px;
                height: 200px;
            }
            .btn-index{
                align-items: center !important;
            }
        </style>
    </head>
    <body>
        <?php 
            //echo "Hello FWlord";
        ?>
        <button class="btn-index"><a href="insertUser.php">Register</a></button>
        <button class="btn-index"><a href="index.php">Index Manga</a></button>
        <table width="1000px" id="maintable" class="table table-bordered table-striped">
            <thead>
                <th>User คนที่</th>
                <th>ชื่อ User</th>
                <th>Email </th>
                <th>Detail</th>
                <th>User Created When</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                <?php
                    include_once('functions.php');
                    $fetchdata = new DB_con();
                    $sql = $fetchdata->fetchuser();
                    while($row = mysqli_fetch_array($sql)){
                ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['user_email']; ?></td>
                        <td><?php echo $row['user_detail']; ?></td>
                        <td><?php echo $row['user_created_when']; ?></td>
                        <td><a href="updateUser.php?id=<?php echo $row['user_id']; ?>">Edit</a></td>
                        <td><a href="deleteUser.php?delu=<?php echo $row['user_id']?>">Delete</a></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <button class="btn-index"><a href="insertUser.php">Register</a></button>
        <button class="btn-index"><a href="index.php">Index Manga</a></button>
    </body>

</html>