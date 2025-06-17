<?php
session_start();
require_once(__DIR__ . '/../model/utilisateurs_model.php');

function index() {
    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = getUserByEmail($email);

        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            $error_message = "Email ou mot de passe incorrect.";
        } else {
            $_SESSION['user_id'] = $user['id'];
            header('Location: /profil');
            exit;
        }
    }

    require(__DIR__ . '/../view/connexion_view.php');
}
