<?php
    if(isset($_POST["edit"])){

    }
    elseif(isset($_POST["delete"])){
        if(isset($_POST["product_id"])){
            require_once "../connection.php";
            $conn = mysqli_connect($db_pass, $db_user, $db_pass, $db_name);
            if($conn){
                $prod_id = $_POST["product_id"];
                $delPRE1 = $conn->prepare("DELETE FROM product WHERE id = ?;");
                $delPRE2 = $conn->prepare("DELETE FROM prod_cat WHERE id_product = ?;");
                $delPRE3 = $conn->prepare("DELETE FROM prod_plat WHERE id_product = ?;");
                $delPRE4 = $conn->prepare("DELETE FROM prod_img WHERE id_prod= ?;");
                $delPRE1->bind_param("i", $prod_id);
                $delPRE2->bind_param("i", $prod_id);
                $delPRE3->bind_param("i", $prod_id);
                $delPRE4->bind_param("i", $prod_id);
                $delPRE1->execute();
                $delPRE2->execute();
                $delPRE3->execute();
                $delPRE4->execute();
            }
        }
    }



?>