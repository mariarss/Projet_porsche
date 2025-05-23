<?php
require_once __DIR__ . '/../bdd/bdd.php';
require_once __DIR__ . '/../controller/PanierController.php';

// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit();
}

$panierController = new PanierController($bdd);
$idUtilisateur = $_SESSION['user']['ID_Utilisateur'];

// Gestion des actions (ajout, suppression ou vider le panier)
$action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
$action = is_string($action) ? htmlspecialchars(trim($action)) : null;
$idVoitureAction = filter_input(INPUT_GET, 'id_voiture', FILTER_VALIDATE_INT);

if ($action === 'ajouter' && $idVoitureAction) {
    $panierController->ajouterAuPanier($idUtilisateur, $idVoitureAction);
    header('Location: index.php?page=panier');
    exit();
}

if ($action === 'supprimer' && $idVoitureAction) {
    $panierController->supprimerVoitureDuPanier($idUtilisateur, $idVoitureAction);
    header('Location: index.php?page=panier');
    exit();
}

if ($action === 'vider') {
    $panierController->viderPanierUtilisateur($idUtilisateur);
    header('Location: index.php?page=panier');
    exit();
}

$panier = $panierController->afficherPanier($idUtilisateur);
$total = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .logo-bg {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            opacity: 0.15;
            z-index: -1;
        }
        h1 {
            color: #d40000;
            position: relative;
            z-index: 1;
        }
        .panier-item {
            border-bottom: 1px solid #ccc;
            padding: 15px;
            text-align: left;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .panier-item:last-child {
            border-bottom: none;
        }
        .panier-item h2 {
            color: #333;
            font-size: 20px;
            width: 100%;
            margin-bottom: 10px;
        }
        .panier-item p {
            color: #666;
            font-size: 16px;
            margin: 5px 0;
        }
        .panier-item-details {
            flex: 2;
        }
        .panier-item-price {
            flex: 1;
            text-align: right;
        }
        .reduction-tag {
            background-color: #d40000;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 14px;
            display: inline-block;
            margin-left: 10px;
        }
        .vous-economisez {
            color: #d40000;
            font-weight: bold;
            font-size: 14px;
            margin-top: 5px;
        }
        .total-section {
            margin-top: 30px;
            border-top: 2px solid #eee;
            padding-top: 20px;
        }
        .sous-total, .economie-totale {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 18px;
        }
        .economie-totale {
            color: #d40000;
        }
        .total {
            font-size: 24px;
            font-weight: bold;
            margin-top: 15px;
            color: #d40000;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .btn {
            display: inline-block;
            background: #d40000;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .btn:hover {
            background: #a00000;
        }
        .btn-secondary {
            background: #666;
            margin-left: 10px;
        }
        .btn-secondary:hover {
            background: #444;
        }
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .quantity-btn {
            background: #eee;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
        }
        .quantity-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .quantity-value {
            margin: 0 10px;
            font-weight: bold;
        }
        .inline-form {
            display: inline;
        }
        .delete-btn {
            background: none;
            border: none;
            color: #666;
            font-size: 14px;
            text-decoration: underline;
            cursor: pointer;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mon Panier</h1>

        <?php if (empty($panier['data'])) : ?>
            <div class="alert alert-danger">Votre panier est vide.</div>
        <?php else : ?>
            <div class="panier-container">
                <?php foreach ($panier['data'] as $item) : ?>
                    <?php 
                        $quantite = !empty($item['quantite']) ? $item['quantite'] : 1;
                        $totalArticle = $item['prix'] * $quantite;
                        $total += $totalArticle;
                    ?>
                    <div class="panier-item">
                        <div class="panier-item-details">
                            <h2><?= htmlspecialchars($item['marque'] . ' ' . $item['modele']) ?></h2>
                            <p><strong>Prix unitaire :</strong> <?= number_format($item['prix'], 2, ',', ' ') ?> €</p>
                            <p><strong>Quantité :</strong> <?= $quantite ?></p>
                            <p class="vous-economisez"><strong>Total :</strong> <?= number_format($totalArticle, 2, ',', ' ') ?> €</p>
                        </div>
                        <div class="panier-item-price">
                            <form class="inline-form" method="get" action="index.php" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article du panier ?');">
                                <input type="hidden" name="page" value="panier">
                                <input type="hidden" name="action" value="supprimer">
                                <input type="hidden" name="id_voiture" value="<?= $item['id'] ?>">
                                <button type="submit" class="delete-btn">❌ Supprimer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="total-section">
                <div class="sous-total">
                    <span>Sous-total :</span>
                    <span><?= number_format($total, 2, ',', ' ') ?> €</span>
                </div>

                <div class="total">
                    <span>Total :</span>
                    <span><?= number_format($total, 2, ',', ' ') ?> €</span>
                </div>
            </div>

            <div class="panier-actions">
                <a href="index.php?page=panier&action=vider"
                   onclick="return confirm('Êtes-vous sûr de vouloir vider tout le panier ?');"
                   class="btn btn-secondary">
                   Vider le panier
                </a>
                <a href="index.php?page=checkout" class="btn">Payer</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
