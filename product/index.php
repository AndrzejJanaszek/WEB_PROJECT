<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once "../connection.php";
        $conn = mysqli_connect($db);

        echo '
        <section class="product_session">
            <div class="product_session__top">
                <div class="product_session__top__slider">
                    <div class="slider"></div>
                    <div class="primary_img"></div>
                </div>
                <div class="product_session__top__description">
                    <h2 class="product_title">titel</h2>
                    <p class="product_id">id</p>
                    <p class="categories">
                        <div class="category_box"></div>
                    </p>

                    <button>Zobacz wiécej</button>
                </div>
                <div class="product_session__top__data">
                    <div class="product_session__top__data__accessibility"></div>
                    <div class="product_session__top__data__price"></div>
                    <div class="product_session__top__data__platforms">
                        <div class="platform_box"></div>
                    </div>
                    <button>Dodaj do koszyka</button>
                </div>
            </div>
            <div class="product_session__bottom">
                <div class="product_session__bottom__descritpion">
                    <h2>OPIS GRY</h2>
                    <p></p>
                </div>
                <div class="product_session__bottom__requirements">
                    <h2>WYMAGANIA SPRZĘTOWE</h2>
                    <p>MOCARNY KOMPUTER</p>
                </div>
            </div>
        </section>
        ';
    ?>
</body>
</html>