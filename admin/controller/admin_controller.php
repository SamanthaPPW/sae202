<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Europe/Paris');

require_once(__DIR__ . '/../model/utilisateurs_model.php');

function index() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php?action=login');
        exit;
    }

    $period = $_GET['period'] ?? 'today';
    $users = getAllUsers();
    $stats = getUserStats();
    $recent_users = getRecentUsers($period);

    include(__DIR__ . '/../view/gestion_view.php');
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

function handleUser() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php?action=login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $mot_de_passe = $_POST['mot_de_passe'] ?? '';

        $errors = [];

        if (!$nom) $errors[] = "Le nom est requis.";
        if (!$prenom) $errors[] = "Le prénom est requis.";
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
        if (!$mot_de_passe) $errors[] = "Le mot de passe est requis.";

        if (empty($errors)) {
            $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            // CHANGEMENT ICI : addUser() -> insertUser()
            $result = insertUser([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'telephone' => $telephone,
                'mot_de_passe' => $hashedPassword
            ]);

            if ($result) {
                header('Location: index.php?action=index');
                exit;
            } else {
                $errors[] = "Erreur lors de l'ajout de l'utilisateur.";
            }
        }

        $user = ['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'telephone' => $telephone];
        require_once(__DIR__ . '/../view/user_form.php');

    } else {
        $user = ['nom' => '', 'prenom' => '', 'email' => '', 'telephone' => ''];
        $errors = [];
        require_once(__DIR__ . '/../view/user_form.php');
    }
}

function editUser() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php?action=login');
        exit;
    }

    $id = $_GET['id'] ?? null;
    if (!$id || !is_numeric($id)) {
        header('Location: index.php?action=index');
        exit;
    }

    $user = getUserById((int)$id);
    if (!$user) {
        header('Location: index.php?action=index');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $mot_de_passe = $_POST['mot_de_passe'] ?? '';

        $errors = [];

        if (!$nom) $errors[] = "Le nom est requis.";
        if (!$prenom) $errors[] = "Le prénom est requis.";
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";

        if (empty($errors)) {
            $dataToUpdate = [
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'telephone' => $telephone
            ];

            if (!empty($mot_de_passe)) {
                $dataToUpdate['mot_de_passe'] = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            }

            $result = updateUserById((int)$id, $dataToUpdate);

            if ($result) {
                header('Location: index.php?action=index');
                exit;
            } else {
                $errors[] = "Erreur lors de la mise à jour de l'utilisateur.";
            }
        }

        $user = ['id' => $id, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'telephone' => $telephone];
        require_once(__DIR__ . '/../view/user_form.php');

    } else {
        $errors = [];
        require_once(__DIR__ . '/../view/user_form.php');
    }
}

function deleteUser() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php?action=login');
        exit;
    }

    $id = $_GET['id'] ?? null;
    if ($id && is_numeric($id)) {
        deleteUserById((int)$id);
    }
    header('Location: index.php?action=index');
    exit;
}

function addUser() {
    handleUser();
}

function logout() {
    session_destroy();
    header('Location: index.php?action=login');
    exit;
}