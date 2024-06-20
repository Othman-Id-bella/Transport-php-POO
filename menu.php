<?php

session_start();
if (!isset($_SESSION['codeEmp'])) {
    header("Location: connEmp.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
</head>
<body>
    <h2>Bienvenue, <?php echo htmlspecialchars($_SESSION['nom']); ?> (<?php echo htmlspecialchars($_SESSION['fonction']); ?>)</h2>
    <nav>
        <ul>
            <li><a href="sinscrire.php">S'inscrire</a></li>
            <li><a href="listeIns.php">Liste de Voyages</a></li>
            <li><a href="deconnexion.php">Se déconnecter</a></li>
        </ul>
    </nav>
</body>
</html>
