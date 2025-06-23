<?php
require_once __DIR__ . '/../model/reservation_model.php';

function index() {
    agenda();
}

function agenda() {
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    $creneaux = getCreneaux();
    require __DIR__ . '/../view/reservation_view.php';
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

  $creneau_id = $_GET['creneau_id'];

  require __DIR__ . '/../view/reservation/formulaire_achat.php';
}

