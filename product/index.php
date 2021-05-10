<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
    require_once "../connection.php";
    $conn = mysqli_connect($db_host, $db_user,$db_pass,$db_name,);
        if($conn){
            $imgNameRES = $conn->query("SELECT title FROM product WHERE id = ".$_GET["prod_id"]);
            $nameASSOC = $imgNameRES->fetch_assoc();
            echo $nameASSOC["title"];
        }
    ?>
    
     | OurGames</title>

    <link rel="icon" type="image/png" href="../img/fav.svg"/>

    <link rel="stylesheet" href="css/product2.css">
    <link rel="stylesheet" href="../css/web.css">
</head>
<body>
<?php  require_once "../header.php"; ?>

<main>

    <?php
        

        

        if($conn){
            $product_id = $_GET["prod_id"];
            $conn->prepare("SELECT * FROM product, prod_cat, prod_plat, prod_img, categories, platforms WHERE product.id = prod_cat.id_product AND product.id = prod_plat.id_product AND product.id = prod_img.id_prod AND categories.id = prod_cat.id_category AND platforms.id = prod_plat.id_platform AND product.id = ? ");

            echo '
            <section class="product_session">
                <div class="product_session__top">
                    <div class="product_session__top__slider">';
                        $imgRESULT = $conn->query("SELECT * FROM prod_img WHERE id_prod = ".$product_id); 
                        $productRESULT = $conn->query("SELECT * FROM product WHERE id = ".$product_id); 
                        $prodASSOC = mysqli_fetch_assoc($productRESULT);
                        $catRESULT = $conn->query("SELECT categories.id, categories.name FROM categories, prod_cat WHERE prod_cat.id_product = ".$product_id." AND categories.id = prod_cat.id_category"); 
                        $platRESULT = $conn->query("SELECT platforms.id, platforms.name FROM platforms, prod_plat WHERE prod_plat.id_product = ".$product_id." AND platforms.id = prod_plat.id_platform"); 


                        $primary_img_name;
                        echo '
                                <div class="slider">';
                        while($img = mysqli_fetch_assoc($imgRESULT)){
                            if($img["primary"] == 1){
                                $primary_img_name = $img["img_name"];
                            }
                            else{
                                
                                echo '<div class="img_box"><img src="../products_img/'.$img["img_name"].'" alt="" class="slider__img"></div>';
                            }
                        }

                        echo '</div>
                        <div class="primary_img">
                            <img src="../products_img/'.$primary_img_name.'" alt="">
                        </div>
                        ';

                        
                        
                        echo '</div>
                    <div class="product_session__top__description">
                        <h2 class="product_title">'.$prodASSOC["title"].'</h2>
                        <p class="product_id">ID produktu: '.$prodASSOC["id"].'</p>
                        <h3>Gatunki:</h3>
                        <p class="categories">';

                            while($cat = mysqli_fetch_assoc($catRESULT)){
                                echo '
                                <div class="category_box">'.$cat["name"].'</div>
                                ';
                            }

                        echo '</p>
                    </div>
                    <div class="product_session__top__data">
                        <div class="product_session__top__data__accessibility">PRODUKT DOSTĘPNY</div>
                        <div class="product_session__top__data__price">Cena: '.$prodASSOC["price"].'zł</div>
                        <div class="product_session__top__data__platforms">';
                        while($plat = mysqli_fetch_assoc($platRESULT)){
                            echo'
                            <div class="platform_box">'.$plat["name"].'</div>
                            ';
                        }
                        echo '</div>
                        <button class="add_to_shopping_cart_btn" data-id="'.$prodASSOC["id"].'">Dodaj do koszyka</button>
                    </div>
                </div>
                <div class="product_session__bottom">
                    <div class="product_session__bottom__descritpion">
                        <h2>OPIS GRY</h2>
                        <p>'.$prodASSOC["description"].'</p>
                    </div>
                    <div class="product_session__bottom__requirements">
                        <h2>WYMAGANIA SPRZĘTOWE</h2>
                        <p>MOCARNY KOMPUTER</p>
                    </div>
                </div>
            </section>
            ';
        }

        

    ?>
</main>

<?php require_once "../footer.php"; ?>
    <script src="js/slider.js"></script>
</body> 
</html>