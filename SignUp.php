<?php
include("layout/navbar.php")
?>
<div class="bg1"></div>
<div class="signup-form">
    <section class="sign-up">
    <h2>Registreer</h2>
    <form action="includes/signup.inc.php" method="post">
    <input type="text" name="voornaam" placeholder="Voornaam..."required>
    <input type="text" name="tussenvoegsel" placeholder="tussenvoegsel...">
    <input type="text" name="achternaam" placeholder="achternaam..."required>
    <input type="text" name="adres" placeholder="adres..."required>
    <input type="text" name="huisnummer" placeholder="huisnummer..."required>
    <input type="text" name="postcode" pattern="[0-9]{4}[a-zA-Z]{2}" placeholder="postcode..." required>
    <input type="text" name="plaats" placeholder="plaats..."required>
    <input type="email" name="email" placeholder="E-mailadres..."required>
    <input type="tel" name="telefoon" pattern="[0-9]{10}" placeholder="telefoonnr..."required>
    <input type="password" name="wachtwoord" placeholder="Wachtwoord..."required>
    <input type="password" name="wachtwoord2" placeholder="Herhaal wachtwoord..."required>
    <button type="submit" name="submit">Registreer</button>
    </form>
    </section>
    </br>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
        echo"<p>Vul alle velden in.</p>";
    } 
    else if ($_GET["error"] == "invalidemail") {
    echo"<p>De e-mail adres klopt niet.</p>";
    }
    else if ($_GET["error"] == "passwordnomatch") {
    echo"<p>Wachtwoord komt niet overeen.</p>";  
    }
    else if ($_GET["error"] == "emptyinput") {
    echo"<p>Oops er ging iets fout probeer het opnieuw.</p>";  
    }
    else if ($_GET["error"] == "emailused") {
    echo"<p>De e-mail adres die u heeft ingevoerd is al in gebruik.</p>";
    }
    else if ($_GET["error"] == "none") {
    echo"<p>Uw account is aangemaakt u kunt nu inloggen.</p>";
    }
}
    ?>
    </div>
    </body>
</html>