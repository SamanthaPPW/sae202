<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/../model/utilisateurs_model.php');

function index() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php?action=login');
        exit;
    }

    $users = getAllUsers();

    require_once(__DIR__ . '/../view/gestion_view.php');
}

function login() {
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        header('Location: index.php?action=index');
        exit;
    }
    require_once(__DIR__ . '/../view/login.php');
}

function doLogin() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = getUserByEmail($email);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            header('Location: index.php?action=index');
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
            require_once(__DIR__ . '/../view/login.php');
        }
    } else {
        header('Location: index.php?action=login');
        exit;
    }
}

function logout() {
    session_destroy();
    header('Location: index.php?action=login');
    exit;
}
