<?php
    if(isset($_POST["title"]) && isset($_POST["description"]) &&isset($_POST["price"]) &&isset($_POST["release_date"]) &&isset($_POST["platform"]) && isset($_POST["category"])){
        
        require_once "../connection.php";
        $conn = mysqli_connect($db_pass, $db_user, $db_pass, $db_name);
        
        if($conn){
            $title = $_POST["title"];
            $description = $_POST["description"];
            $price = $_POST["price"];
            $release_date = $_POST["release_date"];
            $platform = $_POST["platform"]; //id
            $category = $_POST["category"]; //id

            $recommended = 0;
            if(isset($_POST["recommended"]) && $_POST["recommended"] == "on")$recommended=1;


            // WSTAWIANIE REKORDU DO TABELI `product`
            $prod_PRE = $conn->prepare("INSERT INTO `product` (`id`, `title`, `description`, `price`, `release_date`, `bought_copies_count`, `recommended`) VALUES (NULL, '?', '?', '?', '?', '0', '?')");
            $prod_PRE->bind_param($title, $description, $price, $release_date, $recommended);
            $prod_PRE->execute();

            //POBRANIE ID WSTAWIONEJ GRY
            $product_id = $prod_PRE->insert_id;


            // WSTAWIANIE REKORDU DO TABELI `prod_cat`
            // INSERT INTO `prod_cat` (`id`, `id_product`, `id_category`) VALUES (NULL, '', '')

            $prodCat_PRE = $conn->prepare("INSERT INTO `prod_cat` (`id`, `id_product`, `id_category`) VALUES (NULL, '?', '?')");
            $prodCat_PRE->bind_param($$product_id, $category);
            $prodCat_PRE->execute();

            // WSTAWIANIE REKORDU DO TABELI `prod_plat`
            // INSERT INTO `prod_cat` (`id`, `id_product`, `id_category`) VALUES (NULL, '', '')
            $prodPlat_PRE = $conn->prepare("INSERT INTO `INSERT INTO `prod_plat` (`id`, `id_product`, `id_platform`) VALUES (NULL, '?', '?')");
            $prodPlat_PRE->bind_param($product_id, $platform);
            $prodPlat_PRE->execute();
            
        }

    }

    "INSERT INTO `product` (`id`, `title`, `description`, `price`, `release_date`, `bought_copies_count`, `recommended`) VALUES (NULL, '', '', '', '', '', '')"
?>


<!-- 
title
description
price
release_date

recommended

platform
category

 -->