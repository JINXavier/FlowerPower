<?php

function emptyInputSignup($voornaam, $achternaam, $adres, $huisnummer, $postcode, $plaats, $email, $telefoon, $wachtwoord, $wachtwoord2) {
    $result;
    if (empty($voornaam) || empty($achternaam) || empty($adres) || empty($huisnummer) || empty($postcode) || empty($plaats) || empty($email) || empty($telefoon) || empty($wachtwoord) || empty($wachtwoord2)) {
        $result = true;
    } else {
        $result = false;
    } 
    return $result;
}


function invalidEmail($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    } 
    return $result;
}

function wachtwoordMatch($wachtwoord, $wachtwoord2){
    $result;
    if ($wachtwoord !== $wachtwoord2) {
        $result = true;
    } else {
        $result = false;
    } 
    return $result;
}


function emailExist($conn, $email){
    $sql = "SELECT * FROM klant WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../SignUp.php?error=itfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $voornaam, $tussenvoegsel, $achternaam, $adres, $huisnummer, $postcode, $plaats, $email, $telefoon, $wachtwoord){
    $sql = "INSERT INTO klant (voornaam, tussenvoegsel, achternaam, adres, huisnummer, postcode, plaats, email, telefoon, wachtwoord) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../SignUp.php?error=accfailed");
        exit();
    }

    $hashedPass = password_hash($wachtwoord, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssssssss", $voornaam, $tussenvoegsel, $achternaam, $adres, $huisnummer, $postcode, $plaats, $email, $telefoon, $hashedPass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../SignUp.php?error=none");
    exit();
}

function emptyInputLogin($email, $wachtwoord) {
    $result;
    if (empty($email) || empty($wachtwoord)) {
        $result = true;
    } else {
        $result = false;
    } 
    return $result;
}

function loginUser($conn, $email, $wachtwoord) {
    $emailExist = emailExist($conn, $email);

    if ($emailExist === false) {
        header("location: ../Login.php?error=incorrectlogin");
        exit();
    }

    $passHashed = $emailExist["wachtwoord"];
    $checkPass = password_verify($wachtwoord, $passHashed);

    if ($checkPass === false) {
        header("location: ../Login.php?error=incorrectpassword");
        exit();
    } 
    else if ($checkPass === true) {
        session_start();
        $_SESSION["idklant"] = $emailExist["idklant"];
        $_SESSION["email"] = $emailExist["email"];
        header("location: ../index.php?error=True");
        exit();
    }
}