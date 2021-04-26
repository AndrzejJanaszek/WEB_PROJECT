<?php
    if(isset($_POST["edit"]) && isset($_POST["product_id"])){
        require_once "../connection.php";
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if($conn){
            $id = $_POST["product_id"];
            $get_productPRE = $conn->prepare("SELECT * FROM `product` WHERE id=?;");
            $get_productPRE->bind_param("i", $id);
            $get_productPRE->execute();
            $get_productRESULT = $get_productPRE->get_result();
            $get_productASSOC = mysqli_fetch_assoc($get_productRESULT);
            
            $title = $get_productASSOC["title"];
            $price = $get_productASSOC["price"];
            $release_date = $get_productASSOC["release_date"];
            $recommended = $get_productASSOC["recommended"];
            if($recommended){
                $recommended = " checked";
            }
            else {
                $recommended = "";
            }
            $description = $get_productASSOC["description"];

            $get_platformsPRE = $conn->prepare("SELECT * FROM `prod_plat` WHERE id_product=?;");
            $get_platformsPRE->bind_param("i", $id);
            $get_platformsPRE->execute();
            $get_platformsRESULT = $get_platformsPRE->get_result();

            $get_categoriesPRE = $conn->prepare("SELECT * FROM `prod_cat` WHERE id_product=?;");
            $get_categoriesPRE->bind_param("i", $id);
            $get_categoriesPRE->execute();
            $get_categoriesRESULT = $get_categoriesPRE->get_result();

            $get_imgsPRE = $conn->prepare("SELECT * FROM `prod_img` WHERE id_prod=?;");
            $get_imgsPRE->bind_param("i", $id);
            $get_imgsPRE->execute();
            $get_imgsRESULT = $get_imgsPRE->get_result();


            $product_id = $_POST["product_id"];
            echo '
            <link rel="stylesheet" href="css/admin_index.css">
                <form action="./edit_product.php" class="admin_form" method="post">
                    <input type="hidden" name="product_id" value="'.$product_id.'">
                    <input type="hidden" name="primary" value="0" class="primary_input">
                    <div class="admin_form__imgbox">
                        <h2>Podaj nazwy zdjęć [nazwa.rozszerzenie] np. csgo.png
                        </h2>';

                        $data_imgid = 0;
                        while($select = mysqli_fetch_assoc($get_imgsRESULT)){
                            echo '
                            <label class="admin_form__imgbox__label" data-id="'.$data_imgid.'">';
                                $primaryRESULT = $conn->query("SELECT * FROM prod_img WHERE `primary` = 1 AND id_prod = ".$id.";");
                                $primary = mysqli_fetch_assoc($primaryRESULT);

                                 echo '<input type="text" name="img_name[]" placeholder="nazwa zdjęcia" value="'.$select["img_name"].'">';
                                if($primary["id"] == $select["id"]){
                                    echo '<div class="admin_form__imgbox__label__primbtn primary_btn--active">M</div>';
                                }
                                else{
                                    echo '<div class="admin_form__imgbox__label__primbtn">M</div>';
                                }
            
                             echo '</label>
                            ';
                            $data_imgid++;
                        }

                        /* <label class="admin_form__imgbox__label" data-id="0">
                            <input type="text" name="img_name[]" placeholder="nazwa zdjęcia">
                            <div class="admin_form__imgbox__label__primbtn primary_btn--active">M</div>
                            <!-- <div class="admin_form__imgbox__label__rmbtn">X</div> -->
                        </label> */
    
                        echo '<div class="admin_form__imgbox__addbtn button--add">Dodaj kolejne zdjęcie</div>
                    </div>
    
                    <!-- zdjećia -->
                    <label>Tytuł:
                        <input type="text" name="title" value="'.$title.'"></label>
    
                    <label>Cena [zł]:
                        <input type="number" name="price" min="0" step="0.01" value="'.$price.'"></label>
    
                    <label>Data premiery:
                        <input type="date" name="release_date" value="'.$release_date.'"></label>
    
                    <div class="platform_box">
                        <label class="admin_form__platform_label">Platforma:
                            ';

                                while($select = mysqli_fetch_assoc($get_platformsRESULT)){
                                    echo '
                                    <div class="admin_form__platform_label__select_box">
                                    <select name="platform[]" class="platform_select">
                                         <!-- <option value="">Dorobić z wczytywanie z php</option> -->';
                                         $platformsSQL = "SELECT * FROM platforms;";
                                         $platformsRESULT = $conn->query($platformsSQL);
    
                                         while($platform = mysqli_fetch_assoc($platformsRESULT)){
                                            if($platform["id"] == $select["id_platform"]){
                                                echo '<option value="'.$platform["id"].'" selected>'.$platform["name"].'</option>';
                                            }
                                            else{
                                                echo '<option value="'.$platform["id"].'">'.$platform["name"].'</option>';
                                            }
                                         }
                    
                                     echo '</select>
                                     </div>
                                    ';
                                }


                                // <select name="platform[]" class="platform_select">
                                //     <!-- <option value="">Dorobić z wczytywanie z php</option> -->';
                                //     $platformsSQL = "SELECT * FROM platforms;";
                                //     $platformsRESULT = $conn->query($platformsSQL);
    
                                //     while($rekord = mysqli_fetch_assoc($platformsRESULT)){
                                //         echo '<option value="'.$rekord["id"].'">'.$rekord["name"].'</option>';
                                //     }
                    
                                // </select>
                                echo ' 
                            <!-- <div class="admin_form__platform_label__rmbtn">X</div> -->
                        </label>
                        <div class="admin_form__platform_label__addbtn button--add">Dodaj kolejną platformę</div>
                    </div>
    
                    <div class="category_box">
                        <label class="admin_form__category_label">Kategoria:
                            ';
                                    while($select = mysqli_fetch_assoc($get_categoriesRESULT)){
                                        echo '
                                        <div class="admin_form__category_label__select_box">
                                            <select name="category[]">
                                                <!-- <option value="">Dorobić z wczytywanie z php</option> -->';
                                                $categoriesSQL = "SELECT * FROM categories;";
                                                $categoriesRESULT = $conn->query($categoriesSQL);
            
                                                while($category = mysqli_fetch_assoc($categoriesRESULT)){
                                                    if($category["id"] == $select["id_category"]){
                                                        echo '<option value="'.$category["id"].'" selected>'.$category["name"].'</option>';
                                                    }else{
                                                        echo '<option value="'.$category["id"].'">'.$category["name"].'</option>'; 
                                                    }
                                                }
                        
                                         echo '<!-- <div class="admin_form__category_label__rmbtn">X</div> -->
                                            </select>
                                        </div>
                                        ';
                                    }
                                        // require_once "../connection.php";
                                        // $conn = mysqli_connect($db_pass, $db_user, $db_pass, $db_name);
                                        
                                    echo '
                        </label>
                        <div class="admin_form__category_label__addbtn button--add">Dodaj kolejną kategorię</div>
                    </div>
                    <label>Opis:
                        <textarea name="description" cols="30" rows="10">'.$description.'</textarea>
                    </label>
    
                    <label class="label__checkbox">
                        Czy gra znajduje się w polecanych:
                        <input type="checkbox" name="recommended" '.$recommended.'>
                    </label>
    
                    <button type="submit" class="admin_form__sub_btn"> Potwierdź Edycje </button>
                    
                </form>
                <script src="js/admin_panel.js"></script>
                ';
        }

    }
    elseif(isset($_POST["delete"])){
        if(isset($_POST["product_id"])){
            require_once "../connection.php";
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            if($conn){
                $prod_id = $_POST["product_id"];
                $delPRE1 = $conn->prepare("DELETE FROM product WHERE id = ?;");
                $delPRE2 = $conn->prepare("DELETE FROM prod_cat WHERE id_product = ?;");
                $delPRE3 = $conn->prepare("DELETE FROM prod_plat WHERE id_product = ?;");
                $delPRE4 = $conn->prepare("DELETE FROM prod_img WHERE id_prod= ?;");
                $delPRE1->bind_param("i", $prod_id);
                $delPRE2->bind_param("i", $prod_id);
                $delPRE3->bind_param("i", $prod_id);
                $delPRE4->bind_param("i", $prod_id);
                $delPRE1->execute();
                $delPRE2->execute();
                $delPRE3->execute();
                $delPRE4->execute();
            }
        }
    }
?>