
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<script src="https://kit.fontawesome.com/6a0c625264.js" crossorigin="anonymous"></script>

<?php
session_start();
$mainDir = "http://menyl.ct8.pl"."/WEB_PROJEKT"."/";
require_once "connection.php";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>

<header class="header">
    <div class="header__top">
        <div class="header__top__social">
            <a target="blank" href="https://www.facebook.com/profile.php?id=100066739583991"><i class="fab fa-facebook"></i></a>
            <a target="blank" href="https://www.instagram.com/our_games_shop/"><i class="fab fa-instagram"></i></a>
            <a target="blank" href="https://twitter.com/KontoNasze"><i class="fab fa-twitter"></i></a>
        </div>
        <div class="header__top__account">
            <div class="header__top__account__signup">
                <span class="material-icons">account_circle</span>
<?php
    if(isset($_SESSION["user_id"])){
        echo '<a href="'."${mainDir}account/signout.php".'">Wyloguj</a>';
    }
    else{
        echo '<a href="'."${mainDir}account/".'">Zaloguj / Zarejestruj</a>';
    }
?>
                <!-- <a href="<?php //echo "${mainDir}account/";?>">Zaloguj / Zarejestruj</a> -->
            </div>
            <a class="header__top__account__cart" href="<?php echo "${mainDir}shopping_cart/";?>">
                <span class="material-icons">shopping_cart</span>
                <div class="cart__value">
                    <!-- asdasd -->
                </div>
            </a>
        </div>
    </div>
    <div class="header__bottom">
        <div class="header__bottom__logo">
            <a href="<?php echo "${mainDir}";?>">OUR<span class="logo--red">GAMES</span></a>
        </div>
        <div class="header__bottom__right">
            <form action="" method="POST" class="search_box">
                <input type="text" name="key_words" placeholder="Szukaj...">
                <select name="category">
                <?php
                   if($conn){
                        $categoriesSQL = "SELECT * FROM categories;";
                        $categoriesRESULT = $conn->query($categoriesSQL);

                        echo '<option value="all">Wszystkie</option>';
                        while($rekord = mysqli_fetch_assoc($categoriesRESULT)){
                            echo '<option value="'.$rekord["id"].'">'.$rekord["name"].'</option>';
                        }
                    }
                   ?>
                </select>
                <select name="platform">
                <?php
                   if($conn){
                        $platformsSQL = "SELECT * FROM platforms;";
                        $platformsRESULT = $conn->query($platformsSQL);

                        echo '<option value="all">Wszystkie</option>';
                        while($rekord = mysqli_fetch_assoc($platformsRESULT)){
                            echo '<option value="'.$rekord["id"].'">'.$rekord["name"].'</option>';
                        }
                    }
                   ?>
                </select>
                <button type="submit"><span class="material-icons-outlined">search</span></button>
            </form>
            <div class="header__bottom__right__menu">
                <ul>
                    <?php
                    echo '
                    <li><a href="#">Kategorie</a></li>
                    <li><a href="#">Aktualności</a></li>
                    <li><a href="'.$mainDir.'/about_us/">O nas</a></li>
                    <li><a href="'.$mainDir.'/contact_us/">Kontakt</a></li>
                    ';
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <script src="<?php echo "$mainDir";?>js/header_shopping_cart_value.js"></script>
</header>