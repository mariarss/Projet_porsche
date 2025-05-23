<?php
include_once __DIR__ . '/../bdd/bdd.php';
include_once __DIR__ . '/../controller/ClientController.php';

// Vérifier si l'utilisateur est connecté et est un client
if (!isset($_SESSION['user']) || $_SESSION['user']['Role'] !== 'Client') {
    header("Location: ../index.php");
    exit();
}

$clientController = new ClientController($bdd);
$userId = $_SESSION['user']['ID_Utilisateur'];
$client = $clientController->getClientById($userId);

// Gestion de la mise à jour du profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));

    if ($clientController->updateClient($userId, $nom, $prenom, $email)) {
        // Mise à jour des données dans la session aussi
        $_SESSION['user']['Nom'] = $nom;
        $_SESSION['user']['Prenom'] = $prenom;
        $_SESSION['user']['Email'] = $email;

        $client = $clientController->getClientById($userId); // Rafraîchir les données
        $message = "Profil mis à jour avec succès.";
    } else {
        $message = "Erreur lors de la mise à jour du profil.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Porsche</title>
    <link rel="stylesheet" href="css/profil.css">
</head>
<body>
    <div class="profil-container">
        <div class="profil-header">
            <h2><?php echo htmlspecialchars($client['Nom'] . ' ' . $client['Prenom']); ?></h2>
        </div>

        <div class="profil-info">
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($client['Nom']); ?></p>
            <p><strong>Prénom :</strong> <?php echo htmlspecialchars($client['Prenom']); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($client['Email']); ?></p>
        </div>

        <div class="profil-actions">
            <a href="../index.php?page=logout">Déconnexion</a>
        </div>

        <div class="profil-edit">
            <h3>Modifier mes informations</h3>
            <?php if (isset($message)): ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <form method="POST">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($client['Nom']); ?>" required>
                
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($client['Prenom']); ?>" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($client['Email']); ?>" required>
                
                <input type="submit" value="Mettre à jour">
            </form>
        </div>
    </div>
</body>
</html>
