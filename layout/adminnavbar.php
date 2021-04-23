<?php
include("layout/navbar.php")
?>
<div class="navbar2">
    <ul class="admin-navbar">
    <li><a href="adminpanel.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=="adminpanel.php"){
        echo "active";
    }else{
        echo"";
    }?>">Admin paneel</a></li>
    <li><a href="order.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=="order.php"){
        echo "active";
    }else{
        echo"";
    }?>">Bestellingen</a></li>
    <li><a href="product.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=="product.php"){
        echo "active";
    }else{
        echo"";
    }?>">Artikelen</a></li>
    </ul>
</div>
