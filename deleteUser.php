<?php 
    include_once('functions.php');

    if(isset($_GET['delu'])){
        $user_id = $_GET['delu'];

        $deletedata = new DB_con();
        $sql = $deletedata->deleteUser($user_id);
        if($sql){
            echo "<script>alert('Record Deleted Successfully!');</script>";
            echo "<script>window.location.href='index_user.php'</script>";
        } 
    }

    
?>