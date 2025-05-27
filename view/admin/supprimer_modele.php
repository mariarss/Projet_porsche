<?php

require_once __DIR__ . '/../../bdd/bdd.php';
require_once __DIR__ . '/../../controller/VoitureController.php';

// Vérifier si l'utilisateur est un concessionnaire
if (!isset($_SESSION['user']) || $_SESSION['user']['Role'] !== 'Concess') {
    header("Location: ../../index.php");
    exit();
}

// Vérifier si un ID est passé
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idVoiture = intval($_GET['id']);
    $voitureController = new VoitureController($bdd);

    // Suppression de la voiture
    $resultat = $voitureController->supprimerVoiture($idVoiture);

    if ($resultat) {
        // Redirection avec message de succès
        header("Location:http://127.0.0.1/Promo284/porsche2/index.php?page=gerer_modeles");
        exit();
    } else {
        // Redirection avec message d'erreur
        header("Location: ../../index.php?page=gerer_modeles&error=La suppression a échoué.");
        exit();
    }
} else {
    header("Location: ../../index.php?page=gerer_modeles&error=ID invalide.");
    exit();
}
