<?php
    if(isset($_POST["title"]) && isset($_POST["description"]) &&isset($_POST["price"]) && isset($_POST["release_date"]) &&isset($_POST["platform"]) && isset($_POST["category"]) && isset($_POST["primary"]) && isset($_POST["product_id"])){
        if($_POST["title"] != "" && $_POST["description"] != "" && $_POST["price"] != "" && $_POST["release_date"] != "" && $_POST["platform"] != "" && $_POST["category"] != "" && $_POST["product_id"] != ""){
        require_once "../connection.php";
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        
        if($conn){
            $imgs = $_POST["img_name"];
            $title = $_POST["title"];
            $description = $_POST["description"];
            $price = $_POST["price"];
            $release_date = $_POST["release_date"];
            $platform = $_POST["platform"]; //id
            $category = $_POST["category"]; //id

            $recommended = 0;
            if(isset($_POST["recommended"]) && $_POST["recommended"] == "on")$recommended=1;


            $product_id = $_POST["product_id"];
            // PODMIANA REKORDU DO TABELI `product`
            $prod_PRE = $conn->prepare("UPDATE `product` SET `title` = ?, `description` = ?, `price` = ?, `release_date` = ?, `recommended` = ? WHERE `product`.`id` = ".$product_id);
            
            $prod_PRE->bind_param("sssss", $title, $description, $price, $release_date, $recommended);
            $prod_PRE->execute();


            //POBRANIE ID WSTAWIONEJ GRY
            

            $conn->query("DELETE from prod_cat where id_product=".$product_id.";");
            $conn->query("DELETE from prod_plat where id_product=".$product_id.";");
            $conn->query("DELETE from prod_img where id_prod=".$product_id.";");

            // WSTAWIANIE REKORDU DO TABELI `prod_cat`
            // INSERT INTO `prod_cat` (`id`, `id_product`, `id_category`) VALUES (NULL, '', '')

            foreach($category as $cat){
                $prodCat_PRE = $conn->prepare("INSERT INTO `prod_cat` (`id`, `id_product`, `id_category`) VALUES (NULL, ?, ?)");
                $prodCat_PRE->bind_param("ss",$product_id, $cat);
                $prodCat_PRE->execute();
            }

            // WSTAWIANIE REKORDU DO TABELI `prod_plat`
            // INSERT INTO `prod_cat` (`id`, `id_product`, `id_category`) VALUES (NULL, '', '')

            foreach($platform as $plat){
                $prodPlat_PRE = $conn->prepare("INSERT INTO `prod_plat` (`id`, `id_product`, `id_platform`) VALUES (NULL, ?, ?)");
                $prodPlat_PRE->bind_param("ss",$product_id, $plat);
                $prodPlat_PRE->execute();
            }

            // WSTAWIANIE REKORDU DO TABELI `prod_img`
            // INSERT INTO `prod_cat` (`id`, `id_product`, `id_category`) VALUES (NULL, '', '')

            $i = 0;
            $primary = $_POST["primary"];
            foreach($imgs as $img_name){
                $primaryBOOL = 0;
                if($i == $primary){
                    $primaryBOOL = 1;
                }
                $prodImg_PRE = $conn->prepare("INSERT INTO `prod_img` (`id`, `primary`, `id_prod`, `img_name`) VALUES (NULL, ?, ?, ?)");
                $prodImg_PRE->bind_param("sss",$primaryBOOL, $product_id, $img_name);
                $prodImg_PRE->execute();
                $i++;
            }
            
        }
        }

    }
?>