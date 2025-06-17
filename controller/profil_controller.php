<?php

session_start();

require_once(__DIR__ . '/../model/utilisateurs_model.php');

function index() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit;
    }

    $user = getUserById($_SESSION['user_id']);

    require(__DIR__ . '/../view/autres_pages/header.php');
    require(__DIR__ . '/../view/autres_pages/menu.php');
    require(__DIR__ . '/../view/profil_view.php');
    require(__DIR__ . '/../view/autres_pages/footer.php');

}
