<?php

require_once 'conxDB.php';
include 'menu.php';


$villes = [];
$result = $conn->query("SELECT DISTINCT villeD FROM DescriptionVoyage");
while ($row = $result->fetch_assoc()) {
    $villes[] = $row['villeD'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codeEmp = $_SESSION['codeEmp'];
    $codeVoyage = $_POST['codeVoyage'];
    $nbrePers = $_POST['nbrePers'];
    $dateVoy = $_POST['dateVoy'];

    $stmt = $conn->prepare("INSERT INTO Inscription (codeEmp, codeVoyage, nbrePers, dateVoy) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $codeEmp, $codeVoyage, $nbrePers, $dateVoy);
    $stmt->execute();
    $stmt->close();
    
    echo "Inscription enregistrée avec succès!";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>S'inscrire</title>
</head>
<body>
    <h2>S'inscrire</h2>
    <form method="POST" action="sinscrire.php">
        <label for="villeDepart">Ville de départ:</label>
        <select id="villeDepart" name="villeDepart" required>
            <?php foreach ($villes as $ville): ?>
                <option value="<?php echo htmlspecialchars($ville); ?>"><?php echo htmlspecialchars($ville); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="villeArrivee">Ville d'arrivée:</label>
        <select id="villeArrivee" name="villeArrivee" required>
            <?php foreach ($villes as $ville): ?>
                <option value="<?php echo htmlspecialchars($ville); ?>"><?php echo htmlspecialchars($ville); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="dateVoy">Date de voyage:</label>
        <input type="date" id="dateVoy" name="dateVoy" required>
        <br>
        <label for="nbrePers">Nombre de personnes:</label>
        <input type="number" id="nbrePers" name="nbrePers" required>
        <br>
        <button type="submit">Enregistrer l'inscription</button>
    </form>
</body>
</html>
