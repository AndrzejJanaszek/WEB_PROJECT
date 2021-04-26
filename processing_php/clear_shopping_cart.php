<?php
session_start();
if(isset($_SESSION["user_id"])){
    echo "if---";
    // wyczyść z bazy
    require_once "../connection.php";
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if($conn){
        echo "if---";
        $deletePRE = $conn->prepare("DELETE FROM shopping_cart WHERE id_user = ?");
        $deletePRE->bind_param("i", $_SESSION["user_id"] );
        $deletePRE->execute();
    }
}
else{
    // wyczyść cookie
}
?>