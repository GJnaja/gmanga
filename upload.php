<?php
    include_once 'functions.php';
    $statusMsg = "";

    $targetDir = "uploads/";

    if(isset($_POST['submit'])){
        if(!empty($_FILES["file"]["name"])){
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $allowTypes = array('jpg','png','jpeg','gif','pdf','webp');
            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
                    $insert = $db->query("INSERT INTO images(file_name, uploaded_on) VALUES ('""')")
                    if($insert){
                        $statusMsg = "File <b>" . $fileName . " </b>has been uploaded successfully";
                    }else{
                        $statusMsg = "File upload failed";
                    }
                }else{
                    $statusMsg = "Error, File upload failed";
                }
            }else{
                $statusMsg = "Error, File can be upload only JPG, JPEG, PNG, GIF or WEBP";
            }
        }else{
            $statusMsg = "Please select a file to upload";
        }
    }
?>