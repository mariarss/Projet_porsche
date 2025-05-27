<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once dirname(__DIR__, 2) . '/controller/VoitureController.php';
include_once dirname(__DIR__, 2) . '/bdd/bdd.php';

$voitureController = new VoitureController($bdd);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Erreur : Aucun véhicule sélectionné.</p>";
    exit();
}

$id = intval($_GET['id']); 
$voiture = $voitureController->getVoitureById($id);

if (!$voiture) {
    echo "<p>Véhicule introuvable.</p>";
    exit();
}

$marque = isset($voiture['marque']) ? htmlspecialchars($voiture['marque']) : 'Inconnu';
$modele = isset($voiture['modele']) ? htmlspecialchars($voiture['modele']) : 'Inconnu';
$annee = isset($voiture['annee']) ? htmlspecialchars($voiture['annee']) : 'Inconnue';
$prix = isset($voiture['prix']) ? number_format($voiture['prix'], 2, ',', ' ') . ' €' : 'Prix non disponible';
$image = isset($voiture['image']) ? htmlspecialchars($voiture['image']) : 'default.jpg';

$descriptions = [
    '911' => "La Porsche 911 est un emblème intemporel de la performance automobile, combinant un moteur arrière puissant, une silhouette emblématique et une technologie de pointe.",
    'Taycan' => "La Porsche Taycan est une révolution électrique alliant puissance et autonomie. Son design futuriste et ses performances impressionnantes en font une référence des véhicules électriques sportifs.",
    'Macan' => "Le Porsche Macan est un SUV compact qui offre l'ADN sportif de Porsche avec une conduite dynamique, un confort haut de gamme et une polyvalence remarquable.",
    'Cayenne' => "Le Porsche Cayenne est un SUV de luxe alliant puissance et confort, offrant des performances exceptionnelles sur route et en tout-terrain.",
    'GT3' => "La Porsche 911 GT3 est une version ultra-sportive de la 911, offrant une performance pure, une expérience de conduite intense et un design aérodynamique.",
    '718' => "Le Porsche 718 est un roadster ou coupé sportif compact, offrant une conduite agile, un moteur performant et un design moderne.",
];

$performance = [
    '911' => "Moteur : Flat-6 biturbo - 450 ch | 0-100 km/h : 3,5 s | Vitesse max : 310 km/h",
    'Taycan' => "Moteur : Électrique - 761 ch | 0-100 km/h : 2,8 s | Autonomie : 400 km",
    'Macan' => "Moteur : V6 Turbo - 380 ch | 0-100 km/h : 4,8 s | Vitesse max : 260 km/h",
    'Cayenne' => "Moteur : V6 ou V8 Turbo - 450 ch | 0-100 km/h : 5,0 s | Vitesse max : 265 km/h",
    'GT3' => "Moteur : 4.0L Flat-6 - 510 ch | 0-100 km/h : 3,4 s | Vitesse max : 318 km/h",
    '718' => "Moteur : 4.0L Flat-6 - 420 ch | 0-100 km/h : 4,4 s | Vitesse max : 290 km/h",
];

$description = isset($descriptions[$modele]) ? $descriptions[$modele] : "Un modèle Porsche unique alliant performance et élégance.";
$specs = isset($performance[$modele]) ? $performance[$modele] : "Performances exceptionnelles garanties par Porsche.";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $marque . ' ' . $modele ?> - Détails</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .car-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .car-container img {
            width: 100%;
            border-radius: 10px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 15px;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .back-btn:hover {
            background: darkred;
        }
    </style>
</head>
<body>

<div class="car-container">
    <h1><?= $marque . ' ' . $modele ?></h1>
    <img src="images/<?= $image ?>" alt="<?= $marque . ' ' . $modele ?>">
    <p><strong>Marque :</strong> <?= $marque ?></p>
    <p><strong>Modèle :</strong> <?= $modele ?></p>
    <p><strong>Année :</strong> <?= $annee ?></p>
    <p><strong>Prix :</strong> <?= $prix ?></p>
    <p><strong>Description :</strong> <?= $description ?></p>
    <p><strong>Performances :</strong> <?= $specs ?></p>
    <a href="index.php?page=modeles" class="back-btn">Retour aux modèles</a>
</div>

</body>
</html>
