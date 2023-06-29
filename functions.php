<?php
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'gmanga_db');
    // $dbHost = "localhost";
    // $dbUsername = "root";
    // $dbPassword = "";
    // $dbName = "gmanga_db";

    class DB_con {
        function __construct(){                                             // __construct จะทำงานเมื่อ ฟังก์ชันใน class โดนเรียกใช้
            $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $this->dbcon = $conn;
            if(mysqli_connect_errno()){
                echo "Failed to connect to MySQL : ".mysqli_connect_error();
            }
            // try {
            //     $dbcon = new PDO("mysql:host={DB_SERVER}; dbname={DB_NAME}", DB_USER, DB_PASS);
            //     $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // }catch(PDOException $e){
            //     $e->getMessage();
            // }

        }

        public function insert($manga_name_th, $manga_name_en, $picture, $synopsis,	$released, 
                                $postby, $genres, $keywords, $rating, 
                                $num_sector, $num_episode, $author, $artist, $post_images) {
            //$pic_data = "0x".bin2hex($picture);                        
            $result = mysqli_query($this->dbcon, "INSERT INTO gmanga_tb(manga_name_th, manga_name_en, picture, synopsis, released, 
                                postby, genres, keywords, rating, 
                                num_sector, num_episode, author, artist, post_images)
            VALUES('$manga_name_th', '$manga_name_en', '$picture', '$synopsis', '$released', 
                                '$postby', '$genres', '$keywords', '$rating', 
                                '$num_sector', '$num_episode', '$author', '$artist', '$post_images')");
            return $result;
        }

        public function insertUser($user_name, $user_password, $user_email, $user_detail) {                    
            $result = mysqli_query($this->dbcon, "INSERT INTO user_tb(user_name, user_password, user_email, user_detail)
            VALUES('$user_name', '$user_password', '$user_email', '$user_detail')");
            return $result;
        }

        public function fetchdata(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM gmanga_tb");
            return $result;
        }

        public function fetchuser(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM user_tb");
            return $result;
        }

        public function fetchdataRecord($manga_id){
            //$result = mysqli_query($this->dbcon, "SELECT gmanga_tb WHERE manga_id = '$manga_id'");
            $result = mysqli_query($this->dbcon, "SELECT * FROM gmanga_tb WHERE manga_id = '$manga_id'");
            return $result;
        }

        public function fetchdataRecordUser($user_id){
            $result = mysqli_query($this->dbcon, "SELECT * FROM user_tb WHERE user_id = '$user_id'");
            return $result;
        }

        // public function insert2($manga_name_th, $manga_name_en, $picture, $synopsis){
        //     $pic_data = "0x".bin2hex($picture);
        //     $result = mysqli_query($this->dbcon, "INSERT INTO gmanga_tb(manga_name_th, manga_name_en, picture, synopsis)
        //     VALUES('$manga_name_th', '$manga_name_en', '$picture', '$synopsis')");
        //     //var_dump($result);
        //     return $result;
        // }

        public function updateManga($manga_name_th, $manga_name_en, $synopsis, $released, 
                                    $postby, $genres, $keywords, $rating, 
                                    $num_sector, $num_episode, $author, $artist, $manga_id) {
            $result = mysqli_query($this->dbcon, "UPDATE gmanga_tb SET
                                manga_name_th = '$manga_name_th', manga_name_en = '$manga_name_en',
                                synopsis = '$synopsis', released = '$released', postby = '$postby', genres = '$genres', 
                                keywords = '$keywords', rating = '$rating', num_sector = '$num_sector', num_episode = '$num_episode', 
                                author = '$author', artist = '$artist' WHERE manga_id = '$manga_id'
            ");
            return $result;
        }

        public function updateMangaWP($manga_name_th, $manga_name_en, $picture, $synopsis, $released, 
                                    $postby, $genres, $keywords, $rating, $FILES,
                                    $num_sector, $num_episode, $author, $artist, $manga_id) {
                                        
            $pic_data = "0x".bin2hex($picture);    
            $query = "UPDATE gmanga_tb SET
            manga_name_th = '$manga_name_th', manga_name_en = '$manga_name_en', picture = '$picture',
            synopsis = '$synopsis', released = '$released', postby = '$postby', genres = '$genres',
            keywords = '$keywords', rating = '$rating', num_sector = '$num_sector', num_episode = '$num_episode',
            author = '$author', artist = '$artist' WHERE manga_id = '$manga_id'
            ";
            $result = mysqli_query($this->dbcon, "UPDATE gmanga_tb SET
                                manga_name_th = '$manga_name_th', manga_name_en = '$manga_name_en', picture = '$picture', 
                                synopsis = '$synopsis', released = '$released', postby = '$postby', genres = '$genres', 
                                keywords = '$keywords', rating = '$rating', num_sector = '$num_sector', num_episode = '$num_episode', 
                                author = '$author', artist = '$artist' WHERE manga_id = '$manga_id'
            ");
            return $result;
        }

        public function updateUser($user_name, $user_password, $user_email, $user_detail, $user_id){
            $result = mysqli_query($this->dbcon, "UPDATE user_tb SET user_name = '$user_name', user_password = '$user_password', user_email = '$user_email', 
            user_detail = '$user_detail' WHERE user_id = '$user_id'");
            return $result;
        }

        public function delete($manga_id){
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM gmanga_tb WHERE manga_id = '$manga_id'");
            //echo $manga_id;
            return $deleterecord;
        }

        public function deleteUser($user_id){
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM user_tb WHERE user_id = '$user_id'");
            return $deleterecord;
        }
        
    }

    function is_english($input) {
        // Regular expression to match English characters
        $pattern = '/^[a-zA-Z ]+$/';
    
        // Check if the input string contains English characters
        if ((preg_match($pattern, $input)) ) {
            return true; // English characters found
        } else {
            return false;
        }
    }

    function is_not_english($input) {
        // Regular expression to match non-English characters
        $pattern = '/^[ก-๏\s]+$/u';
        //$pattern = !('/^[a-zA-Z ]+$/');
        //echo $input.$pattern;
        //var_dump($pattern);
        // Check if the input string contains non-English characters
        if ((preg_match($pattern, $input)) ) {
            return true; // Thai characters found
        } else {
            return false;
        }
    }
    
    function is_number($input){
        if (is_numeric($input)) {
            return true;
        } else {
            return false;
        }
    }
?>