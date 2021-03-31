<?php
include("layout/navbar.php")
?>
<div class="bg1"></div>
<div class="signup-form">
    <section class="sign-up">
    <h2>Admin Login</h2>
    <form action="includes/adminlogin.inc.php" method="post">
    <input type="email" name="email" placeholder="E-mail...">
    <input type="password" name="wachtwoord" placeholder="Wachtwoord...">
    <button type="submit" name="submit">Login</button>
    </form>
    </section>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
        echo"<p>Vul alle velden in.</p>";
    } 
    else if ($_GET["error"] == "incorrectlogin") {
    echo"<p>De ingevoerde gegevens kloppen niet probeer het opnieuw.</p>";
    }
    else if ($_GET["error"] == "incorrectpassword") {
        echo"<p>De ingevoerde wachtwoord klopt niet probeer het opnieuw.</p>";
        }
    }
    ?>
</div>
</body>
</html>