<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurGames</title>

    <link rel="icon" type="image/png" href="img/fav.svg"/>

    <link rel="stylesheet" href="css/web.css">
    <link rel="stylesheet" href="css/index2.css">
</head>
<body>
    <?php require_once "header.php"; 

    function ProductBox($connection, $query, $isRecommended = ''){
        if($connection){
            if($isRecommended == true){
                $isRecommended = " product_box--recommended";
            }
    
            $prod_boxRESULT = $connection->query($query);
                        
            while($row = mysqli_fetch_assoc($prod_boxRESULT)){
                echo '
                <div class="product_box'.$isRecommended.'">
                    <img src="products_img/'.$row["img_name"].'" alt="" class="product_box__img">
                    <!--<img src="products_img/csgo1.jpg" alt="" class="product_box__img">--!>
                    <div class="product_box__content">
                        <a class="product_box__content__title" href="product/index.php?prod_id='.$row["id"].'">'.$row["title"].'</a>
                        <div class="product_box__content__price">'.$row["price"].'zł</div>
                        <button class="product_box__content__btn" data-id="'.$row["id"].'">
                            <!-- iconka --!>
                            <span class="material-icons-round">shopping_basket</span>
                        </button>
                    </div>
                </div>
                ';
            }
        }
    }
    
    ?>

    <main>
        <!-- //TODO:   -->
        <section class="recommended_section">
            <h1>polecane przez partię</h1>
            <section class="recommended_section__products">
            <?php
                require_once "connection.php";
                $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

                ProductBox($conn, "SELECT product.id, product.title, product.price, prod_img.img_name FROM product, prod_img WHERE recommended = 1 AND `primary` = 1 AND id_prod = product.id limit 5", true);           

            ?>
            </section>


            <!-- <div class="product_box product_box--recommended">
                <img src="" alt="" class="product_box__img">
                <div class="product_box__content">
                    <div class="product_box__content__title"></div>
                    <div class="product_box__content__cost"></div>
                    <button class="product_box__content__btn">
                    </button>
                </div>
            </div> -->

            <!-- duże boxy -->
        </section>
        <section class="bestsellers_section">
            <h1>bestsellery</h1>
            <!-- małe slider wczytywany boxy -->
            <section class="bestsellers_section__products">
            <?php
            ProductBox($conn, "SELECT product.id, product.title, product.price, prod_img.img_name  FROM product, prod_img WHERE `primary` = 1 AND id_prod = product.id ORDER BY bought_copies_count DESC limit 8");

            ?>
            </section>
            
        </section>
        <section class="latests_section">
            <h1>najnowsze produkty</h1>
            <!-- TO SAMO CO WYŻEJ - małe slider wczytywany boxy -->
            <section class="latests_section__products">
            <?php
            ProductBox($conn, "SELECT product.id, product.title, product.price, prod_img.img_name  FROM product, prod_img WHERE `primary` = 1 AND id_prod = product.id ORDER BY release_date DESC limit 8");    

            ?>
            </section>
        </section>
        <section class="others_section">
            <h1>inne produkty</h1>
            <section class="others_section__products">
            <!-- grid z grami -->
            <?php
            ProductBox($conn, "SELECT product.id, product.title, product.price, prod_img.img_name  FROM product, prod_img WHERE `primary` = 1 AND id_prod = product.id limit 50");
            ?> 
            </section>
        </section>

    </main>

<!-- 
    polecane przez partię

    best-sellers

    najnowsze

    reszta

 -->
    
    <?php require_once "footer.php"; ?>

    <script src="js/index.js"></script>
</body>
</html>