<?php

if (isset($_POST["submit"])) {
    
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];

    require_once 'dbh.inc.php';
    require_once 'adminfunctions.inc.php';

    if (emptyInputLogin($email, $wachtwoord) !== false) {
        header("location: ../SignUp.php?error=emptyinput");
        exit();
    }
    

    loginAdmin($conn, $email, $wachtwoord);
}
else {
    header("location: ../Login.php");
    exit();
}