<?php
session_start();

if (!isset($_SESSION['codeEmp'])) {
    header("Location: connEmp.php");
    exit();
}

echo "Bienvenue, " . htmlspecialchars($_SESSION['nom']) . "!";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
</head>
<body>
    <h2>Page d'accueil</h2>
    <p><a href="deconnexion.php">Se déconnecter</a></p>
</body>
</html>
