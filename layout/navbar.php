<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/adminstyle.css">
    </head>
    <body>
<style>
textarea {
  resize: none;
}
</style>
        <nav>
            <div class="logo">
                <a href="./index.php"><img src="./images/Logo.png" width="60%" height="60%"></a>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="./overons.php">Over ons</a>
                </li>

                <?php
                    if (isset($_SESSION["idklant"])) {
                        echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                    } else if (isset($_SESSION["idmedewerker"])) {
                        echo "<li><a href='adminpanel.php'>Admin Panel</a></li>";
                        echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                    } else {
                        echo "<li><a href='login.php'>Log in</a></li>";
                    }
                ?>
                <li>
                    <a href="./winkel.php">Winkel</a>
                </li>
                <li>
                    <a href="./winkelwage.php"><i class="fa fa-shopping-cart"></i><span id="cart-item" class="badge badge-danger"><?php if(isset($_SESSION["shopping_cart"])) { echo count($_SESSION["shopping_cart"]); } else { echo '0';}?></span></a>
                </li>
            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>
        <script src="./lib/animations.js"></script>
