<?php
session_start();
require_once "../connection.php";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if($conn){
        if(isset($_GET["product_id"]) && isset($_SESSION["user_id"])|| 1){
            $product_id = $_GET["product_id"];
            $user_id = $_SESSION["user_id"];

            // sprawdzenie czy produkt jest w koszyku
            // jeżeli tak to dodanie jego ilosć -> ++
            // jeżeli nie to INSERT INTO
            $checkPRE = $conn->prepare("SELECT * FROM shopping_cart WHERE id_user = ? AND id_product = ?");
            $checkPRE->bind_param("ii", $user_id, $product_id);
            $checkPRE->execute();
            $checkRESULT = $checkPRE->get_result();

            if($checkRESULT->num_rows > 0){
                echo "numrowes";
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
    }
?>