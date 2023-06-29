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
        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
            position: relative;
        }
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
    <?php 
        //echo "Hello FWlord";
        include_once('functions.php');
    ?>
    <form class="container" action="" method="post">
        <div class="imgcontainer">
            <!--span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span-->
            <img src="images/login_logo.jpg" alt="Avatar" class="avatar">
        </div>
        <br><br>
        <div class="containerMain" style="background-color:#f1f1f1">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <br><br>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <br><br>    
            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            <br><br>
            <!--button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button-->
            <button class="btn-index"><a href="insertUser.php">Register</a></button>
            <span class="psw"><a href="#">Forgot password?</a></span>
        </div>
    </form>        
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <button class="btn-index"><a href="insert.php">Add Manga</a></button>
</body>

</html>