<?php
    include_once('functions.php');

    $updatedata = new DB_con();

    if(isset($_POST['update']) ){        //
        $manga_id = $_GET['id'];
        $manga_name_th = $_POST['manga_name_th'];
        $manga_name_en = $_POST['manga_name_en'];
        $synopsis = $_POST['synopsis'];
        $released = $_POST['released'];             

        $postby = $_POST['postby'];
        $postedon = $_POST['postedon'];
        $genres = $_POST['genres'];
        $keywords = $_POST['keywords'];
        $rating = $_POST['rating'];                 

        $num_sector = $_POST['num_sector'];
        $num_episode = $_POST['num_episode'];
        $author = $_POST['author'];
        $artist = $_POST['artist'];
        if(isset($_FILES['picture']) && $_FILES['picture']['name'] != ""){
            $picture = $_FILES['picture'];  
            $pic_file = $_FILES['picture']['name'];
            $pic_type = $_FILES['picture']['type'];
            $pic_size = $_FILES['picture']['size'];
            $pic_tmp = $_FILES['picture']['tmp_name'];
            $pic_des = "images/".$pic_file;                     //set path images folder
            if($pic_type == "image/jpg" || $pic_type == "image/jpeg" || $pic_type == "image/png" || $pic_type == "image/gif" || $pic_type == "image/webp"){
                //echo 'a'; 
                if(!file_exists($pic_des)){
                    if($pic_size < 5000000){                                // 5Mb
                        move_uploaded_file($pic_tmp,'images/'.$pic_file);
                    }else{
                        $errorMsg = "Your file too large please upload file size less than 5MB";
                        echo $errorMsg;
                    }
                }else{
                    $errorMsg = "File already exists Check upload folder";
                    echo $errorMsg;
                }
            }else{
                $errorMsg = "Upload JPG, JPEG, PNG, GIF or WEBP file format";
                echo $errorMsg;
            }
            //echo 'a'; 
            $fp = fopen($pic_des,"r");
            $ReadBinary = fread($fp,filesize($pic_des));
            fclose($fp);
            $FileData = addslashes($ReadBinary);
            //echo $FileData;
            $sql = $updatedata->updateMangaWP($manga_name_th, $manga_name_en, $FileData, $synopsis, $released,
                                    $postby, $genres, $keywords, $rating, $picture,
                                    $num_sector, $num_episode, $author, $artist, $manga_id);
        }else{
            $sql = $updatedata->updateManga($manga_name_th, $manga_name_en, $synopsis, $released,
                                    $postby, $genres, $keywords, $rating,
                                    $num_sector, $num_episode, $author, $artist, $manga_id);
        }
        //$sql = $insertdata->insert2($manga_name_th, $manga_name_en, $FileData);

        if($sql){
            echo "<script>alert('Record Updated Successfully!');</script>";
            echo "<script>window.location.href='index.php'</script>";
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
        <h1 class="mt-5">Update Manga</h1>
        <button class="btn-index"><a href="index.php">Back to Home</a></button>
        <hr>
        <?php
            $manga_id = $_GET['id'];
            $updateManga = new DB_con();
            $sql = $updateManga->fetchdataRecord($manga_id);
            while($row = mysqli_fetch_array($sql)){                        //
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="manga_name_th" class="form-label" >ชื่อมังงะ เรื่อง : </label>
                <input type="text" class="form-control" name="manga_name_th" value="<?php echo $row['manga_name_th'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="manga_name_en" class="form-label" >Manga Name : </label>
                <input type="text" class="form-control" name="manga_name_en" value="<?php echo $row['manga_name_en'] ?>">
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label" >รูปหน้าปก : </label>
                <input type="file" class="form-control" name="picture" value=""  accept="image/gif, image/jpeg, image/jpg, image/png, image/webp">
                <p><b>Note: </b>อัพโหลดได้เฉพาะไฟล์ jpg jpeg gif หรือ png</p>
                <!--input type="hidden" name="picture" value="value="<?php $row['picture']; ?>""-->
                <?php 
                    echo "<img class='title_image' src='data:image/jpg;base64,".base64_encode($row['picture'])."' />";
                ?>
                
            </div>
            <div class="mb-3">
                <label for="synopsis" class="form-label" >เรื่องย่อ : </label>
                <!--input type="text" class="form-control" name="manga_name_en"-->
                <textarea type="text" name="synopsis" cols="30" rows="10" class="form-control" value="" required><?php echo $row['synopsis']; ?></textarea>
            </div>
            <div class="mb-3">
                <?php $currentYear = date('Y'); /*echo $currentYear;*/ 
                    $yearCurrent = $row['released'];
                ?>
                <label for="released" class="form-label" >สร้างขึ้นเมื่อปี : <strong><?php echo $yearCurrent;?></strong></label>
                <br>
                <label for="">แก้ไขปีที่สร้างตรงนี้</label>
                <select name="released" id="released" required><?php
                    //foreach (range($currentYear+543, 2530) as $value_year) {
                    //echo "<option>" . $yearCurrent . "</option>";
                    for($i = $currentYear+543 ; $i>=2530 ; $i--){
                        echo "<option>" . $i . "</option>";
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="postby" class="form-label" >โพสต์โดย : </label>
                <input type="text" class="form-control" name="postby" value="<?php echo $row['postby']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="postedon" class="form-label" >โพสต์เมื่อ : </label>
                <?php
                    //date_default_timezone_set("Asia/Bangkok");
                    $date = new DateTime();
                    $date->setTimezone(new DateTimeZone('Asia/Bangkok'));
                    $dateY = date("Y")+543;
                    $datetime = $date->format("d/m/").$dateY.$date->format(" , h:i:s A") . "\n";
                ?>
                <input type="timestamp" class="form-control" name="postedon" value="<?php echo $datetime; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="genres" class="form-label" >อนิเมะแนว : </label>
                <input type="text" class="form-control" name="genres" value="<?php echo $row['genres']; ?>">
            </div>

            <div class="mb-3">
                <label for="keywords" class="form-label">คีย์เวิร์ด : </label>
                <input type="text" class="form-control" name="keywords" value="<?php echo $row['keywords']; ?>">
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">เรทติ้ง : </label>
                <?php $rating = $row['rating']; echo $rating; ?>
                <br>
                <label for="">แก้ไขเรทติ้งตรงนี้</label>
                <select id="rating" name="rating"><?php
                    foreach (range(0, 10) as $value_rating) {
                        echo "<option >" . $value_rating . "</option>";
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="num_sector" class="form-label" >จำนวนภาค : </label>
                <input type="int" class="form-control" name="num_sector" value="<?php echo $row['num_sector']; ?>">
            </div>
            <div class="mb-3">
                <label for="num_episode" class="form-label" >จำนวนตอน : </label>
                <input type="int" class="form-control" name="num_episode" value="<?php echo $row['num_episode']; ?>">
            </div>

            <div class="mb-3">
                <label for="author" class="form-label" >ผู้แต่ง : </label>
                <input type="text" class="form-control" name="author" value="<?php echo $row['author']; ?>">
            </div>
            <div class="mb-3">
                <label for="artist" class="form-label" >ผู้เขียน : </label>
                <input type="text" class="form-control" name="artist" value="<?php echo $row['artist']; ?>">
            </div>
        <?php 
            } 
        ?>

            <button type="submit" name="update" class="btn btn-success">Update</button>
        </form>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
</body>
</html>