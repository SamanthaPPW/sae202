<?php
require 'model/users_model.php';

function index()
{
    $error_message = '';
    $success_message = '';

    if (isset($_GET['error'])) {
        if ($_GET['error'] === 'invalid_credentials') {
            $error_message = 'Email ou mot de passe incorrect.';
        } elseif ($_GET['error'] === 'empty_fields') {
            $error_message = 'Veuillez remplir tous les champs.';
        } elseif ($_GET['error'] === 'not_logged_in') {
            $error_message = 'Vous devez être connecté pour accéder à cette page.';
        }
    }
    if (isset($_GET['success']) && $_GET['success'] === 'registration_complete') {
        $success_message = 'Inscription réussie, vous pouvez maintenant vous connecter.';
    }

    require 'view/autres_pages/header.php';
    require 'view/autres_pages/menu.php';
    require 'view/connexion_view.php';
    require 'view/autres_pages/footer.php';
}

function inscription()
{
    require 'view/autres_pages/header.php';
    require 'view/autres_pages/menu.php';
    require 'view/inscription_view.php';
    require 'view/autres_pages/footer.php';
}

function verif_connexion()
{
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $resultat = verif_utilisateur($_POST['email']);
        
        if ($resultat && $resultat['user_mail'] == $_POST['email'] && password_verify($_POST['password'], $resultat['user_password'])) {
            session_start();
            $_SESSION['user_nom'] = $resultat['user_nom'];
            header('Location: /');
        } else {
            header('Location: /connexion?error=invalid_credentials');
        }
    } else {
        header('Location: /connexion?error=empty_fields');
    }
}

function deconnexion()
{
    session_start();
    session_destroy();
    header('Location: /');
}

function validation_inscription()
{
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'])) {
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        if (!$email) {
            header('Location: /connexion/inscription?error=invalid_email');
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if (inscription_utilisateur($nom, $prenom, $email, $hashed_password)) {
            header('Location: /connexion?success=registration_complete');
            exit();
        } else {
            header('Location: /connexion/inscription?error=registration_failed');
            exit();
        }
    } else {
        header('Location: /connexion/inscription?error=empty_fields');
        exit();
    }
}


function profil()
{
    session_start();
    if (!isset($_SESSION['user_nom'])) {
        header('Location: /connexion?error=not_logged_in');
        exit();
    }

    require 'view/autres_pages/header.php';
    require 'view/autres_pages/menu.php';
    require 'view/profil_view.php';
    require 'view/autres_pages/footer.php';
}

$error_message = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'invalid_credentials') {
        $error_message = 'Email ou mot de passe incorrect.';
    } elseif ($_GET['error'] === 'empty_fields') {
        $error_message = 'Veuillez remplir tous les champs.';
    }
}
if (isset($_GET['success']) && $_GET['success'] === 'registration_complete') {
    $success_message = 'Inscription réussie, vous pouvez maintenant vous connecter.';
}
?>
>>>>>>> 69f619fb6b832296714e25bdb859fc9fbc5f4ea6
