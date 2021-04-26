<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurGames</title>

    <link rel="icon" type="image/png" href="img/fav.svg"/>

    <link rel="stylesheet" href="css/web.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php require_once "header.php"; ?>

    <main>
        <!-- //TODO:   -->
        <section class="recommended_section">
            <h1>polecane przez partię</h1>
            <?php
                require_once "connection.php";
                $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                if($conn){
                    $recommendedRESULT = $conn->query("SELECT * FROM product, prod_img WHERE recommended = 1 AND `primary` = 1 AND id_prod = product.id limit 5");
                    
                    while($row = mysqli_fetch_assoc($recommendedRESULT)){
                        echo '
                        <div class="product_box product_box--recommended">
                            <img src="products_img/'.$row["img_name"].'" alt="" class="product_box__img">
                            <div class="product_box__content">
                                <div class="product_box__content__title">'.$row["title"].'</div>
                                <div class="product_box__content__price">'.$row["price"].'</div>
                                <button class="product_box__content__btn">
                                    <!-- iconka --!>
                                    <span class="material-icons-round">shopping_basket</span>
                                </button>
                            </div>
                        </div>
                        ';
                    }
                }                

            ?>


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
            <?php
                require_once "connection.php";
                $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                if($conn){
                    $recommendedRESULT = $conn->query("SELECT product.id, product.title, product.price, prod_img.img_name  FROM product, prod_img WHERE `primary` = 1 AND id_prod = product.id ORDER BY bought_copies_count DESC limit 8");
                    
                    while($row = mysqli_fetch_assoc($recommendedRESULT)){
                        echo '
                        <div class="product_box product_box--recommended">
                            <img src="products_img/'.$row["img_name"].'" alt="" class="product_box__img">
                            <div class="product_box__content">
                                <div class="product_box__content__title">'.$row["title"].'</div>
                                <div class="product_box__content__price">'.$row["price"].'</div>
                                <button class="product_box__content__btn" data-prod_id="'.$row["id"].'">
                                    <!-- iconka --!>
                                    <span class="material-icons-round">shopping_basket</span>
                                </button>
                            </div>
                        </div>
                        ';
                    }
                }                

            ?>
            
        </section>
        <section class="latests_section">
            <!-- TO SAMO CO WYŻEJ - małe slider wczytywany boxy -->
           
        </section>
        <section class="others_section">
            <!-- grid z grami -->
        </section>

    </main>

<!-- 
    polecane przez partię

    best-sellers

    najnowsze

    reszta

 -->
    
    <?php require_once "footer.php"; ?>
</body>
</html>