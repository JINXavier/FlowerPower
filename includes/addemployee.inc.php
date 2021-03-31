 <?php

if (isset($_POST["submit"])) {
    
    $voornaam = $_POST["voornaam"];
    $tussenvoegsel = $_POST["tussenvoegsel"];
    $achternaam = $_POST["achternaam"];
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];
    $wachtwoord2 = $_POST["wachtwoord2"];

    require_once 'dbh.inc.php';
    require_once 'adminfunctions.inc.php';

    if (emptyInputSignupAdmin($voornaam, $achternaam, $email, $wachtwoord, $wachtwoord2) !== false) {
        header("location: ../addemployee.php?error=emptyinput");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../addemployee.php?error=invalidemail");
        exit();
    }
    if (wachtwoordMatch($wachtwoord, $wachtwoord2) !== false) {
        header("location: ../addemployee.php?error=passwordnomatch");
        exit();
    }
    if (emailExist($conn, $email) !== false) {
        header("location: ../addemployee.php?error=emailused");
        exit();
    }


    createEmployee($conn, $voornaam, $tussenvoegsel, $achternaam, $email, $wachtwoord);
}
else {
    header("location: ../addemployee.php");
    exit();
}