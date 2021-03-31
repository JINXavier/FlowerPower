<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <nav>
            <div class="logo">
                <a href="./index.php"><img src="./images/Logo.png" width="60%" height="60%"></a>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="./OverOns.php">Over ons</a>
                </li>
                <li>
                    <a href="./winkel.php">Winkel</a>
                </li>
                <li>
                    <a href="#">Winkelwagen</a>
                </li>
                <?php
                    if (isset($_SESSION["idklant"])) {
                        echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                    } else if (isset($_SESSION["idmedewerker"])) {
                        echo "<li><a href='adminpanel.php'>Admin Panel</a></li>";
                        echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                    } else {
                        echo "<li><a href='SignUp.php'>Registreer</a></li>";
                        echo "<li><a href='Login.php'>Log in</a></li>";
                    }
                ?>
            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>
        <script src="./lib/animations.js"></script>
    </body>