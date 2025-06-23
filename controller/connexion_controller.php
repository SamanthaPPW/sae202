<?php
require 'model/utilisateurs_model.php';

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
        } elseif ($_GET['error'] === 'account_not_confirmed') {
            // Tu peux laisser vide ici car affiché directement dans la vue via $_GET
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
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        header('Location: /connexion?error=empty_fields');
        exit;
    }

    $resultat = getUserByEmail($_POST['email']);

    if (!$resultat) {
        header('Location: /connexion?error=invalid_credentials');
        exit;
    }

    if (!$resultat['is_confirmed']) {
        header('Location: /connexion?error=account_not_confirmed');
        exit;
    }

    if (!password_verify($_POST['password'], $resultat['mot_de_passe'])) {
        header('Location: /connexion?error=invalid_credentials');
        exit;
    }

    // Tout est bon, on démarre la session
    session_start();
    $_SESSION['id'] = $resultat['id'];
    $_SESSION['nom'] = $resultat['nom'];
    $_SESSION['role'] = $resultat['role'];

    header('Location: /');
    exit;
}


function deconnexion()
{
    session_start();
    session_destroy();
    header('Location: /');
}

function validation_inscription()
{
    if (!isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'])) {
        header('Location: /connexion/inscription?error=empty_fields');
        exit();
    }

    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $telephone = $_POST['telephone'] ?? '';

    if (!$email) {
        header('Location: /connexion/inscription?error=invalid_email');
        exit();
    }

    // IMPORTANT : Vérifier si l'email est déjà utilisé
    if (emailExists($email)) {
        header('Location: /connexion/inscription?error=email_already_exists');
        exit();
    }

    $token = createUser($nom, $prenom, $email, $telephone, $password);

    if ($token !== false) {
    } else {
        header('Location: /connexion/inscription?error=registration_failed');
        exit();
    }
}



function profil()
{
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion?error=not_logged_in');
        exit();
    }

    require 'view/autres_pages/header.php';
    require 'view/autres_pages/menu.php';
    require 'view/profil_view.php';
    require 'view/autres_pages/footer.php';
}

function confirmation() {
    if (!isset($_GET['token'])) {
        echo "Token manquant.";
        exit;
    }

    global $pdo;
    $token = $_GET['token'];
    $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE confirmation_token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $stmt = $pdo->prepare("UPDATE utilisateurs SET is_confirmed = 1, confirmation_token = NULL WHERE id = ?");
        $stmt->execute([$user['id']]);
        echo "Compte confirmé avec succès, vous pouvez maintenant vous connecter.";
        // Ou redirige vers connexion:
        // header('Location: /connexion?success=account_confirmed');
        // exit;
    } else {
        echo "Token invalide ou déjà utilisé.";
    }
}


?>
