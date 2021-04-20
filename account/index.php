<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurGames</title>
    <?php
    // $mainDir = $_SERVER['DOCUMENT_ROOT']."/WEB_PROJECT"."/";
    $mainDir = "http://127.0.0.1"."/WEB_PROJEKT"."/";
    ?>
    <link rel="icon" type="image/png" href="<?php echo $mainDir; ?>img/fav.svg"/>

    <link rel="stylesheet" href="<?php echo $mainDir; ?>css/web.css">
</head>
<body>
    <?php require_once $mainDir."header.php"; ?>

    
    
    <?php require_once $mainDir."footer.php"; ?>

</body>
</html>