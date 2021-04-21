<?php
 session_start();
    if(isset($_POST["user_name"]) && isset($_POST["password"]) && isset($_POST["password_conf"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["birthday"]) && isset($_POST["reg"])) {
        $userName = $_POST["user_name"];
        $pass = $_POST["password"];
        $pass2 = $_POST["password_conf"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $birthday  = $_POST["birthday"];
        $reg = $_POST["reg"];

        require_once "../connection.php";
        $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if($connection){
            // validacja
            if(preg_match('/[A-Za-z0-9]{4,20}/', $userName)) {
                $uppercase = preg_match('@[A-Z]@', $pass);
                $lowercase = preg_match('@[a-z]@', $pass);
                $number    = preg_match('@[0-9]@', $pass);
    
                if(!(!$uppercase || !$lowercase || !$number || strlen($pass) < 7)) {
                    if($pass == $pass2) {
                        if(preg_match('/[A-Za-z]{1,30}/', $name)) {
                            if(preg_match('/[A-Za-z]{1,30}/', $surname)) {
                                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    if(preg_match('/[0-9]{9}/', $phone)) {
                                        if(preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $birthday)) {
                                            $DoesUserExistPre = $connection->prepare("SELECT * FROM `user` WHERE `user`.`email` = ? OR `user`.`username` = ?;");

                                            $DoesUserExistPre->bind_param("ss",$email, $userName);

                                            $DoesUserExistPre->execute();
                                            $result = $DoesUserExistPre->get_result();
                                            if($result->num_rows == 0){
                                                // zarejsetruj

                                                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                                                $add_user = $connection->prepare("INSERT INTO `user` (`id`, `name`, `surname`, `username`, `password`, `birthday`, `email`, `tel`) VALUES ('', ?, ?, ?, ?, ?, ?, ?)");

                                                $add_user->bind_param("sssssss", $name, $surname, $userName, $hashed_pass, $birthday, $email, $phone);

                                                $add_user->execute();
                                                

                                                $get_id = $connection->prepare("SELECT id FROM user WHERE user.password = ? AND user.username = ?");

                                                $get_id->bind_param("ss",$hashed_pass, $userName);

                                                $get_id->execute();
                                                $result = $get_id->get_result();
                                                // var_dump(mysqli_fetch_assoc($result));

                                                $_SESSION["user_id"] = mysqli_fetch_assoc($result)["id"];
                                                header("Location: ../index.php");
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else{
    
            }
        }
    }
    else{
        // przekeirowaniprzekierowanie
    }
?>