<?php
session_start();
require_once "../connection.php";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if($conn){
        if(isset($_GET["product_id"]) && isset($_SESSION["user_id"])){
            $product_id = $_GET["product_id"];
            $user_id = $_SESSION["user_id"];


            // sprawdzenie czy produkt jest w koszyku
            // jeżeli tak to dodanie jego ilosć -> ++
            // jeżeli nie to INSERT INTO
            $checkPRE = $conn->prepare("SELECT * FROM shopping_cart WHERE id_user = ? AND id_product = ?");
            $checkPRE->bind_param("ss", $user_id, $product_id);
            $checkPRE->execute();
            $checkRESULT = $checkPRE->get_result();

            // $checkRESULT = $conn->query("SELECT * FROM shopping_cart WHERE id_user = ".$user_id." AND id_product = ".$product_id);


            if($checkRESULT->num_rows > 0){
                $get_prodPRE = $conn->prepare("SELECT * FROM shopping_cart WHERE id_user = ? AND id_product = ?");
                $get_prodPRE->bind_param("ii", $user_id, $product_id);
                $get_prodPRE->execute();
                $get_prodRESULT = $get_prodPRE->get_result();
                
                // UPDATE
                $insert_prodPRE = $conn->prepare("UPDATE shopping_cart SET amount = amount+1 WHERE id_user = ? AND id_product = ? ");
                $insert_prodPRE->bind_param("ii", $user_id, $product_id);
                $insert_prodPRE->execute();
            }
            else{
                // INSERT
                $insert_prodPRE = $conn->prepare("INSERT INTO `shopping_cart` (`id`, `id_user`, `id_product`, `amount`) VALUES (NULL, ? , ? , 1)");
                $insert_prodPRE->bind_param("ss", $user_id, $product_id);
                $insert_prodPRE->execute();

            }
        }
        else{
            $cookie_name = "web_project_shopping_cart";
            var_dump($_COOKIE[$cookie_name]);
            if(isset($_COOKIE[$cookie_name])){
                // var_dump($_COOKIE[$cookie_name]);
                $arr = json_decode($_COOKIE[$cookie_name]);  
                
                // setcookie($cookie_name, '', time() + 1, '/');

                
                $boolCos = false;
                $i = 0;
                foreach($arr as $val){
                    if($val->id == $_GET["product_id"]){
                        $boolCos = true;
                        break;
                    }
                    $i++;
                }
                // var_dump($arr[$i]->amount);
                // var_dump($arr[$i]->amount);
                if(!$boolCos){
                    array_push($arr, ["id"=>$_GET["product_id"], "amount"=>"1"]);
                }
                else{
                    $arr[$i]->amount = strval($arr[$i]->amount+1);
                }
                setcookie($cookie_name, json_encode($arr), time() + (86400 * 360), "/");
                
            }
            else{
                $arr = [];
                $arr = json_decode(json_encode($arr));
                array_push($arr, ["id"=>$_GET["product_id"], "amount"=>"1"]);
                // var_dump($arr);
                $json = json_encode($arr);
                setcookie($cookie_name, $json, time() + (86400 * 360), "/");
                // var_dump($_COOKIE[$cookie_name]);
                // echo $json;
            }



            /* 
            setcookie(name, value, expire, path, domain, secure, httponly);
            */
        }
    }
?>