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
$afgehaald = '';


if (isset($_POST['update'])) {
    $afgehaald = mysqli_real_escape_string($conn, $_POST['afgehaald']);
    $id = mysqli_real_escape_string($conn, $_POST['idfactuur']);

    mysqli_query($conn, "UPDATE factuur SET afgehaald='$afgehaald' WHERE idfactuur=$id" );
    header("location: ../order.php?error=none");
    exit();
}