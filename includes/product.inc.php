<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "flowerpower";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$edit = false;
$plaatje = '';
$artikelnaam = '';
$omschrijving = '';
$prijs = '';


if (isset($_POST["submit"])) {
    $plaatjeNaam = time() . '_' . $_FILES['plaatje']['name'];
    $artikelnaam = $_POST["artikelnaam"];
    $omschrijving = $_POST["omschrijving"];
    $prijs = $_POST["prijs"];
    $target = '../images/products/'. $plaatjeNaam;

    move_uploaded_file($_FILES['plaatje']['tmp_name'], $target);

    $query = "INSERT INTO artikel (plaatje, artikelnaam, omschrijving, prijs) VALUES ('$plaatjeNaam', '$artikelnaam', '$omschrijving', '$prijs')";
    mysqli_query($conn, $query);
    header("location: ../product.php");
    exit();
}




if (isset($_POST['submit'])) {
    $plaatje = $_POST['plaatje'];
    $artikelnaam = $_POST['artikelnaam'];
    $omschrijving = $_POST['omschrijving'];
    $omschrijving = $_POST['prijs'];
}

if (isset($_POST['update'])) {
    $plaatjeNaam = time() . '_' . $_FILES['plaatje']['name'];
    $artikelnaam = mysqli_real_escape_string($conn, $_POST['artikelnaam']);
    $omschrijving = mysqli_real_escape_string($conn, $_POST['omschrijving']);
    $prijs = mysqli_real_escape_string($conn, $_POST['prijs']);
    $id = mysqli_real_escape_string($conn, $_POST['idartikel']);
    $target = '../images/products/'. $plaatjeNaam;


    move_uploaded_file($_FILES['plaatje']['tmp_name'], $target);
    
    mysqli_query($conn, "UPDATE artikel SET plaatje='$plaatjeNaam', artikelnaam='$artikelnaam', omschrijving='$omschrijving', prijs='$prijs' WHERE idartikel=$id" );
    $_SESSION['msg'] = "Artikel is gewijzigd!";
    header("location: ../product.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM artikel WHERE idartikel=$id");
    $_SESSION['msg'] = "Artikel is verwijderd!";
    header("location: ../product.php");
    exit();
}

