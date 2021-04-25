<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/admin_index.css">
</head>
<body>
    <div class="admin_header">
        <h1>PANEL ADMINISTRACYJNY</h1>
        <h2>tutaj możesz dodać gry do bazy danych</h2>
    </div>

    

    <form action="./add_product.php" class="admin_form" method="post">
        <!-- zdjęcia -->
        <input type="hidden" name="primary" value="0" class="primary_input">
        <div class="admin_form__imgbox">
            <h2>Podaj nazwy zdjęć [nazwa.rozszerzenie] np. csgo.png
            </h2>
            <label class="admin_form__imgbox__label" data-id="0">
                <input type="text" name="img_name[]" placeholder="nazwa zdjęcia">
                <div class="admin_form__imgbox__label__primbtn primary_btn--active">M</div>
                <!-- <div class="admin_form__imgbox__label__rmbtn">X</div> -->
            </label>

            <div class="admin_form__imgbox__addbtn button--add">Dodaj kolejne zdjęcie</div>
        </div>

        <!-- zdjećia -->
        <label>Tytuł:
            <input type="text" name="title"></label>

        <label>Cena [zł]:
            <input type="number" name="price" min="0" step="0.01"></label>

        <label>Data premiery:
            <input type="date" name="release_date"></label>

        <div class="platform_box">
            <label class="admin_form__platform_label">Platforma:
                <div class="admin_form__platform_label__select_box">
                    <select name="platform[]" class="platform_select">
                        <!-- <option value="">Dorobić z wczytywanie z php</option> -->
                        <?php
                            require_once "../connection.php";
                            $conn = mysqli_connect($db_pass, $db_user, $db_pass, $db_name);
                            if($conn){
                                $platformsSQL = "SELECT * FROM platforms;";
                                $platformsRESULT = $conn->query($platformsSQL);

                                while($rekord = mysqli_fetch_assoc($platformsRESULT)){
                                    echo '<option value="'.$rekord["id"].'">'.$rekord["name"].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <!-- <div class="admin_form__platform_label__rmbtn">X</div> -->
            </label>
            <div class="admin_form__platform_label__addbtn button--add">Dodaj kolejną platformę</div>
        </div>

        <div class="category_box">
            <label class="admin_form__category_label">Kategoria:
                <div class="admin_form__category_label__select_box">
                    <select name="category[]">
                        <!-- <option value="">Dorobić z wczytywanie z php</option> -->
                        <?php
                            // require_once "../connection.php";
                            // $conn = mysqli_connect($db_pass, $db_user, $db_pass, $db_name);
                            if($conn){
                                $categoriesSQL = "SELECT * FROM categories;";
                                $categoriesRESULT = $conn->query($categoriesSQL);

                                while($rekord = mysqli_fetch_assoc($categoriesRESULT)){
                                    echo '<option value="'.$rekord["id"].'">'.$rekord["name"].'</option>';
                                }
                            }
                        ?>
                        <!-- <div class="admin_form__category_label__rmbtn">X</div> -->
                    </select>
                </div>
            </label>
            <div class="admin_form__category_label__addbtn button--add">Dodaj kolejną kategorię</div>
        </div>
        <label>Opis:
            <textarea name="description" cols="30" rows="10"></textarea>
        </label>

        <label class="label__checkbox">
            Czy gra znajduje się w polecanych:
            <input type="checkbox" name="recommended">
        </label>

        <button type="submit" class="admin_form__sub_btn"> Potwierdź Dodanie </button>
        
    </form>
    <div class="products_list">
        <!-- tu ma wczytywać wszystkie gry -->
        <?php
            // TODO: PHP KTÓRE WYPISUJE WSZYSTKIE GRY Z 2 BUTTONAMI - EDIT/DELETE +dodać slider ze zdjęciami czy coś takiego

            /* 
            tutuł
            opis
            kategorie platformy
            data-premiery
            zakupione kopie
            recommended
            */
            if($conn){
                $productsSQL = "SELECT * FROM product";
                $productsRESULT = $conn->query($productsSQL);

                while($rekord = mysqli_fetch_assoc($productsRESULT)){
                    echo '
                    <form action="delete_edit_product.php" method="post" class="product_box">
                    <input type="hidden" name="product_id" value="'.$rekord["id"].'">
                        <div class="title">'.$rekord["title"].'</div>
                        <div class="product_box__btns">
                            <button name="edit">Edytuj</button>
                            <button name="delete">Usuń</button>
                        </div>
                    </form>
                    ';
                }
            }
            
        ?>

    </div>

    <script src="js/admin_panel.js"></script>
</body>
</html>