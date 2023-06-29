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
    <button class="btn-index"><a href="insert.php">Add Manga</a></button>
    <button class="btn-index"><a href="index_user.php">Index User</a></button>
    <table width="1000px" id="maintable" class="table table-bordered table-striped">
        <thead>
            <th>เรื่องที่</th>
            <th>ชื่อเรื่อง </th>
            <th>Name</th>
            <th>เรื่องย่อ</th>
            <th>ปีที่ปล่อย</th>
            <th>แนว</th>
            <th>keyword</th>
            <th>โพสต์โดย</th>
            <th>โพสต์เมื่อ</th>
            <th>รูปปก</th>
            <th>เรทติ้ง</th>
            <th>จำนวนภาค</th>
            <th>จำนวนตอน</th>
            <th>ผู้แต่ง</th>
            <th>ผู้วาด</th>
            <th>โพสต์รูปภาพ</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <?php
                include_once('functions.php');
                $fetchdata = new DB_con();
                $sql = $fetchdata->fetchdata();
                while($row = mysqli_fetch_array($sql)){
            ?>
                
                    <tr>
                        <td><?php echo $row['manga_id']; ?></td>
                        <td><?php echo $row['manga_name_th']; ?></td>
                        <td><?php echo $row['manga_name_en']; ?></td>
                        <td><textarea class="text-ar"><?php echo $row['synopsis']; ?></textarea></td>
                        <td><?php echo $row['released']; ?></td>
                        <td><?php echo $row['genres']; ?></td>
                        <td><?php echo $row['keywords']; ?></td>
                        <td><?php echo $row['postby']; ?></td>
                        <td><?php echo $row['postedon']; ?></td>
                        <td ><?php 
                            //$pic_data = "0x".bin2hex($row['picture']);
                            // echo $pic_data; 
                            //echo "<img src='data:image/jpg;base64,".base64_encode($pic_data)."' />";
                            echo "<img class='title_image' src='data:image/jpg;base64,".base64_encode($row['picture'])."' />";
                        ?></td>
                        <td><?php echo $row['rating']; ?></td>
                        <td><?php echo $row['num_sector']; ?></td>
                        <td><?php echo $row['num_episode']; ?></td>
                        <td><?php echo $row['author']; ?></td>
                        <td><?php echo $row['artist']; ?></td>
                        <td><?php echo "<img class='title_image' src='data:image/jpg;base64,".base64_encode($row['post_images'])."' />" ?></td>
                        <td><a href="update.php?id=<?php echo $row['manga_id']; ?>">Edit</a></td>
                        <td><a href="delete.php?del=<?php echo $row['manga_id']; ?>">Delete</a></td>
                    </tr>

            <?php
                }
            ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <button class="btn-index"><a href="insert.php">Add Manga</a></button>
    <button class="btn-index"><a href="index_user.php">Index User</a></button>
</body>

</html>