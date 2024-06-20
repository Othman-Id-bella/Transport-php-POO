<?php
// connEmp.php
session_start();
require_once 'conxDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];

    // Préparer et exécuter la requête
    $stmt = $conn->prepare("SELECT * FROM Employe WHERE user = ? AND pwd = ?");
    $stmt->bind_param("ss", $user, $pwd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employe = $result->fetch_assoc();
        $_SESSION['codeEmp'] = $employe['codeEmp'];
        $_SESSION['nom'] = $employe['nom'];
        header("Location: accueil.php");
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion Employé</title>
</head>
<body>
    <h2>Connexion Employé</h2>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="connEmp.php">
        <label for="user">Utilisateur:</label>
        <input type="text" id="user" name="user" required>
        <br>
        <label for="pwd">Mot de passe:</label>
        <input type="password" id="pwd" name="pwd" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
