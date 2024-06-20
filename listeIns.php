<?php
// listeIns.php
require_once 'conxDB.php';
include 'menu.php';

$codeEmp = $_SESSION['codeEmp'];

$query = "SELECT codeInsc, dateVoy, nbrePers, (nbrePers * prixTicket) AS total
          FROM Inscription
          JOIN Voyage ON Inscription.codeVoyage = Voyage.codeVoyage
          WHERE codeEmp = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $codeEmp);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Inscriptions</title>
</head>
<body>
    <h2>Liste des Inscriptions</h2>
    <table border="1">
        <tr>
            <th>Code d'inscription</th>
            <th>Date de voyage</th>
            <th>Nombre de personnes</th>
            <th>Total à payer</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['codeInsc']); ?></td>
                <td><?php echo htmlspecialchars($row['dateVoy']); ?></td>
                <td><?php echo htmlspecialchars($row['nbrePers']); ?></td>
                <td><?php echo htmlspecialchars($row['total']); ?> euros</td>
                <td><a href="afficher.php?codeInsc=<?php echo $row['codeInsc']; ?>">Afficher</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
