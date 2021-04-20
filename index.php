<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurGames</title>

    <link rel="icon" type="image/png" href="img/fav.svg"/>

    <link rel="stylesheet" href="css/web.css">
</head>
<body>
    <?php require_once "header.php"; ?>

    <main>
        <!-- //TODO:   -->
        <section class="recommended_section">
            <div class="product_box product_box--recommended">
                <img src="" alt="" class="product_box__img">
                <div class="product_box__content">
                    <div class="product_box__content__title"></div>
                    <div class="product_box__content__cost"></div>
                    <button class="product_box__content__btn">
                        <!-- miejsce na ikonkę -->
                    </button>
                </div>
            </div>

            <!-- duże boxy -->
        </section>
        <section class="bestsellers_section">
            <!-- małe slider wczytywany boxy -->
            
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