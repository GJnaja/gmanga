<?php
    include_once('functions.php');

    $insertdata = new DB_con();
    //phpinfo();
    if(isset($_POST['insert'])&&($_FILES['picture'])){
            $manga_name_th = $_POST['manga_name_th'];
            $manga_name_en = $_POST['manga_name_en'];
            echo $manga_name_th.$manga_name_en;
            if ((is_english($manga_name_en) == true) && (is_not_english($manga_name_th) == true)){
                $picture = $_FILES['picture'];     
                    $pic_file = $_FILES['picture']['name'];
                    $pic_type = $_FILES['picture']['type'];
                    $pic_size = $_FILES['picture']['size'];
                    $pic_tmp = $_FILES['picture']['tmp_name'];
                    $pic_des = "images/".$pic_file;                     //set path images folder
                
                $synopsis = $_POST['synopsis'];
                $released = $_POST['released'];     
                $postby = $_POST['postby'];
                $postedon = $_POST['postedon'];
                $genres = $_POST['genres'];
                $keywords = $_POST['keywords'];
                $rating = $_POST['rating'];                 

                $num_sector = $_POST['num_sector'];
                $num_episode = $_POST['num_episode'];
                if((is_numeric($num_sector) == true) && (is_numeric($num_episode) == true)){
                    $author = $_POST['author'];
                    $artist = $_POST['artist'];
                    //echo $pic_type."<br>";
                    //echo $pic_des;
                    if($pic_type == "image/jpg" || $pic_type == "image/jpeg" || $pic_type == "image/png" || $pic_type == "image/gif" || $pic_type == "image/webp"){
                        //echo 'aaaaa'; 
                        if(!file_exists($pic_des)){
                            if($pic_size < 5000000){                      // 5Mb 
                                move_uploaded_file($pic_tmp,'images/'.$pic_file);
                            }else{
                                $errorMsg = "Your file too large please upload file size less than 5MB";
                            }
                        }else{
                            $errorMsg = "File already exists Check upload folder";
                        }
                    }else{
                        $errorMsg = "Upload JPG, JPEG, PNG, GIF or WEBP file format";
                    }

                    $fp = fopen($_FILES["picture"]["tmp_name"],"r");
                    $ReadBinary = fread($fp,filesize($_FILES["picture"]["tmp_name"]));
                    fclose($fp);
                    $FileData = addslashes($ReadBinary);

                    $totalFiles = count($_FILES['post_images']['name']);
                    //echo $totalFiles;

                    // $post_images = $_FILES['post_images'];  
                    // $post_name = $_FILES['post_images']['name'];
                    // $post_type = $_FILES['post_images']['type'];
                    // $post_size = $_FILES['post_images']['size'];
                    // $post_tmp = $_FILES['post_images']['tmp_name'];
                    // $post_des = "post_images/".$post_file;              //set path images folder
                    $post_images = $_FILES['post_images'];

                    for ($i = 0; $i < $totalFiles; $i++) {                      // loop for get post_images
                        $post_tmp = $_FILES['post_images']['tmp_name'][$i];
                        $post_name = $_FILES['post_images']['name'][$i];
                        $post_size = $_FILES['post_images']['size'][$i];
                        $post_type = $_FILES['post_images']['type'][$i];
                        $post_des = "post_images/"; 
                        $post_file_path = $post_des . $post_name;

                        $validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                        if (!in_array($post_type, $validImageTypes)) {
                            echo "Invalid image type. Only JPEG, PNG, and GIF files are allowed.<br>";
                            continue;
                        }

                        // Specify the destination directory to save the file
                        // $targetDirectory = "uploads/";
                        // $targetFilePath = $targetDirectory . $fileName;
                        
                        // Move the uploaded file to the destination directory
                        if (move_uploaded_file($post_tmp, 'post_images/'.$post_name)) {
                          echo "File {$post_name} has been uploaded successfully.<br>";
                        } else {
                          echo "Error uploading {$post_name}.<br>";
                        }
                        print_r($post_images);
                        $fp2 = fopen('post_images/'.$post_name,"r");
                        $ReadBinary2 = fread($fp2,filesize('post_images/'.$post_name));
                        fclose($fp2);
                        $FileData2 = addslashes($ReadBinary2);
                    }
                    
                    //echo $pic_data;
                    //var_dump($insertdata);
                    $sql = $insertdata->insert($manga_name_th, $manga_name_en, $FileData, $synopsis, $released,
                                                $postby, $genres, $keywords, $rating, 
                                                $num_sector, $num_episode, $author, $artist, $FileData2);
                    //$sql = $insertdata->insert2($manga_name_th, $manga_name_en, $FileData);

                    if($sql){
                        echo "<script>alert('Record Inserted Successfully!');</script>";
                        echo "<script>window.location.href='index.php'</script>";
                    } else {
                        echo "<script>alert('Something went wrong! Please try again!');</script>";
                        echo "<script>window.location.href='insert.php'</script>";
                    }

                } else {
                echo "<script>alert('Something wrong! Please input correctly Number');</script>";
                }
            } else {
            echo "<script>alert('Something wrong! Please input correctly English and Thai language');</script>";
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Naja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <!--link rel="stylesheet" type="text/css" href="rating_style.css"-->
    <script type="text/javascript">

    </script>
</head>
<body>

    <div class="container">
        <h1>Insert Manga</h1>
        <button class="btn-index"><a href="index.php">Back to Home</a></button>
        <hr>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="manga_name_th" class="form-label" >ชื่อมังงะ เรื่อง : </label>
                <input type="text" class="form-control" name="manga_name_th" required>
            </div>
            <div class="mb-3">
                <label for="manga_name_en" class="form-label" >Manga Name : </label>
                <input type="text" class="form-control" name="manga_name_en">
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label" >รูปหน้าปก : </label>
                <input type="file" class="form-control" name="picture" value=""  accept="image/gif, image/jpeg, image/jpg, image/png" required>
                <p><b>Note: </b>อัพโหลดได้เฉพาะไฟล์ jpg jpeg gif หรือ png</p>
            </div>
            <div class="mb-3">
                <label for="synopsis" class="form-label" >เรื่องย่อ : </label>
                <!--input type="text" class="form-control" name="manga_name_en"-->
                <textarea type="text" name="synopsis" cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <?php $currentYear = date('Y'); /*echo $currentYear;*/ ?>
                <label for="released" class="form-label" >สร้างขึ้นเมื่อปี : </label>
                <select name="released" id="released" required><?php
                    //foreach (range($currentYear+543, 2530) as $value_year) {
                    for($i = $currentYear+543 ; $i>=2530 ; $i--){
                        echo "<option value='$i'>$i</option>";
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="postby" class="form-label" >โพสต์โดย : </label>
                <input type="text" class="form-control" name="postby" required>
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
                <input type="timestamp" class="form-control" name="postedon" value="<?php echo $datetime ?>" required>
            </div>
            <div class="mb-3">
                <label for="genres" class="form-label" >อนิเมะแนว : </label>
                <input type="text" class="form-control" name="genres">
            </div>
            <div class="mb-3">
                <label for="keywords" class="form-label">คีย์เวิร์ด : </label>
                <input type="text" class="form-control" name="keywords">
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">เรทติ้ง : </label>
                <select id="rating" name="rating"><?php
                    foreach (range(0, 10) as $value_rating) {
                        echo "<option>" . $value_rating . "</option>";
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="num_sector" class="form-label" >จำนวนภาค : </label>
                <input type="int" class="form-control" name="num_sector">
            </div>
            <div class="mb-3">
                <label for="num_episode" class="form-label" >จำนวนตอน : </label>
                <input type="int" class="form-control" name="num_episode">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label" >ผู้แต่ง : </label>
                <input type="text" class="form-control" name="author">
            </div>
            <div class="mb-3">
                <label for="artist" class="form-label" >ผู้เขียน : </label>
                <input type="text" class="form-control" name="artist">
            </div>
            <div class="mb-3">
                <label for="post_images" class="form-label" >รูปหน้า</label>
                <input type="file" class="form-control" name="post_images[]" value=""  accept="image/gif, image/jpeg, image/jpg, image/png" multiple>
                <p><b>Note: </b>อัพโหลดได้เฉพาะไฟล์ jpg jpeg gif หรือ png</p>
            </div>

            <button type="submit" name="insert" class="btn btn-success">Submit</button>
        </form>
    </div>
    <div class="row">
        <?php if (!empty($statusMsg)){ ?>
            <div class="alert" role="alert">
                <?php echo $statusMsg; ?>
            </div>

        <?php } ?>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
</body>
</html>
