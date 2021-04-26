<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurGames</title>

    <link rel="icon" type="image/png" href="../img/fav.svg"/>

    <link rel="stylesheet" href="../css/web.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php require_once "../header.php"; ?>

<section class="shopping_cart">
    <div class="shopping_cart__header">
        <span>produkt</span>
        <span>cena</span>
        <span>ilość</span>
        <span>razem</span>
    </div>
    <div class="shopping_cart__products_list">
        <?php
            require_once "../connection.php";
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            if($conn){
                if(isset($_SESSION["user_id"])){
                    // pobiera dane z bazy
    
                    $user_id = $_SESSION["user_id"];

                    $shopping_cartRESULT = $conn->query("SELECT * FROM product, shopping_cart WHERE id_user = ".$user_id." AND product.id = shopping_cart.id_product");
                    
                    var_dump( mysqli_fetch_assoc($shopping_cartRESULT));

                    if($shopping_cartRESULT->num_rows > 0){
                        while($rekord = mysqli_fetch_assoc($shopping_cartRESULT)){
                            echo '
                            <div class="product_box">
                                <div class="product_box__name">'.$rekord["name"].'</div>
                                <div class="product_box__price">'.$rekord["price"].'</div>
                                <div class="product_box__amount">'.$rekord["amount"].'</div>
                                <div class="product_box__sum">'.($rekord["price"]*$rekord["amount"]).'</div>
                            </div>
                            ';
                        }
                    }
                    else{
                        echo "Nie masz produktów w koszyku.";
                    }
    
                }
                else{
                    // wczytuje z plików cookie id produktów a potem z bazy dane
                }
            }
        ?>
        
    </div>
    <div class="shopping_cart__bottom">
        <div class="shopping_cart__bottom__manage">
            <button>wyczyść koszyk</button>
            <button>kontynuuj zakupy</button>
        </div>
        <div class="shopping_cart__bottom__desc">całkowita kwota</div>
        <div class="shopping_cart__bottom__sum"></div>
    </div>
</section>

<?php require_once "../footer.php"; ?>
</body>
</html>