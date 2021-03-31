<?php
/* employee ---------------------------------------*/
function emptyInputSignupAdmin($voornaam, $achternaam, $email, $wachtwoord, $wachtwoord2) {
    $result;
    if (empty($voornaam) || empty($achternaam) || empty($email) || empty($wachtwoord) || empty($wachtwoord2)) {
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

/* employee ---------------------------------------*/
function emailExist($conn, $email){
    $sql = "SELECT * FROM medewerker WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../addemployee.php?error=itfailed");
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

function createEmployee($conn, $voornaam, $tussenvoegsel, $achternaam, $email, $wachtwoord){
    $sql = "INSERT INTO medewerker (voornaam, tussenvoegsel, achternaam, email, wachtwoord) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../SignUp.php?error=accfailed");
        exit();
    }

    $hashedPass = password_hash($wachtwoord, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $voornaam, $tussenvoegsel, $achternaam, $email, $hashedPass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../addemployee.php?error=none");
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

function loginAdmin($conn, $email, $wachtwoord) {
    $emailExist = emailExist($conn, $email);

    if ($emailExist === false) {
        header("location: ../admin.php?error=incorrectlogin");
        exit();
    }

    $passHashed = $emailExist["wachtwoord"];
    $checkPass = password_verify($wachtwoord, $passHashed);

    if ($checkPass === false) {
        header("location: ../admin.php?error=incorrectpassword");
        exit();
    } 
    else if ($checkPass === true) {
        session_start();
        $_SESSION["idmedewerker"] = $emailExist["idmedewerker"];
        $_SESSION["email"] = $emailExist["email"];
        header("location: ../index.php");
        exit();
    }
}