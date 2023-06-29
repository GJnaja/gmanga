<?php
    include_once('functions.php');

    $insertdataUser = new DB_con();
    //phpinfo();
    if(isset($_POST['insertuser'])){
        $user_name = $_POST['username'];
        $user_password = $_POST['password'];
        $user_email = $_POST['email'];
        $user_detail = $_POST['detail'];              
        //var_dump($insertdataUser);
        $sql = $insertdataUser->insertUser($user_name, $user_password, $user_email, $user_detail);
        //var_dump($sql);

        if($sql){
            echo "<script>alert('Record Inserted Successfully!');</script>";
            echo "<script>window.location.href='index_user.php'</script>";
        } else {
            echo "<script>alert('Something went wrong! Please try again!');</script>";
            echo "<script>window.location.href='insertUser.php'</script>";
        }  
    }

    //insertUser
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
            .container {
                padding: 16px;
                text-align: center;
            }
            .containerMain{
                font-size: 24px;
            }
        </style>
    </head>
    <body>
        <form class="container" action="" method="post" enctype="multipart/form-data">
            <div class="containerMain">
                <!--span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span-->
                <label for="register"><b>Register</b></label>
            </div>
            <br><br>
            <div class="containerMain" style="background-color:#f1f1f1">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>
                <br>
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                <br>    
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>
                <br>
                <label for="detail"><b>Detail</b></label>
                <input type="text" placeholder="Enter Detail" name="detail">
                <br>
                <!--button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button-->
                <button type="submit" name="insertuser" class="btn btn-success">Regist</button>
            </div>
        </form>        
            
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <button class="btn-index"><a href="index_user.php">Home</a></button>
    </body>
</html>