<?php

if (isset($_POST["submit"])) {
    
    $voornaam = $_POST["voornaam"];
    $tussenvoegsel = $_POST["tussenvoegsel"];
    $achternaam = $_POST["achternaam"];
    $adres = $_POST["adres"];
    $huisnummer = $_POST["huisnummer"];
    $postcode = $_POST["postcode"];
    $plaats = $_POST["plaats"];
    $email = $_POST["email"];
    $telefoon = $_POST["telefoon"];
    $wachtwoord = $_POST["wachtwoord"];
    $wachtwoord2 = $_POST["wachtwoord2"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($voornaam, $achternaam, $adres, $huisnummer, $postcode, $plaats, $email, $telefoon, $wachtwoord, $wachtwoord2) !== false) {
        header("location: ../SignUp.php?error=emptyinput");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../SignUp.php?error=invalidemail");
        exit();
    }
    if (wachtwoordMatch($wachtwoord, $wachtwoord2) !== false) {
        header("location: ../SignUp.php?error=passwordnomatch");
        exit();
    }
    if (emailExist($conn, $email) !== false) {
        header("location: ../SignUp.php?error=emailused");
        exit();
    }


    createUser($conn, $voornaam, $tussenvoegsel, $achternaam, $adres, $huisnummer, $postcode, $plaats, $email, $telefoon, $wachtwoord);
}
else {
    header("location: ../SignUp.php");
    exit();
}