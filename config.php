<?php
$conn = new mysqli("localhost","root","","flowerpower");
if($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
?>