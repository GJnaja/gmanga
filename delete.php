<?php 
    include_once('functions.php');

    if(isset($_GET['del'])){
        $manga_id = $_GET['del'];

        $deletedata = new DB_con();
        $sql = $deletedata->delete($manga_id);
        if($sql){
            echo "<script>alert('Record Deleted Successfully!');</script>";
            echo "<script>window.location.href='index.php'</script>";
        } 
    }

    
?>