<?php
    include_once('functions.php');

    $updatedataUser = new DB_con();

    if(isset($_POST['update_user']) ){        //
        $user_id = $_GET['id'];
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_email = $_POST['user_email'];
        $user_detail = $_POST['user_detail'];    
        $sql = $updatedataUser->updateUser($user_name, $user_password, $user_email,
                $user_detail,$user_id);

        if($sql){
            echo "<script>alert('Record Updated Successfully!');</script>";
            echo "<script>window.location.href='index_user.php'</script>";
        } else {
            echo "<script>alert('Something went wrong! Please try again!');</script>";
            echo "<script>window.location.href='update.php?id=" . $_GET['id'] . "</script>";
        }
    }
?>
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
        
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Update User</h1>
        <button class="btn-index"><a href="index.php">Back to Home</a></button>
        <hr>
        <?php
            $user_id = $_GET['id'];
            $updateUser = new DB_con();
            $sql = $updateUser->fetchdataRecordUser($user_id);
            while($row = mysqli_fetch_array($sql)){                        //
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="user_name" class="form-label" >User Name : </label>
                <input type="text" class="form-control" name="user_name" value="<?php echo $row['user_name'] ?>" >
            </div>
            <div class="mb-3">
                <label for="user_password" class="form-label" >Password : </label>
                <input type="text" class="form-control" name="user_password" value="<?php echo $row['user_password'] ?>">
            </div>
            <div class="mb-3">
                <label for="user_email" class="form-label" >Email : </label>
                <input type="text" class="form-control" name="user_email" value="<?php echo $row['user_email']; ?>">
            </div>
            <div class="mb-3">
                <label for="user_detail" class="form-label" >Detail : </label>
                <textarea type="text" class="form-control" cols="30" rows="10" name="user_detail" value=""><?php echo $row['user_detail']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="user_created_when" class="form-label" >โพสต์เมื่อ : </label>
                <?php
                    //date_default_timezone_set("Asia/Bangkok");
                    $date = new DateTime();
                    $date->setTimezone(new DateTimeZone('Asia/Bangkok'));
                    $dateY = date("Y")+543;
                    $datetime = $date->format("d/m/").$dateY.$date->format(" , h:i:s A") . "\n";
                ?>
                <input type="timestamp" class="form-control" name="user_created_when" value="<?php echo $datetime; ?>" readonly>
            </div>
            
        <?php 
            } 
        ?>

            <button type="submit" name="update_user" class="btn btn-success">Update</button>
        </form>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
</body>
</html>