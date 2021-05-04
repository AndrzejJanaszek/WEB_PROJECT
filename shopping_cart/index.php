<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk | OurGames</title>

    <link rel="icon" type="image/png" href="../img/fav.svg"/>

    <link rel="stylesheet" href="../css/web.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php require_once "../header.php"; ?>

<main>
<section class="shopping_cart">
    <div class="shopping_cart__header">
        <span>Produkt</span>
        <span>Cena</span>
        <span>Ilość</span>
        <span>Razem</span>
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

                    if($shopping_cartRESULT->num_rows > 0){
                        while($rekord = mysqli_fetch_assoc($shopping_cartRESULT)){
                            echo '
                            <div class="product_box">
                                <div class="product_box__name">'.$rekord["title"].'</div>
                                <div class="product_box__price">'.$rekord["price"].'zł</div>
                                <div class="product_box__amount">'.$rekord["amount"].'</div>
                                <div class="product_box__sum">'.($rekord["price"]*$rekord["amount"]).'zł</div>
                            </div>
                            ';
                        }
                    }
                    else{
                        echo "Nie masz produktów w koszyku.";
                    }
    
                }
                else{
                    $cookie_name = "web_project_shopping_cart";
                    // var_dump($_COOKIE[$cookie_name]);
                    // wczytuje z plików cookie id produktów a potem z bazy dane

                    if(isset($_COOKIE[$cookie_name])){
                        $arr = json_decode($_COOKIE[$cookie_name]);

                        foreach($arr as $obj){
                            $cosID = $obj->id;
                            $sqlRESULT = $conn->query("SELECT * FROM product WHERE product.id = ".$cosID);
                            $ASSOC = mysqli_fetch_assoc($sqlRESULT);
                            echo '
                            <div class="product_box">
                                <div class="product_box__name">'.$ASSOC["title"].'</div>
                                <div class="product_box__price">cena: '.$ASSOC["price"].'zł</div>
                                <div class="product_box__amount"><input type="number" value="'.$obj->amount.'" step="1"></div>
                                <div class="product_box__sum">'.number_format(($ASSOC["price"]*$obj->amount),2).'zł</div>
                            </div>
                            ';
                        }
                    }
                    else{
                        echo 'Nie ma "cookisów popinkoleńców."';
                    }
                }
            }
        ?>
        
    </div>
    <div class="shopping_cart__bottom">
        <div class="shopping_cart__bottom__manage">
            <button class="clear_cart_btn">Wyczyść koszyk</button>
            <button class="continue_shoping_btn">Kontynuuj zakupy</button>
        </div>
        <div></div>
        <div class="shopping_cart__bottom__desc">Całkowita kwota</div>
        <div class="shopping_cart__bottom__sum"></div>
    </div>
    <button class="zam_btn">ZAMAWIAM</button>
</section>
<section class="shopping_details">
    <div class="shopping_details__delivery">
        <h2>Sposób dostawy:</h2>
        <label><input type="radio" name="delivery_method"> Odbiór w punkcie</label>
        <label><input type="radio" name="delivery_method"> Kurier 24h</label>
        <label><input type="radio" name="delivery_method"> Kurier 48h</label>
        <label><input type="radio" name="delivery_method"> Kurier 24h (za pobraniem)</label>
        <label><input type="radio" name="delivery_method"> Kurier 48h - Poczta Polska (za pobraniem)</label>

    </div>
    <div class="shopping_details__payment">
        <h2>Metoda płatności:</h2>
        <label><input type="radio" name="payment_method"> Przelew gotówkowy <span class="grey">(0zł)</span></label>
        <label><input type="radio" name="payment_method"> Karta płatnicza online <span class="grey">(0zł)</span></label>
        <label><input type="radio" name="payment_method"> BLIK <span class="grey">(0zł)</span></label>
        <label><input type="radio" name="payment_method"> Przy odbiorze <span class="grey">(25zł)</span></label>
        
    </div>
    <div class="shopping_details__summary">
        <h2>Łączna kwota zamówienia:</h2>

        <div class="shopping_details__summary__content">
            <div class="shopping_details__summary__content__order">Zamówienie: 95zł</div>
            <div class="shopping_details__summary__content__delivery">Dostawa: 0zł</div>
            <div class="shopping_details__summary__content__payment">Płatność: 0zł</div>
            <div class="shopping_details__summary__content__summary">Razem(ki): 95zł</div>
        </div>
    </div>
</section>
<section>
    <h2>Dane odbiorcy:</h2>
    <form action="">
        <label>
            <input type="text" name="called" placeholder="Imie i Nazwisko">
        </label>
        <label>
            <input type="number" name="tel" placeholder="Telefon">
        </label>
        <label>
            <input type="email" name="email" placeholder="Email">
        </label>
        <label>
            <input type="text" name="adres" placeholder="Ulica i numer">
        </label>
        <label>
            <input type="text" name="code" placeholder="Kod pocztowy">
        </label>
        <label>
            <input type="text" name="city" placeholder="Miejscowość">
        </label>
        <label>
            Komentarz do zamówienia
            <textarea name="commment" cols="30" rows="10"></textarea>
        </label>
        <label class="accept">
            <input type="checkbox"> <p>Akceptuje <a href="../statute/">regulamin</a> sklepu oraz zrzekam sie prawa do właności prywatnej na rzecz Partii Graczy Pracujących (PGP).</p>
        </label>
        <div class="buttons">
            <button class="order_button">Zamów</button>
            <button class="cancel_button">Anuluj</button>
        </div>
    </form>
</section>
</main>

<?php require_once "../footer.php"; ?>

<script src="js/cart.js"></script>
</body>
</html>