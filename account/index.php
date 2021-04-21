<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurGames</title>

    <link rel="icon" type="image/png" href="../img/fav.svg"/>

    <link rel="stylesheet" href="../css/web.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php require_once "../header.php"; ?>

    <main>
        <form action="./register.php" method="post">
            <h1>Zarejestruj się</h1>
            <input type="text" name="user_name" placeholder="Nazwa użytkownika">
            <input type="password" name="password" placeholder="Hasło">
            <input type="password" name="password_conf" placeholder="Potwierdz hasło">
            <input type="text" name="name" placeholder="Imię">
            <input type="text" name="surname" placeholder="Nazwisko">
            <input type="email" name="email" placeholder="Email">
            <input type="number" name="phone" placeholder="Telefon">
            <input type="date" name="birthday">
            <label for="">
            <input type="checkbox" name="reg">
            Akceptuje <a href="#">regulamin</a> sklepu.
            </label>
            <button type="submit">Zarejestruj się</button>
        </form>
        <form action="./login.php" method="post">
            <h1>Zaloguj się</h1>
            <input type="text" name="user_name" placeholder="Nazwa użytkownika">
            <input type="password" name="password" placeholder="Hasło">
            <button type="submit">Zaloguj się</button>
        </form>
    </main>
    
    <?php require_once "../footer.php"; ?>

</body>
</html>