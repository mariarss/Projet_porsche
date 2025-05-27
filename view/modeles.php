<?php
// Inclusion des fichiers nécessaires pour le contrôleur de voitures et la base de données
include_once __DIR__ . '/../controller/VoitureController.php';
include_once __DIR__ . '/../bdd/bdd.php';

// Création d'une instance du contrôleur VoitureController
$voitureController = new VoitureController($bdd);

// Récupération de toutes les voitures via la méthode afficherVoitures() du contrôleur
$voitures = $voitureController->afficherVoitures();

// Traitement de la demande d'ajout au panier lorsqu'un formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_voiture'])) {
    // Vérifie si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login'); // Redirection vers la page de connexion si non connecté
        exit();
    }
    // Vérifie si l'utilisateur a le rôle 'Client'
    if ($_SESSION['user']['Role'] !== 'Client') {
        echo "Seuls les clients peuvent demander un essai.";
        exit();
    }
    // Ajoute la voiture au panier pour l'utilisateur
    $voitureController->ajouterAuPanier($_SESSION['user']['ID_Utilisateur'], $_POST['id_voiture']);
    // Redirige l'utilisateur vers la page panier après l'ajout
    header('Location: index.php?page=panier');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modèles Porsche</title>
    <!-- Lien vers la feuille de style des modèles -->
    <link rel="stylesheet" href="css/modeles.css">
</head>
<body>

<h1>Modèles de voitures Porsche</h1>

<div class="container">
    <!-- Boucle pour afficher chaque voiture -->
    <?php foreach ($voitures as $voiture) : ?>
        <div class="car-card">
            <!-- Image de la voiture -->
            <img src="images/<?= htmlspecialchars($voiture['image']) ?>" alt="<?= htmlspecialchars($voiture['marque'] . ' ' . $voiture['modele']) ?>">
            <!-- Nom et modèle de la voiture -->
            <h2><?= htmlspecialchars($voiture['marque'] . ' ' . $voiture['modele']) ?></h2>
            <!-- Année de la voiture -->
            <p>Année : <?= htmlspecialchars($voiture['annee']) ?></p>
            
            <!-- Prix de la voiture avec ou sans réduction -->
            <?php if (!empty($voiture['reduction']) && $voiture['reduction'] > 0): ?>
                <p>
                    <span style="text-decoration: line-through; color: #999;">
                        <?= number_format($voiture['prix'], 2, ',', ' ') ?> €</span>
                    <span style="color: #d40000; font-weight: bold;">
                        <?= number_format($voiture['prix'] * (1 - $voiture['reduction']/100), 2, ',', ' ') ?> €
                    </span>
                    <span class="badge" style="background-color: #d40000; color: white; padding: 2px 5px; border-radius: 3px;">
                        -<?= $voiture['reduction'] ?>%
                    </span>
                </p>
            <?php else: ?>
                <p>Prix : <?= number_format($voiture['prix'], 2, ',', ' ') ?> €</p>
            <?php endif; ?>

            <!-- Formulaire d'ajout au panier pour les utilisateurs "Client" uniquement -->
            <?php if ($_SESSION['user']['Role'] === 'Client') : ?>
                <form method="post">
                    <input type="hidden" name="id_voiture" value="<?= htmlspecialchars($voiture['id']) ?>"> <!-- Id de la voiture caché -->
                    <button type="submit">Ajouter au panier</button> <!-- Bouton pour ajouter au panier -->
                </form>
            <?php endif; ?>

            <!-- Liens supplémentaires pour les clients uniquement -->
            <?php if ($_SESSION['user']['Role'] === 'Client') : ?>
                <div class="buttons">
                    <a href="index.php?page=demande_essai&id=<?= htmlspecialchars($voiture['id']) ?>">
                        <button type="button">Demander un essai</button>
                    </a>
                    <a href="index.php?page=details_voiture&id=<?= htmlspecialchars($voiture['id']) ?>">
                        <button type="button">Voir détails</button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
