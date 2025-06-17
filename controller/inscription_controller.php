<?php
session_start();
require_once(__DIR__ . '/../model/utilisateurs_model.php');

function index() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $telephone = $_POST['telephone'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        $error = '';

        if (!$nom || !$prenom || !$email || !$password || !$password_confirm) {
            $error = "Tous les champs sont obligatoires.";
        } elseif ($password !== $password_confirm) {
            $error = "Les mots de passe ne correspondent pas.";
        } elseif (emailExists($email)) {
            $error = "Cet email est déjà utilisé.";
        }

        if (empty($error)) {
            if (createUser($nom, $prenom, $email, $telephone, $password)) {
                header('Location: /connexion');
                exit;
            } else {
                $error = "Erreur lors de la création du compte.";
            }
        }
    }
    require(__DIR__ . '/../view/inscription_view.php');
}

function inscription()
{
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        validation_inscription();
    }

    require('view/autres_pages/header.php');
    require('view/autres_pages/menu.php');
    require('view/inscription_view.php');
    require('view/autres_pages/footer.php');
}