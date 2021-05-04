<?php
session_start();
require_once "../connection.php";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
// var_dump($_SESSION);
    if($conn){
        // baza
        if(isset($_SESSION["user_id"])){
            $shopping_cartRESULT = $conn->query("SELECT * FROM product, shopping_cart WHERE id_user = ".$_SESSION["user_id"]." AND product.id = shopping_cart.id_product");
            // var_dump($shopping_cartRESULT);
// TODO:CZAPYTANIE NIE DZIAŁA ZROBIĆ LICZNEI SUMY + DLA COOKIES
            // echo "SELECT * FROM product, shopping_cart WHERE id_user = ".$_SESSION["user_id"]." AND product.id = shopping_cart.id_product";

            $suma = 0;
            while($rekord = mysqli_fetch_assoc($shopping_cartRESULT)){
                $suma += $rekord["price"] * $rekord["amount"];
            }
            echo $suma."zł";
        }
        else{
            $suma = 0;
            $cookie_name = "web_project_shopping_cart";
            if(isset($_COOKIE[$cookie_name])){
                $arr = json_decode($_COOKIE[$cookie_name]);
                foreach($arr as $prod){
                    $product_id = $prod->id;
                    $product_amount = $prod->amount;
                    $prod_price = $conn->query("SELECT price FROM product WHERE id = ".$product_id);
                    $prod_price = $prod_price->fetch_assoc()["price"];
                    $suma += $prod_price * $product_amount;
                }
            }
            echo $suma."zł";
        }


        // cookies
    }
?>