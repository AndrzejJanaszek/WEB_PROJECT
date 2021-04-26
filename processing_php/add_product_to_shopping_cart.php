<?php
session_start();
var_dump($_SESSION);
var_dump($_GET);
require_once "../connection.php";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if($conn){
        if(isset($_GET["product_id"]) && isset($_SESSION["user_id"])){
            echo"XD";
            $product_id = $_GET["product_id"];
            $user_id = $_SESSION["user_id"];

            var_dump($product_id);
            var_dump($user_id);
            var_dump($_SESSION);

            // sprawdzenie czy produkt jest w koszyku
            // jeżeli tak to dodanie jego ilosć -> ++
            // jeżeli nie to INSERT INTO
            $checkPRE = $conn->prepare("SELECT * FROM shopping_cart WHERE id_user = ? AND id_product = ?");
            var_dump($checkPRE);
            $checkPRE->bind_param("ii", $user_id, $product_id);
            $checkPRE->execute();
            $checkRESULT = $checkPRE->get_result();

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
                $insert_prodPRE = $conn->prepare("INSERT INTO `shopping_cart` (`id`, `id_user`, `id_product`, `amount`) VALUES (NULL, ?, ?, 1)");
                $insert_prodPRE->bind_param("ii", $user_id, $product_id);
                $insert_prodPRE->execute();

            }
        }
        else{
            $cookie_name = "web_project_shopping_cart";
            if(isset($_COOKIE[$cookie_name])){
                var_dump($_COOKIE[$cookie_name]);
                $arr = json_decode($_COOKIE[$cookie_name]);  
                
                // setcookie($cookie_name, '', time() + 1);

                
                $boolCos = false;
                foreach($arr as $val){
                    if($val->id == $_GET["product_id"]){
                        var_dump($arr[0]->id);
                        $val->amount = $val->amount+1;
                        $boolCos = true;
                    }
                }
                if(!$boolCos){
                    echo "------";
                    array_push($arr, ["id"=>$_GET["product_id"], "amount"=>"1"]);
                    var_dump($arr);
                    
                    setcookie($cookie_name, json_encode($arr), time() + (86400 * 360));
                }
                
            }
            else{
                $arr = [];
                $arr = json_decode(json_encode($arr));
                array_push($arr, ["id"=>$_GET["product_id"], "amount"=>"1"]);
                var_dump($arr);
                $json = json_encode($arr);
                setcookie($cookie_name, $json, time() + (86400 * 360));
                echo $json;
            }



            /* 
            setcookie(name, value, expire, path, domain, secure, httponly);
            */
        }
    }
?>