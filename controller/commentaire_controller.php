<?php
function nouveau() {
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    require_once(__DIR__ . '/../model/comments_model.php');

    $commentaires = getCommentaires();

    require('view/autres_pages/header.php');
    require('view/autres_pages/menu.php');
    require('view/comments_view.php'); 
    require('view/autres_pages/footer.php');
}


function envoyer() {
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: /connexion');
        exit;
    }

    require_once(__DIR__ . '/../model/utilisateurs_model.php');
    require_once(__DIR__ . '/../model/comments_model.php');

    $user_id = $_SESSION['id'];
    $user = getUserById($user_id);
    $user_name = $user['prenom'] . ' ' . $user['nom'];

    $comment_text = trim($_POST['commentaire_text']);
    if ($comment_text === '') {
        $_SESSION['error'] = "Le commentaire ne peut pas être vide.";
        header('Location: /commentaire/nouveau');
        exit;
    }

    if (ajouterCommentaire($user_id, $user_name, $comment_text)) {
        $_SESSION['message'] = "Commentaire ajouté avec succès !";
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout du commentaire.";
    }

    header('Location: /commentaire/nouveau');
    exit;
}
