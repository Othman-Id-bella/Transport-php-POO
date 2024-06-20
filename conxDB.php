<?php

$servername = "localhost:3307";
$username = "root@"; 
$password = ""; 
$dbname = "agence_voyage"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}
?>
