<?php
require_once __DIR__ . '/../model/reservation_model.php';

function index() {
    require 'view/autres_pages/header.php';
    require 'view/autres_pages/menu.php';
    agenda();
    require 'view/autres_pages/footer.php';
}

function agenda() {
  require 'view/autres_pages/header.php';
  require 'view/autres_pages/menu.php';

    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    $creneaux = getCreneaux();
    require __DIR__ . '/../view/reservation_view.php';

    require 'view/autres_pages/footer.php';
}

function reserver() {
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    if (isset($_POST['creneau_id'])) {
        reserverCreneau($_POST['creneau_id'], $_SESSION['id']);
        $_SESSION['message'] = "Créneau réservé avec succès !";
    } else {
        $_SESSION['error'] = "Erreur de réservation.";
    }

    header('Location: /reservation');
    exit;
}

function formulaire_achat() {
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    $creneau_id = $_GET['creneau_id'] ?? null;
    if (!$creneau_id) {
        $_SESSION['message'] = "Aucun créneau sélectionné.";
        header('Location: /reservation/agenda');
        exit;
    }

    require 'view/autres_pages/header.php';
    require 'view/autres_pages/menu.php';
    require __DIR__ . '/../view/reservation/formulaire_achat.php';
    require 'view/autres_pages/footer.php';
}

function valider() {
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    if (
        isset($_POST['creneau_id'], $_POST['nom'], $_POST['carte'], $_POST['expiration'], $_POST['code_securite'], $_POST['nombre_participants'])
    ) {
        $creneauId = $_POST['creneau_id'];
        $userId = $_SESSION['id'];
        $nb = (int)$_POST['nombre_participants'];
        $creneau = getCreneauById($creneauId);
        $placesRestantes = 20 - $creneau['nb_reservations'];
        if ($nb > $placesRestantes) {
            $_SESSION['message'] = "Pas assez de places disponibles.";
            header('Location: /reservation/formulaire_achat?creneau_id=' . $creneauId);
            exit;
        }
        for ($i = 0; $i < $nb; $i++) {
            reserverCreneau($creneauId, $userId);
        }

        $_SESSION['message'] = "Réservation confirmée pour " . htmlspecialchars($_POST['nom']) . " ($nb participant(s)) !";
        header('Location: /reservation/agenda');
        exit;
    } else {
        $_SESSION['message'] = "Erreur dans le formulaire de paiement.";
        header('Location: /reservation/agenda');
        exit;
    }
}
