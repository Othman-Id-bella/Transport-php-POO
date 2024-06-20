<?php
require_once 'conxDB.php';
include 'menu.php';

if (!isset($_GET['codeInsc'])) {
    header("Location: listeIns.php");
    exit();
}

$codeInsc = $_GET['codeInsc'];

$query = "SELECT dateVoy, villeD, villeA, heureDepart, ADDTIME(heureDepart, SEC_TO_TIME(duree * 3600)) AS heureArrivee
          FROM Inscription
          JOIN Voyage ON Inscription.codeVoyage = Voyage.codeVoyage
          JOIN DescriptionVoyage ON Voyage.codeDesc = DescriptionVoyage.codeDesc
          WHERE codeInsc = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $codeInsc);
$stmt->execute();
$result = $stmt->get_result();
$details = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Détails de l'inscription</title>
</head>
<body>
    <h2>Détails de l'inscription</h2>
    <p>Date de voyage: <?php echo htmlspecialchars($details['dateVoy']); ?></p>
    <p>Ville de départ: <?php echo htmlspecialchars($details['villeD']); ?></p>
    <p>Ville d'arrivée: <?php echo htmlspecialchars($details['villeA']); ?></p>
    <p>Heure de départ: <?php echo htmlspecialchars($details['heureDepart']); ?></p>
    <p>Heure d'arrivée: <?php echo htmlspecialchars($details['heureArrivee']); ?></p>
</body>
</html>
