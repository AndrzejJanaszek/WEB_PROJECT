<?php
    session_start();
    if(isset($_SESSION["user_id"])){
        header("Location: ../index.php");
    }

    if(isset($_POST["user_name"]) && isset($_POST["password"])){
        $sql = "SELECT * FROM user WHERE user.username = ? AND user.password = ?";

        require_once "../connection.php";
        $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if($connection){
            
            $checkPre = $connection->prepare("SELECT * FROM user WHERE user.username = ?");
            $username = $_POST["user_name"];
            $checkPre->bind_param("s", $username);
            $checkPre->execute();
            $result = $checkPre->get_result();
            if($result->num_rows > 0){
                $row = mysqli_fetch_assoc($result);
                var_dump($row);
                if(password_verify($_POST["password"], $row["password"])){
                    $_SESSION["user_id"] = strval($row["id"]) ;
                    header("Location: ../index.php");
                }
            }
            else{
                // nie ma takiego usera
                header("Location: ./index.php");
            }
        }
    }
?>