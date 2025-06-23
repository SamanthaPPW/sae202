<?php
require_once __DIR__ . '/../model/reservation_model.php';

function valider() {
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    if (
        isset($_POST['creneau_id'], $_POST['nom'], $_POST['carte'], $_POST['expiration'], $_POST['code_securite'])
    ) {
        reserverCreneau($_POST['creneau_id'], $_SESSION['id']);

        $_SESSION['message'] = "Réservation confirmée pour " . htmlspecialchars($_POST['nom']) . " !";
        header('Location: /reservation/agenda');
        exit;
    } else {
        $_SESSION['message'] = "Erreur dans le formulaire de paiement.";
        header('Location: /reservation/agenda');
        exit;
    }
}
